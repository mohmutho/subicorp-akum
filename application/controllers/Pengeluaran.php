<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	// public function piutang_lainnya_pengeluaran(){
	// 	$data['title'] = 'Akum';
	// 	$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
    //     $data['pages'] = $this->load->view('pages/transaksi_lainnya/piutang_lainnya_pengeluaran','',true);
	// 	$this->load->view('main_dashboard',array('main'=>$data));
	// }

	// Pengeluaran Pembelian Asset
	public function pembelian_asset(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM activa_tetap WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/pembelian_asset',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pengeluaran_pembelian_asset() {
		$id = $this->session->userdata('id');
		$jenis_asset = $this->input->post('pilih_jenis_asset');
		$tipe_pembayaran = $this->input->post('jenis_pembayaran');
		$saldo_kas = $this->input->post('saldo_kas');
		$idasset = $this->input->post('id_asset');
		$query = $this->db->query('SELECT * FROM activa_tetap WHERE id = "'.$idasset.'"');
		foreach ($query->result() as $val) {
			$nama_asset= $val->nama_activa;
		}
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pengeluaran/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_hutang = $finfo['file_name'];

		$config3 = array(
			'upload_path'=>'Foto/Activa_Tetap/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config3);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_actetap = $finfo['file_name'];

		$config4 = array(
			'upload_path'=>'Foto/Activa_Lainnya/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config4);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_aclainnya = $finfo['file_name'];

		if ($tipe_pembayaran=='Cash') {
			// Saldo Kas
        	$data_saldo = array(
				'saldo_kas' => $saldo_kas-$this->input->post('total')
	    	);
			$this->m_akum->update_saldo_kas($id,$data_saldo);
			$cash = $this->input->post('total');
			$kredit = "";
        }else if ($tipe_pembayaran=='Kredit') {
			// Hutang
        	$data_hutang = array(
				'iduser' => $id,
	    		'jenis_hutang' => "usaha",
	    		'nama_hutang' => $this->input->post('nama_asset'),
	    		'nilai_hutang' => $this->input->post('total'),
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'bukti_transaksi' => $bukti_hutang
	    	);
			$this->m_akum->create_hutang($data_hutang);
			$cash = "";
			$kredit = $this->input->post('total');
        }else{
			// Saldo Kas
        	$data_saldo = array(
				'saldo_kas' => $saldo_kas-$this->input->post('cash')
	    	);
	        $this->m_akum->update_saldo_kas($id,$data_saldo);

			// Hutang
        	$data_hutang = array(
				'iduser' => $id,
	    		'jenis_hutang' => "usaha",
	    		'nama_hutang' => $this->input->post('nama_asset'),
	    		'nilai_hutang' => $this->input->post('sisa_kredit'),
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'bukti_transaksi' => $bukti_hutang
	    	);
			$this->m_akum->create_hutang($data_hutang);
			$cash = $this->input->post('cash');
			$kredit = $this->input->post('sisa_kredit');
		}
		
		$nilai_tanah = $this->input->post('nilai_tanah');
		if($jenis_asset=='Tanah'){
			// Activa Tetap Tanah
			$data_actetap = array(
				'iduser' => $id,
				'jenis_activa' => $jenis_asset,
				'nama_activa' => $this->input->post('nama_asset'),
				'nilai_tanah' => $nilai_tanah,
				'tahun_beli' => $this->input->post('tahun_beli'),
				'alamat' => $this->input->post('alamat'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'bukti_bayar' => $bukti_actetap
			);
			$this->m_akum->create_activa_tetap($data_actetap);
		}else if($jenis_asset=='Tanah dan Bangunan'){
			$akumulasi_penyusutan = $this->input->post('akumulasi_penyusutan');
			$harga_sisa = $this->input->post('harga_sisa');
			$data = array(
				'iduser' => $id,
				'jenis_activa' => $jenis_asset,
				'nama_activa' => $this->input->post('nama_asset'),
				'nilai_tanah' => $nilai_tanah,
				'nilai_bangunan' => $this->input->post('nilai_bangunan'),
				'jenis_bangunan' => $this->input->post('jenis_bangunan'),
				'nilai_ekonomi' => $this->input->post('nilai_ekonomi'),
				'tahun_berdiri' => $this->input->post('tahun_berdiri'),
				'tahun_beli' => $this->input->post('tahun_beli'),
				'bulan_sisa' => $this->input->post('bulan_sisa'),
				'bulan_terpakai' => $this->input->post('bulan_terpakai'),
				'akumulasi_penyusutan' => $akumulasi_penyusutan,
				'harga_sisa' => $harga_sisa,
				'alamat' => $this->input->post('alamat'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'bukti_bayar' => $bukti_actetap
			);
			$this->m_akum->create_activa_tetap($data);
		}else{
			$jenis_asset_lainnya = $this->input->post('pilih_jenis_asset_lainnya');
			if($jenis_asset_lainnya=="BARU"){
				// Baru
				$data_aclainnya = array(
					'iduser' => $id,
					'jenis_activa' => $jenis_asset_lainnya,
					'nama_activa' => $this->input->post('nama_asset'),
					'nama_penjual' => $this->input->post('nama_penjual'),
					'nilai_activa' => $this->input->post('nilai_activa'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi_lainnya'),
					'kuantitas' => $this->input->post('jumlah'),
					'tahun_beli' => $this->input->post('tahun_beli_lainnya'),
					'bulan_sisa' => $this->input->post('bulan_sisa_lainnya'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai_lainnya'),
		    		'akumulasi_penyusutan' => $this->input->post('akumulasi_penyusutan_lainnya'),
					'harga_sisa' => $this->input->post('harga_sisa_lainnya'),
					'status' => 'Aktif',
					'bukti_bayar' => $bukti_aclainnya
				);
			}else{
				// Bekas
				$data_aclainnya = array(
					'iduser' => $id,
					'jenis_activa' => $jenis_asset_lainnya,
					'nama_activa' => $this->input->post('nama_asset'),
					'nama_penjual' => $this->input->post('nama_penjual'),
					'nilai_activa' => $this->input->post('nilai_activa'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi_lainnya'),
					'kuantitas' => $this->input->post('jumlah'),
					'tahun_berdiri' => $this->input->post('tahun_berdiri_lainnya'),
					'tahun_beli' => $this->input->post('tahun_beli_lainnya'),
					'bulan_sisa' => $this->input->post('bulan_sisa_lainnya'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai_lainnya'),
		    		'akumulasi_penyusutan' => $this->input->post('akumulasi_penyusutan_lainnya'),
					'harga_sisa' => $this->input->post('harga_sisa_lainnya'),
					'status' => 'Aktif',
					'bukti_bayar' => $bukti_aclainnya
				);
			}
			$this->m_akum->create_activa_lainnya($data_aclainnya);
		}
		
		// Pengeluaran
		$data_pengeluaran = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Pembelian Asset',
			'nama_transaksi' => $this->input->post('nama_asset'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('total'),
			'jenis_pembayaran' => $tipe_pembayaran,
			'cash' => $cash,
			'kredit' => $kredit,
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pengeluaran($data_pengeluaran);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pembelian Asset berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pengeluaran/pembelian_asset');
	}

	// Pengeluaran Biaya
	public function biaya_pengeluaran(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/biaya_pengeluaran','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pengeluaran_biaya() {
		$id = $this->session->userdata('id');
		$tipe_pembayaran = $this->input->post('jenis_pembayaran');
		$query = $this->db->query('SELECT * FROM saldo_kas where iduser = '.$id.'');
		$saldo_kas = 0;
		foreach ($query->result() as $val) {
			$saldo_kas+=$val->saldo_kas;
		}
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pengeluaran/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_hutang = $finfo['file_name'];

		if ($tipe_pembayaran=='Cash') {
			// Saldo Kas
        	$data_saldo = array(
				'saldo_kas' => $saldo_kas-$this->input->post('total')
	    	);
			$this->m_akum->update_saldo_kas($id,$data_saldo);
			$cash = $this->input->post('total');
			$kredit = "";
        }else if ($tipe_pembayaran=='Kredit') {
			// Hutang
        	$data_hutang = array(
				'iduser' => $id,
	    		'jenis_hutang' => "usaha",
	    		'nama_hutang' => $this->input->post('nama_biaya'),
	    		'nilai_hutang' => $this->input->post('total'),
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'bukti_transaksi' => $bukti_hutang
	    	);
			$this->m_akum->create_hutang($data_hutang);
			$cash = "";
			$kredit = $this->input->post('total');
        }else{
			// Saldo Kas
        	$data_saldo = array(
				'saldo_kas' => $saldo_kas-$this->input->post('cash')
	    	);
	        $this->m_akum->update_saldo_kas($id,$data_saldo);

			// Hutang
        	$data_hutang = array(
				'iduser' => $id,
	    		'jenis_hutang' => "usaha",
	    		'nama_hutang' => $this->input->post('nama_biaya'),
	    		'nilai_hutang' => $this->input->post('sisa_kredit'),
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'bukti_transaksi' => $bukti_hutang
	    	);
			$this->m_akum->create_hutang($data_hutang);
			$cash = $this->input->post('cash');
			$kredit = $this->input->post('sisa_kredit');
        }
		
		// Pengeluaran
		$data_pengeluaran = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Biaya Biaya',
			'nama_transaksi' => $this->input->post('nama_biaya'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('total'),
			'jenis_pembayaran' => $tipe_pembayaran,
			'cash' => $cash,
			'kredit' => $kredit,
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pengeluaran($data_pengeluaran);

		// Biaya Biaya
		$data_biaya = array(
			'iduser' => $id,
			'nama_biaya' => $this->input->post('nama_biaya'),
			'nilai' => $this->input->post('total'),
			'tgl_dikeluarkan' => $this->input->post('tanggal_transaksi'),
    	);
		$this->m_akum->create_biaya($data_biaya);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pengeluaran Biaya berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pengeluaran/biaya_pengeluaran');
	}

	// Pengeluaran Modal
	public function modal_pengeluaran(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/modal_pengeluaran','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pengeluaran_modal() {
		$id = $this->session->userdata('id');
		$query = $this->db->query('SELECT * FROM saldo_kas where iduser = '.$id.'');
		$saldo_kas = 0;
		foreach ($query->result() as $val) {
			$saldo_kas+=$val->saldo_kas;
		}
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pengeluaran/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		// Modal
		$data_modal = array(
			'iduser' => $id,
    		'jumlah_modal' => $this->input->post('jumlah_modal'),
    		'jenis' => 'Pengeluaran',
    		'tgl_disetor' => $this->input->post('tanggal_transaksi'),
    		'bukti_setor' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan_modal($data_modal);
		
		// Pemasukan
		$data_pengeluaran = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Modal',
			'nama_transaksi' => 'Modal Diambil',
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('jumlah_modal'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('jumlah_modal'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pengeluaran($data_pengeluaran);
		
		// Saldo Kas
		$data_saldo = array(
			'saldo_kas' => $saldo_kas - $this->input->post('jumlah_modal')
    	);
		$this->m_akum->update_saldo_kas($id,$data_saldo);
		
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pengeluaran Modal berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pengeluaran/modal_pengeluaran');
	}

	// Pengeluaran Dividen
	public function dividen(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/dividen','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pengeluaran_dividen() {
		$id = $this->session->userdata('id');
		$query = $this->db->query('SELECT * FROM saldo_kas where iduser = '.$id.'');
		$saldo_kas = 0;
		foreach ($query->result() as $val) {
			$saldo_kas+=$val->saldo_kas;
		}
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pengeluaran/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		// Dividen
		$data_dividen = array(
			'iduser' => $id,
    		'nama_dividen' => $this->input->post('nama_dividen'),
    		'nilai_dividen' => $this->input->post('nilai_dividen'),
    		'tgl_dividen' => $this->input->post('tanggal_transaksi')
    	);
		$this->m_akum->create_dividen($data_dividen);
		
		// Pengeluaran
		$data_pengeluaran = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Dividen',
			'nama_transaksi' => $this->input->post('nama_dividen'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('nilai_dividen'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('nilai_dividen'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pengeluaran($data_pengeluaran);
		
		// Saldo Kas
		$data_saldo = array(
			'saldo_kas' => $saldo_kas - $this->input->post('nilai_dividen')
    	);
		$this->m_akum->update_saldo_kas($id,$data_saldo);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pengeluaran Dividen berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pengeluaran/dividen');
	}

	// Pengeluaran Hibah
	public function hibah_pengeluaran(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM activa_tetap WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM activa_lainnya WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/hibah_pengeluaran',$data,true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pengeluaran_hibah() {
		$id = $this->session->userdata('id');
		$jenis_hibah = $this->input->post('pilih_jenis_hibah');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pengeluaran/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Activa_Tetap/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_actetap = $finfo['file_name'];

		$config3 = array(
			'upload_path'=>'Foto/Activa_Lainnya/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config3);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_aclainnya = $finfo['file_name'];

		if($jenis_hibah=='Tanah' OR $jenis_hibah=='Tanah dan Bangunan'){
			$data_actetap = array(
				'iduser' => $id,
				'jenis_activa' => $this->input->post('pilih_jenis_hibah'),
				'nama_activa' => $this->input->post('nama_hibah'),
				'nilai_tanah' => $this->input->post('nilai_barang'),
				'tahun_beli' => $this->input->post('tanggal_transaksi'),
				'bukti_bayar' => $bukti_actetap
			);
			$this->m_akum->create_activa_tetap($data_actetap);
		}else{
			$data_aclainnya = array(
				'iduser' => $id,
				'jenis_activa' => 'BARU',
				'nama_activa' => $this->input->post('nama_barang'),
				'nama_penjual' => $this->input->post('nama_hibah'),
				'nilai_activa' => $this->input->post('nilai_barang'),
				'tahun_beli' => $this->input->post('tanggal_transaksi'),
				'bukti_bayar' => $bukti_aclainnya
			);
			$this->m_akum->create_activa_lainnya($data_aclainnya);
		}
		
		// Pengeluaran
		$data_pengeluaran = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Hibah',
			'nama_transaksi' => $this->input->post('nama_hibah'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('nilai_barang'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('nilai_barang'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pengeluaran($data_pengeluaran);

		// Hibah
		$data_hibah = array(
			'iduser' => $id,
			'jenis_hibah' => 'Pengeluaran',
			'nama_penerima' => $this->input->post('nama_hibah'),
			'nama_barang' => $this->input->post('nama_barang'),
			'nilai_barang' => $this->input->post('nilai_barang'),
			'tgl_penerimaan' => $this->input->post('tanggal_transaksi'),
			'keterangan' => $this->input->post('keterangan'),
			'bukti_foto' => $bukti_transaksi
    	);
		$this->m_akum->create_hibah($data_hibah);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pengeluaran Hibah berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pengeluaran/hibah_pengeluaran');
	}

	// Pengeluaran Piutang Lainnya
	// function create_pengeluaran_piutang_lainnya() {
    //     $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pengeluaran Piutang Lainnya berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
	// 	redirect('pengeluaran/piutang_lainnya_pengeluaran');
	// }

}