<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_pokok extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('upload');
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	function get_barang(){
		$id = $this->session->userdata('id');
        if (isset($_GET['term'])) {
            $result = $this->m_akum->get_barang($_GET['term'],$id);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
					'label'   		=> $row->nama_barang,
					'description'	=> $row->id,
				);
                echo json_encode($arr_result);
            }
        }
    }

	// Pembelian
	public function pembelian(){
		$data['title'] = 'Akum';
    $data['sql'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
    $data['pages'] = $this->load->view('pages/transaksi_pokok/pembelian','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_transaksi_pokok_pembelian() {
		$id = $this->session->userdata('id');
		$query_sld = $this->db->query('SELECT * FROM saldo_kas where iduser = "'.$id.'"');
		$saldo_kas = 0;
		foreach ($query_sld->result() as $val2) {
			$saldo_kas += $val2->saldo_kas;
		}
    $nama_barang = $this->input->post('nama_barang');
    $jenis_barang = $this->input->post('jenis_barang');
		// $idbarang = $this->input->post('idbarang');
		$query_brg = $this->db->query('SELECT * FROM barang_dagangan where nama_barang = "'.$nama_barang.'"');
    // $query_brg2 = $this->db->query('SELECT * FROM barang_dagangan where id = "'.$idbarang.'"');
    $flag = true;
    $jml_brg = 0;
		$ttl_nilai = 0;
		$hrg_stuan = 0;
    $hrg_total = 0;
		foreach ($query_brg->result() as $val) {
			$jml_brg += $val->jumlah_barang;
			$ttl_nilai += $val->total_nilai_barang;
			$hrg_stuan += $val->harga_satuan;
      $hrg_total += $val->total_harga_barang;
      $idbarang = $val->id;
      $nama_brg = $val->nama_barang;
      $jenis_brg = $val->jenis_barang;
      if($nama_brg == $nama_barang && $jenis_brg == $jenis_barang){
        $flag = false;
      }
		}
    // foreach ($query_brg->result() as $val) {
		// 	$jml_brg += $val->jumlah_barang;
		// 	$ttl_nilai += $val->total_nilai_barang;
		// 	$hrg_stuan += $val->harga_satuan;
    //   $hrg_total += $val->total_harga_barang;
    // }
		
    $tipe_pembayaran = $this->input->post('tipe_pembayaran');

		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pembelian',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_pembelian = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Hutang',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_hutang = $finfo['file_name'];

		$tanggal_transaksi = explode("-",$this->input->post('tanggal_pembelian'));
    $tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
    if ((int)$tanggal_transaksi[2]>=15) {
      $hitung = 1+((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
      $hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
    }else{
      $hitung = ((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
      $hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
    }
    if ($hitung<12) {
      $status = "Jangka Pendek";
    } else if($hitung>=12){
      $status = "Jangka Panjang";
    }

		if ($tipe_pembayaran=='Cash') {
			// Saldo Kas
			$data_saldo_kas = array(
				'iduser' => $id,
				'saldo_kas' => $saldo_kas - $this->input->post('total_harga'),
			);
			$this->m_akum->update_saldo_kas($id,$data_saldo_kas);
			$cash = $this->input->post('total_harga');
			$kredit = "";
		}else if ($tipe_pembayaran=='Kredit') {
      // Hutang
			$data_hutang = array(
				'iduser' => $id,
				'nama_hutang' => $this->input->post('pembelian_dari'),
				'jenis_hutang' => 'usaha',
				'jenis_hutang_lainnya' => '',
				'nilai_hutang' => $this->input->post('total_harga'),
				'tgl_transaksi' => $this->input->post('tanggal_pembelian'),
				'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
				'bukti_transaksi' => $bukti_hutang,
				'keterangan' => $this->input->post('notes_harga_lainnya'),
				'status' => $status
			);
			$this->m_akum->create_hutang($data_hutang);
			$cash = "";
			$kredit = $this->input->post('total_harga');
		}else if ($tipe_pembayaran=='Cash dan Kredit') {
			
      // Saldo Kas
			$data_saldo_kas = array(
				'iduser' => $id,
				'saldo_kas' => $saldo_kas - $this->input->post('cash'),
			);
			$this->m_akum->update_saldo_kas($id,$data_saldo_kas);
			// Hutang
			$data_hutang = array(
				'iduser' => $id,
				'nama_hutang' => $this->input->post('pembelian_dari'),
				'jenis_hutang' => 'usaha',
				'jenis_hutang_lainnya' => '',
				'nilai_hutang' => $this->input->post('sisa_kredit'),
				'tgl_transaksi' => $this->input->post('tanggal_pembelian'),
				'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
				'bukti_transaksi' => $bukti_hutang,
				'keterangan' => $this->input->post('notes_harga_lainnya'),
				'status' => $status
			);
			$this->m_akum->create_hutang($data_hutang);
			$cash = $this->input->post('cash');
			$kredit = $this->input->post('sisa_kredit');
		}



		if ($flag) {
			// Pembelian
			$data_pembelian = array(
				'iduser' => $id,
				'pembelian_dari' => $this->input->post('pembelian_dari'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jenis_barang' => $this->input->post('jenis_barang'),
				'satuan' => $this->input->post('satuan'),
				'jumlah' => $this->input->post('jumlah'),
				'diskon' => $this->input->post('diskon'),
				'harga_diskon' => $this->input->post('diskon'),
				'harga_barang' => $this->input->post('harga_barang'),
				'harga_lainnya' => $this->input->post('harga_lainnya'),
				'total_harga' => $this->input->post('total_harga'),
				'tanggal_pembelian' => $this->input->post('tanggal_pembelian'),
				'tipe_pembayaran' => $tipe_pembayaran,
				'total_cash' => $cash,
				'total_credit' => $kredit,
				'bukti_pembelian' => $bukti_pembelian,
				'notes_harga_lainnya' => $this->input->post('notes_harga_lainnya'),
				'date' => date('Y-m-d H:i:s')
			);
			$this->m_akum->create_transaksi_pokok_pembelian($data_pembelian);
			// Barang Dagangan
			$data_barang_dagangan = array(
				'iduser' => $id,
				'jenis_barang' => $this->input->post('jenis_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah_barang' => $this->input->post('jumlah'),
				'satuan' => $this->input->post('satuan'),
				'harga_satuan' => $this->input->post('harga_barang'),
				// 'total_nilai_barang' => $this->input->post('jumlah') * $this->input->post('harga_barang'),
				'total_nilai_barang' => $this->input->post('nilai_barang'),
        'total_harga_barang' => $this->input->post('total_harga')
			);
			$this->m_akum->create_barang_dagang($data_barang_dagangan);
		}else{
			// Pembelian
			$data_pembelian = array(
				'iduser' => $id,
				'pembelian_dari' => $this->input->post('pembelian_dari'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jenis_barang' => $this->input->post('jenis_barang'),
				'satuan' => $this->input->post('satuan'),
				'jumlah' => $this->input->post('jumlah'),
				'diskon' => $this->input->post('diskon'),
				'harga_diskon' => $this->input->post('diskon'),
				'harga_barang' => $this->input->post('harga_barang'),
				'harga_lainnya' => $this->input->post('harga_lainnya'),
				'total_harga' => $this->input->post('total_harga'),
				'tanggal_pembelian' => $this->input->post('tanggal_pembelian'),
				'tipe_pembayaran' => $tipe_pembayaran,
				'total_cash' => $cash,
				'total_credit' => $kredit,
				'bukti_pembelian' => $bukti_pembelian,
				'notes_harga_lainnya' => $this->input->post('notes_harga_lainnya'),
				'date' => date('Y-m-d H:i:s')
			);
			$this->m_akum->create_transaksi_pokok_pembelian($data_pembelian);
			// Barang Dagangan
			$data_barang_dagangan = array(
				'id' => $idbarang,
				'jumlah_barang' => $jml_brg + $this->input->post('jumlah'),
				'harga_satuan' => $this->input->post('harga_barang'),
				'total_nilai_barang' => $ttl_nilai + $this->input->post('nilai_barang'),
        'total_harga_barang' => $hrg_total + $this->input->post('total_harga')
			);
			$this->m_akum->edit_barang_dagang($idbarang,$data_barang_dagangan);
		}
      $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Transaksi Pembelian berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('transaksi_pokok/pembelian');
	}

	// Penjualan
	public function penjualan(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
    $data['pages'] = $this->load->view('pages/transaksi_pokok/penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_transaksi_pokok_penjualan() {
		$id = $this->session->userdata('id');
		$id_barang = $this->input->post('id_barang');
		$tipe_pembayaran = $this->input->post('jenis_pembayaran');
		$saldo_kas = $this->input->post('saldo_kas');

		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Penjualan/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Piutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_piutang = $finfo['file_name'];

    $tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_penjualan'));
    if ((int)$tanggal_transaksi[2]>=15) {
      $hitung = 1+((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
      $hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
    }else{
      $hitung = ((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
      $hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
    }
    if ($hitung<12) {
      $status = "Jangka Pendek";
    } else if($hitung>=12){
      $status = "Jangka Panjang";
    }

		if ($tipe_pembayaran=='Cash') {
			// Saldo Kas
      $data_saldo = array(
        'iduser' => $id,
        'saldo_kas' => $saldo_kas+$this->input->post('total_harga')
      );
			$this->m_akum->update_saldo_kas($id,$data_saldo);
			$cash = $this->input->post('total_harga');
			$kredit = "";
    }
    
    else if ($tipe_pembayaran=='Kredit') {
      // Piutang
      $data_piutang = array(
        'iduser' => $id,
        'jenis_piutang' => "usaha",
        'nama_piutang' => $this->input->post('penjualanke'),
        'nilai_piutang' => $this->input->post('total_harga'),
        'tanggal_transaksi' => $this->input->post('tanggal_penjualan'),
        'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
        'bukti_transaksi' => $bukti_piutang,
        'keterangan' => $this->input->post('notes_harga_lainnya'),
        'status' => $status
      );
			$this->m_akum->create_piutang($data_piutang);
			$cash = "";
			$kredit = $this->input->post('total_harga');

    }
    
    else if ($tipe_pembayaran=='Cash dan Kredit'){
      // Saldo Kas
      $data_saldo = array(
        'iduser' => $id,
        'saldo_kas' => $saldo_kas+$this->input->post('cash')
      );
      $this->m_akum->update_saldo_kas($id,$data_saldo);

			// Piutang
      $data_piutang = array(
        'iduser' => $id,
        'jenis_piutang' => "usaha",
        'nama_piutang' => $this->input->post('penjualanke'),
        'nilai_piutang' => $this->input->post('sisa_kredit'),
        'tanggal_transaksi' => $this->input->post('tanggal_penjualan'),
        'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
        'bukti_transaksi' => $bukti_piutang,
        'keterangan' => $this->input->post('notes_harga_lainnya'),
        'status' => $status
      );
			$this->m_akum->create_piutang($data_piutang);
			$cash = $this->input->post('cash');
			$kredit = $this->input->post('sisa_kredit');
    }

		// Penjualan
		$data_penjualan = array(
			  'iduser' => $id,
    		'penjualanke' => $this->input->post('penjualanke'),
    		'nama_barang' => $this->input->post('nama_barang'),
    		'jenis_barang' => $this->input->post('jenis_barang'),
    		'satuan' => $this->input->post('satuan'),
    		'jumlah' => $this->input->post('jumlah_barang'),
    		'diskon' => $this->input->post('diskon'),
    		'harga_diskon' => $this->input->post('diskon'),
    		'harga_barang' => $this->input->post('harga_satuan'),
    		'harga_lainnya' => $this->input->post('harga_lainnya'),
    		'total_harga' => $this->input->post('total_harga'),
    		'harga_pokok_penjualan' => $this->input->post('harga_pokok_penjualan'),
    		'jenis_pembayaran' => $tipe_pembayaran,
    		'total_cash' => $cash,
    		'total_credit' => $kredit,
    		'tanggal_penjualan' => $this->input->post('tanggal_penjualan'),
    		'bukti_penjualan' => $bukti_transaksi,
    		'notes_harga_lainnya' => $this->input->post('notes_harga_lainnya'),
			  'created_date' => date('Y-m-d H:i:s')
    	);
        $this->m_akum->create_transaksi_pokok_penjualan($data_penjualan);

		// Barang Dagangan
        $data_barang = array(
        	'jumlah_barang' => $this->input->post('jumlah') - $this->input->post('jumlah_barang'),
        	'total_nilai_barang' => ($this->input->post('jumlah')*$this->input->post('harga_barang_satuan')) - ($this->input->post('harga_barang_satuan')*$this->input->post('jumlah_barang')),
          'total_harga_barang' => $this->input->post('total_harga_brg') - $this->input->post('total_harga')
        );
        $this->m_akum->edit_barang_dagang($id_barang,$data_barang);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Transaksi Penjualan berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('transaksi_pokok/penjualan');
	}

	// Pembayaran Hutang
	public function pembayaran_hutang(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_pokok/pembayaran_hutang',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_transaksi_pokok_pembayaran_hutang() {
		$id = $this->session->userdata('id');
		$idhutang = $this->input->post('hutang_id');
		$saldo_kas = $this->input->post('saldo_kas');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Bayar_Hutang/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		// Bayar Hutang
		$data_bayar_hutang = array(
			'hutang_id' => $this->input->post('hutang_id'),
    		'nilai_bayar' => $this->input->post('nilai_bayar'),
    		'tanggal' => $this->input->post('tanggal'),
    		'keterangan' => $this->input->post('keterangan'),
    		'foto_bukti' => $bukti_transaksi
    	);
        $this->m_akum->create_transaksi_pokok_pembayaran_hutang($data_bayar_hutang);

		// Hutang
        $data_hutang = array(
			'nilai_hutang' => $this->input->post('nhutang')-$this->input->post('nilai_bayar')
    	);
        $this->m_akum->edit_hutang($idhutang,$data_hutang);

		// Saldo Kas
        $data_saldo = array(
			'saldo_kas' => $saldo_kas-$this->input->post('nilai_bayar')
    	);
        $this->m_akum->update_saldo_kas($id,$data_saldo);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pembayaran Hutang berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('transaksi_pokok/pembayaran_hutang');
	}

	// Penerimaan Piutang
	public function penerimaan_piutang(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_pokok/penerimaan_piutang',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_transaksi_pokok_penerimaan_piutang() {
		$id = $this->session->userdata('id');
		$idpiutang = $this->input->post('piutang_id');
		$saldo_kas = $this->input->post('saldo_kas');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Bayar_Piutang/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		// Bayar Piutang
		$data_bayar_piutang = array(
			'piutang_id' => $this->input->post('piutang_id'),
    		'nilai_bayar' => $this->input->post('nilai_bayar'),
    		'tanggal' => $this->input->post('tanggal'),
    		'keterangan' => $this->input->post('keterangan'),
    		'foto_bukti' => $bukti_transaksi
    	);
        $this->m_akum->create_transaksi_pokok_penerimaan_piutang($data_bayar_piutang);

		// Piutang
        $data_piutang = array(
			'nilai_piutang' => $this->input->post('npiutang')-$this->input->post('nilai_bayar')
    	);
        $this->m_akum->edit_piutang($idpiutang,$data_piutang);

		// Saldo Kas
        $data_saldo = array(
			'saldo_kas' => $saldo_kas+$this->input->post('nilai_bayar')
    	);
        $this->m_akum->update_saldo_kas($id,$data_saldo);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Penerimaan Piutang berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('transaksi_pokok/penerimaan_piutang');
	}

}
