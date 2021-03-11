<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adjustment extends CI_Controller {

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

	// Adjustment Pembelian
	public function index(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM pembelian WHERE iduser = '".$this->session->userdata('id')."' GROUP BY id DESC");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_pembelian(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pembelian',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_pembelian_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->m_akum->update_pembelian($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pembelian',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pembelian() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idpembelian = $this->input->post('id');
		$query_sld = $this->db->query('SELECT * FROM saldo_kas where iduser = "'.$id.'"');
		$saldo_kas = 0;
		foreach ($query_sld->result() as $val2) {
			$saldo_kas += $val2->saldo_kas;
		}

		$idbarang = $this->input->post('idbarang');
		$query_brg = $this->db->query('SELECT * FROM barang_dagangan where id = "'.$idbarang.'"');
		$jml_brg = 0;
		foreach ($query_brg->result() as $val) {
			$jml_brg += $val->jumlah_barang;
		}
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

		if ($tipe_pembayaran=='Cash') {
			$cash = $this->input->post('total_harga');
			$kredit = "";
		}else if ($tipe_pembayaran=='Kredit') {
			$cash = "";
			$kredit = $this->input->post('total_harga');
		}else if ($tipe_pembayaran=='Cash dan Kredit') {
			$cash = $this->input->post('cash');
			$kredit = $this->input->post('sisa_kredit');
		}

		if ($op=='tambah') {
			if ($idbarang==0) {
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
					'total_nilai_barang' => $this->input->post('jumlah') * $this->input->post('harga_barang'),
				);
				$this->m_akum->create_barang_dagang($data_barang_dagangan);
				// Hutang
				$data_hutang = array(
					'iduser' => $id,
					'nama_hutang' => $this->input->post('nama_barang'),
					'jenis_hutang' => 'usaha',
					'jenis_hutang_lainnya' => '',
					'nilai_hutang' => $this->input->post('total_harga'),
					'tgl_transaksi' => $this->input->post('tanggal_pembelian'),
					'tgl_jatuh_tempo' => '',
					'bukti_transaksi' => $bukti_hutang,
					'keterangan' => $this->input->post('notes_harga_lainnya'),
					'status' => ''
				);
				$this->m_akum->create_hutang($data_hutang);
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
				);
				$this->m_akum->edit_barang_dagang($idbarang,$data_barang_dagangan);
				// Saldo Kas
				$data_saldo_kas = array(
					'iduser' => $id,
					'saldo_kas' => $saldo_kas - $this->input->post('total_harga'),
				);
				$this->m_akum->update_saldo_kas($id,$data_saldo_kas);
			}
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pembelian berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
				$finfo = $this->upload->data();
				$bukti_pembelian = $finfo['file_name'];

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

					$kode_id = array('id'=>$id);
					$gambar_db = $this->db->get_where('pembelian',$kode_id);
					if($gambar_db->num_rows()>0){
						$pros=$gambar_db->row();
						$name_gambar=$pros->bukti_pembelian;

						if(file_exists($lok=FCPATH.'Foto/Pembelian/'.$name_gambar)){
						unlink($lok);
						}
					}
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
					'notes_harga_lainnya' => $this->input->post('notes_harga_lainnya'),
					'date' => date('Y-m-d H:i:s')
				);
			}
			$this->m_akum->edit_pembelian($idpembelian,$data_pembelian);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Pembelian berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment');
	}
	public function delete_pembelian() {
		$id = $this->input->post('id');
		$this->m_akum->delete_pembelian($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pembelian berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment');
	}

	// Adjustment Penjualan
	public function penjualan(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = '".$this->session->userdata('id')."' GROUP BY id DESC");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_penjualan(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sql'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_penjualan_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->m_akum->update_penjualan($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_penjualan() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idpenjualan = $this->input->post('id');
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

		if ($op=='tambah') {
			if ($tipe_pembayaran=='Cash') {
				// Saldo Kas
				$data_saldo = array(
					'saldo_kas' => $saldo_kas+$this->input->post('total_harga')
				);
				$this->m_akum->update_saldo_kas($id,$data_saldo);
				$cash = $this->input->post('total_harga');
				$kredit = "";
			}else if ($tipe_pembayaran=='Kredit') {
				// Piutang
				$data_piutang = array(
					'iduser' => $id,
					'jenis_piutang' => "usaha",
					'nama_piutang' => $this->input->post('nama_barang'),
					'nilai_piutang' => $this->input->post('total_harga'),
					'tanggal_transaksi' => $this->input->post('tanggal_penjualan'),
					'tanggal_jatuh_tempo' => date('Y-m-d'),
					'bukti_transaksi' => $bukti_piutang,
					'keterangan' => $this->input->post('notes_harga_lainnya')
				);
				$this->m_akum->create_piutang($data_piutang);
				$cash = "";
				$kredit = $this->input->post('total_harga');
			}else{
				// Saldo Kas
				$data_saldo = array(
					'saldo_kas' => $saldo_kas+$this->input->post('cash')
				);
				$this->m_akum->update_saldo_kas($id,$data_saldo);
	
				// Piutang
				$data_piutang = array(
					'iduser' => $id,
					'jenis_piutang' => "usaha",
					'nama_piutang' => $this->input->post('nama_barang'),
					'nilai_piutang' => $this->input->post('sisa_kredit'),
					'tanggal_transaksi' => $this->input->post('tanggal_penjualan'),
					'tanggal_jatuh_tempo' => date('Y-m-d'),
					'bukti_transaksi' => $bukti_piutang,
					'keterangan' => $this->input->post('notes_harga_lainnya')
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
				'total_nilai_barang' => $this->input->post('harga_satuan') * ($this->input->post('jumlah') - $this->input->post('jumlah_barang'))
			);
			$this->m_akum->edit_barang_dagang($id_barang,$data_barang);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Penjualan berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
				$finfo = $this->upload->data();
				$bukti_transaksi = $finfo['file_name'];

				if ($tipe_pembayaran=='Cash') {
					$cash = $this->input->post('total_harga');
					$kredit = "";
				}else if ($tipe_pembayaran=='Kredit') {
					$cash = "";
					$kredit = $this->input->post('total_harga');
				}else{
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

				$kode_id = array('id'=>$id);
				$gambar_db = $this->db->get_where('penjualan',$kode_id);
				if($gambar_db->num_rows()>0){
					$pros=$gambar_db->row();
					$name_gambar=$pros->bukti_penjualan;

					if(file_exists($lok=FCPATH.'Foto/Penjualan/'.$name_gambar)){
					unlink($lok);
					}
				}
			}else{
				if ($tipe_pembayaran=='Cash') {
					$cash = $this->input->post('total_harga');
					$kredit = "";
				}else if ($tipe_pembayaran=='Kredit') {
					$cash = "";
					$kredit = $this->input->post('total_harga');
				}else{
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
					'notes_harga_lainnya' => $this->input->post('notes_harga_lainnya'),
					'created_date' => date('Y-m-d H:i:s')
				);
			}
			$this->m_akum->edit_penjualan($idpenjualan,$data_penjualan);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Penjualan berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment/penjualan');
	}
	public function delete_penjualan() {
		$id = $this->input->post('id');
		$this->m_akum->delete_penjualan($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Penjualan berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/penjualan');
	}

	// Adjustment Retur Pembelian
	public function retur_pembelian(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM retur WHERE jenis_retur = 'Pembelian' AND iduser = '".$this->session->userdata('id')."' GROUP BY id DESC");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/retur_pembelian',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_retur_pembelian(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sql'] = $this->db->query("SELECT * FROM pembelian WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/retur_pembelian',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_retur_pembelian_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->db->query("SELECT * FROM pembelian WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->m_akum->update_retur($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/retur_pembelian',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_retur_pembelian() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idretur = $this->input->post('id');
		$idpembelian = $this->input->post('pembelian_dari');
		$total_harga = $this->input->post('total_harga');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Retur_Pembelian/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_pembelian = $finfo['file_name'];

		if ($op=='tambah') {
			// Retur
			$data_retur = array(
				'iduser' => $id,
				'nama_barang' => $this->input->post('pembelian_dari'),
				'jenis_retur' => 'Pembelian',
				'jumlah' => $this->input->post('jumlah_retur'),
				'tgl_retur' => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
				'bukti_pembelian' => $bukti_pembelian,
				'created_date' => date('Y-m-d H:i:s')
			);
			$this->m_akum->create_retur($data_retur);
			
			// Piutang
			$data_piutang = array(
				'iduser' => $id,
				'nama_piutang' => $this->input->post('pembelian_dari'),
				'jenis_piutang' => 'retur',
				'nilai_piutang' => $this->input->post('jumlah_retur')*$this->input->post('total_harga'),
				'tanggal_transaksi' => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
			);
			$this->m_akum->create_piutang($data_piutang);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Pembelian berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
				$finfo = $this->upload->data();
				$bukti_pembelian = $finfo['file_name'];

				// Retur
				$data_retur = array(
					'iduser' => $id,
					'nama_barang' => $this->input->post('pembelian_dari'),
					'jenis_retur' => 'Pembelian',
					'jumlah' => $this->input->post('jumlah_retur'),
					'tgl_retur' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan'),
					'bukti_pembelian' => $bukti_pembelian,
					'created_date' => date('Y-m-d H:i:s')
				);

				$kode_id = array('id'=>$id);
				$gambar_db = $this->db->get_where('retur',$kode_id);
				if($gambar_db->num_rows()>0){
					$pros=$gambar_db->row();
					$name_gambar=$pros->bukti_pembelian;

					if(file_exists($lok=FCPATH.'Foto/Retur_Pembelian/'.$name_gambar)){
					unlink($lok);
					}
				}
			}else{
				// Retur
				$data_retur = array(
					'iduser' => $id,
					'nama_barang' => $this->input->post('pembelian_dari'),
					'jenis_retur' => 'Pembelian',
					'jumlah' => $this->input->post('jumlah_retur'),
					'tgl_retur' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan'),
					'created_date' => date('Y-m-d H:i:s')
				);
			}
			$this->m_akum->edit_retur($idretur,$data_retur);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Pembelian berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment/retur_pembelian');
	}
	public function delete_retur_pembelian() {
		$id = $this->input->post('id');
		$this->m_akum->delete_retur($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Pembelian berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/retur_pembelian');
	}

	// Adjustment Retur Penjualan
	public function retur_penjualan(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM retur WHERE jenis_retur = 'Penjualan' AND iduser = '".$this->session->userdata('id')."' GROUP BY id DESC");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/retur_penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_retur_penjualan(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sql'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/retur_penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_retur_penjualan_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->m_akum->update_retur($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/retur_penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_retur_penjualan() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idretur = $this->input->post('id');
		$idpembelian = $this->input->post('pembelian_dari');
		$total_harga = $this->input->post('total_harga');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Retur_Penjualan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_pembelian = $finfo['file_name'];

		if ($op=='tambah') {
			// Retur
			$data_retur = array(
				'iduser' => $id,
				'nama_barang' => $this->input->post('pembelian_dari'),
				'jenis_retur' => 'Penjualan',
				'jumlah' => $this->input->post('jumlah_retur'),
				'tgl_retur' => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
				'bukti_pembelian' => $bukti_pembelian,
				'created_date' => date('Y-m-d H:i:s')
			);
			$this->m_akum->create_retur($data_retur);
			
			// Hutang
			$data_hutang = array(
				'iduser' => $id,
				'nama_hutang' => $this->input->post('pembelian_dari'),
				'jenis_hutang' => 'retur',
				'nilai_hutang' => $this->input->post('jumlah_retur')*$this->input->post('total_harga'),
				'tgl_transaksi' => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
			);
			$this->m_akum->create_hutang($data_hutang);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Penjualan berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
				$finfo = $this->upload->data();
				$bukti_pembelian = $finfo['file_name'];

				// Retur
				$data_retur = array(
					'iduser' => $id,
					'nama_barang' => $this->input->post('pembelian_dari'),
					'jenis_retur' => 'Penjualan',
					'jumlah' => $this->input->post('jumlah_retur'),
					'tgl_retur' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan'),
					'bukti_pembelian' => $bukti_pembelian,
					'created_date' => date('Y-m-d H:i:s')
				);

				$kode_id = array('id'=>$id);
				$gambar_db = $this->db->get_where('retur',$kode_id);
				if($gambar_db->num_rows()>0){
					$pros=$gambar_db->row();
					$name_gambar=$pros->bukti_pembelian;

					if(file_exists($lok=FCPATH.'Foto/Retur_Penjualan/'.$name_gambar)){
					unlink($lok);
					}
				}
			}else{
				// Retur
				$data_retur = array(
					'iduser' => $id,
					'nama_barang' => $this->input->post('pembelian_dari'),
					'jenis_retur' => 'Penjualan',
					'jumlah' => $this->input->post('jumlah_retur'),
					'tgl_retur' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan'),
					'created_date' => date('Y-m-d H:i:s')
				);
			}
			$this->m_akum->edit_retur($idretur,$data_retur);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Penjualan berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment/retur_penjualan');
	}
	public function delete_retur_penjualan() {
		$id = $this->input->post('id');
		$this->m_akum->delete_retur($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Penjualan berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/retur_penjualan');
	}

	// Adjustment Pemasukan
	public function pemasukan(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM pemasukan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/pemasukan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	// Adjustment Pengeluaran
	public function pengeluaran(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM pengeluaran WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/pengeluaran',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	// Adjustment Activa Tetap
	public function activa_tetap(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/activa_tetap',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_activa_tetap(){
		$data['title'] = 'Akum';
		$data['stepsix'] = 'Tanah';
		$data['op'] = 'tambah';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/activa_tetap',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_activa_tetap_edit($id){
		$data['title'] = 'Akum';
		$data['stepsix'] = 'Tanah';
		$data['op'] = 'edit';
		$data['sql'] = $this->m_akum->update_activa_tetap($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/activa_tetap',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_activa_tetap() {
		$iduser = $this->session->userdata('id');
		$op = $this->input->post('op');
	    $id = $this->input->post('id');
	    $jenis_activa = $this->input->post('jenis_activa');
	    $nilai_tanah = $this->input->post('nilai_tanah');
		if ($op=='tambah') {
	    	if ($jenis_activa=='Tanah') {
	    		$data = array(
					'iduser' => $iduser,
		    		'jenis_activa' => $this->input->post('jenis_activa'),
		    		'nama_activa' => $this->input->post('nama_activa'),
		    		'nilai_tanah' => $nilai_tanah,
		    		'tahun_beli' => $this->input->post('tahun_beli'),
		    		'alamat' => $this->input->post('alamat'),
		    		'no_sertifikat' => $this->input->post('no_sertifikat')
		    	);
	    	}else{
	    		$akumulasi_penyusutan = $this->input->post('akumulasi_penyusutan');
				$harga_sisa = $this->input->post('harga_sisa');
	    		$data = array(
					'iduser' => $iduser,
		    		'jenis_activa' => $this->input->post('jenis_activa'),
		    		'nama_activa' => $this->input->post('nama_activa'),
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
		    		'no_sertifikat' => $this->input->post('no_sertifikat')
		    	);
	    	}
	        $this->m_akum->create_activa_tetap($data);
	        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Activa tetap berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
			redirect('adjustment/activa_tetap');
	    }else{
	    	if ($jenis_activa=='Tanah') {
	    		$data = array(
		    		'jenis_activa' => $this->input->post('jenis_activa'),
		    		'nama_activa' => $this->input->post('nama_activa'),
		    		'nilai_tanah' => $nilai_tanah,
		    		'tahun_beli' => $this->input->post('tahun_beli'),
		    		'alamat' => $this->input->post('alamat'),
		    		'no_sertifikat' => $this->input->post('no_sertifikat')
		    	);
	    	}else{
	    		$akumulasi_penyusutan = $this->input->post('akumulasi_penyusutan');
				$harga_sisa = $this->input->post('harga_sisa');
	    		$data = array(
		    		'jenis_activa' => $this->input->post('jenis_activa'),
		    		'nama_activa' => $this->input->post('nama_activa'),
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
		    		'no_sertifikat' => $this->input->post('no_sertifikat')
		    	);
	    	}
	        $this->m_akum->edit_activa_tetap($id,$data);
	        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Activa tetap berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
			redirect('adjustment/activa_tetap');
	    }
	}
	public function delete_activa_tetap() {
		$id = $this->input->post('id');
		$this->m_akum->delete_activa_tetap($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Activa tetap berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/activa_tetap');
	}

	// Adjustment Activa Lainnya
	public function activa_lainnya(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM activa_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/activa_lainnya',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_activa_lainnya(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['stepseven'] = 'baru';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/activa_lainnya',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_activa_lainnya_edit($id){
		$data['title'] = 'Akum';
		$data['stepsix'] = 'baru';
		$data['op'] = 'edit';
		$data['sql'] = $this->m_akum->update_activa_lainnya($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/activa_lainnya',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_activa_lainnya() {
		$iduser = $this->session->userdata('id');
		$op = $this->input->post('op');
		$id = $this->input->post('id');
		$jenis_activa = $this->input->post('jenis_activa');
		$akumulasi_penyusutan = $this->input->post('akumulasi_penyusutan');
		$harga_sisa = $this->input->post('harga_sisa');
	    if ($op=='tambah') {
			if ($jenis_activa=='BARU') {
				$data = array(
					'iduser' => $iduser,
					'jenis_activa' => $jenis_activa,
					'nama_activa' => $this->input->post('nama_activa'),
					'nama_penjual' => $this->input->post('nama_penjual'),
					'nilai_activa' => $this->input->post('nilai_activa'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi'),
					'kuantitas' => $this->input->post('kuantitas'),
					'tahun_beli' => $this->input->post('tahun_beli'),
					'bulan_sisa' => $this->input->post('bulan_sisa'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai'),
		    		'akumulasi_penyusutan' => $akumulasi_penyusutan,
					'harga_sisa' => $harga_sisa,
					'status' => 'Aktif'
				);
			}else{
				$data = array(
					'iduser' => $iduser,
					'jenis_activa' => $jenis_activa,
					'nama_activa' => $this->input->post('nama_activa'),
					'nama_penjual' => $this->input->post('nama_penjual'),
					'nilai_activa' => $this->input->post('nilai_activa'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi'),
					'kuantitas' => $this->input->post('kuantitas'),
					'tahun_berdiri' => $this->input->post('tahun_berdiri'),
					'tahun_beli' => $this->input->post('tahun_beli'),
					'bulan_sisa' => $this->input->post('bulan_sisa'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai'),
		    		'akumulasi_penyusutan' => $akumulasi_penyusutan,
					'harga_sisa' => $harga_sisa,
					'status' => 'Aktif'
				);
			}
	    	
	        $this->m_akum->create_activa_lainnya($data);
	        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Activa Lainnya berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
			redirect('adjustment/activa_lainnya');
	    }else{
	    	if ($jenis_activa=='BARU') {
				$data = array(
					'iduser' => $iduser,
					'jenis_activa' => $jenis_activa,
					'nama_activa' => $this->input->post('nama_activa'),
					'nama_penjual' => $this->input->post('nama_penjual'),
					'nilai_activa' => $this->input->post('nilai_activa'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi'),
					'kuantitas' => $this->input->post('kuantitas'),
					'tahun_beli' => $this->input->post('tahun_beli'),
					'bulan_sisa' => $this->input->post('bulan_sisa'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai'),
		    		'akumulasi_penyusutan' => $akumulasi_penyusutan,
					'harga_sisa' => $harga_sisa,
					'status' => 'Aktif'
				);
			}else{
				$data = array(
					'iduser' => $iduser,
					'jenis_activa' => $jenis_activa,
					'nama_activa' => $this->input->post('nama_activa'),
					'nama_penjual' => $this->input->post('nama_penjual'),
					'nilai_activa' => $this->input->post('nilai_activa'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi'),
					'kuantitas' => $this->input->post('kuantitas'),
					'tahun_berdiri' => $this->input->post('tahun_berdiri'),
					'tahun_beli' => $this->input->post('tahun_beli'),
					'bulan_sisa' => $this->input->post('bulan_sisa'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai'),
		    		'akumulasi_penyusutan' => $akumulasi_penyusutan,
					'harga_sisa' => $harga_sisa,
					'status' => 'Aktif'
				);
			}
			
	        $this->m_akum->edit_activa_lainnya($id,$data);
	        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Activa Lainnya berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
			redirect('adjustment/activa_lainnya');
	    }
	}
	public function delete_activa_lainnya() {
		$id = $this->input->post('id');
		$this->m_akum->delete_activa_lainnya($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Activa Lainnya berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/activa_lainnya');
	}

	// Adjustment Hutang Usaha
	public function hutang_usaha(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/hutang_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_hutang_usaha() {
		$id = $this->session->userdata('id');
		$nilai_hutang = $this->input->post('nilai_hutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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
		
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('bukti_transaksi');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];
		$data = array(
			'iduser' => $id,
    		'jenis_hutang' => "usaha",
    		'nama_hutang' => $this->input->post('nama_hutang'),
    		'nilai_hutang' => $nilai_hutang,
    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'bukti_transaksi' => $bukti_transaksi,
			'keterangan' => $this->input->post('keterangan'),
			'status' => $status
    	);
        $this->m_akum->create_hutang($data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Hutang Usaha berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/hutang_usaha');
	}
	function edit_hutang_usaha() {
		$id = $this->input->post('id');
		$nilai_hutang = $this->input->post('nilai_hutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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

		$iduser = $this->input->post('iduser');
		$filename = date("YmdHis")."_".$iduser;
		$config = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload('bukti_transaksi')){
			$finfo = $this->upload->data();
			$bukti_transaksi = $finfo['file_name'];

			$data = array(
	    		'nama_hutang' => $this->input->post('nama_hutang'),
	    		'nilai_hutang' => $nilai_hutang,
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'bukti_transaksi' => $bukti_transaksi,
				'keterangan' => $this->input->post('keterangan'),
				'status' => $status
	    	);

	    	$kode_id = array('id'=>$id);
			$gambar_db = $this->db->get_where('hutang',$kode_id);
			if($gambar_db->num_rows()>0){
				$pros=$gambar_db->row();
				$name_gambar=$pros->bukti_transaksi;

				if(file_exists($lok=FCPATH.'Foto/Hutang/'.$name_gambar)){
				  unlink($lok);
				}
			}
		}else{
			$data = array(
	    		'nama_hutang' => $this->input->post('nama_hutang'),
	    		'nilai_hutang' => $nilai_hutang,
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => $status
	    	);
		}
        $this->m_akum->edit_hutang($id,$data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Hutang Usaha berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/hutang_usaha');
	}
	public function delete_hutang_usaha() {
		$id = $this->input->post('id');
		$this->m_akum->delete_hutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Hutang Usaha berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/hutang_usaha');
	}

	// Adjustment Hutang Non Usaha
	public function hutang_non_usaha(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/hutang_non_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_hutang_non_usaha() {
		$id = $this->session->userdata('id');
		$nilai_hutang = $this->input->post('nilai_hutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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

		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('bukti_transaksi');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];
		$data = array(
			'iduser' => $id,
    		'jenis_hutang' => "lainnya",
    		'nama_hutang' => $this->input->post('nama_hutang'),
    		'nilai_hutang' => $nilai_hutang,
    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'bukti_transaksi' => $bukti_transaksi,
			'keterangan' => $this->input->post('keterangan'),
			'status' => $status
    	);
        $this->m_akum->create_hutang($data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Hutang Non Usaha berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/hutang_non_usaha');
	}
	function edit_hutang_non_usaha() {
		$id = $this->input->post('id');
		$nilai_hutang = $this->input->post('nilai_hutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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

		$iduser = $this->input->post('iduser');
		$filename = date("YmdHis")."_".$iduser;
		$config = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload('bukti_transaksi')){
			$finfo = $this->upload->data();
			$bukti_transaksi = $finfo['file_name'];

			$data = array(
	    		'nama_hutang' => $this->input->post('nama_hutang'),
	    		'nilai_hutang' => $nilai_hutang,
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'bukti_transaksi' => $bukti_transaksi,
				'keterangan' => $this->input->post('keterangan'),
				'status' => $status
	    	);

	    	$kode_id = array('id'=>$id);
			$gambar_db = $this->db->get_where('hutang',$kode_id);
			if($gambar_db->num_rows()>0){
				$pros=$gambar_db->row();
				$name_gambar=$pros->bukti_transaksi;

				if(file_exists($lok=FCPATH.'Foto/Hutang/'.$name_gambar)){
				  unlink($lok);
				}
			}
		}else{
			$data = array(
	    		'nama_hutang' => $this->input->post('nama_hutang'),
	    		'nilai_hutang' => $nilai_hutang,
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => $status
	    	);
		}
        $this->m_akum->edit_hutang($id,$data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Hutang Non Usaha berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/hutang_non_usaha');
	}
	public function delete_hutang_non_usaha() {
		$id = $this->input->post('id');
		$this->m_akum->delete_hutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Hutang Non Usaha berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/hutang_non_usaha');
	}

	// Adjustment Pembayaran Hutang Usaha
	public function pembayaran_hutang_usaha(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT *, bh.keterangan as ket FROM hutang h JOIN bayar_hutang bh ON h.id = bh.hutang_id WHERE h.jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/pembayaran_hutang_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_pembayaran_hutang_usaha(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pembayaran_hutang_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_pembayaran_hutang_usaha_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->m_akum->update_pembayaran_hutang($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pembayaran_hutang_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pembayaran_hutang_usaha() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idbayar = $this->input->post('id');
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

		if ($op=='tambah'){
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
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
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

				$kode_id = array('id'=>$id);
				$gambar_db = $this->db->get_where('bayar_hutang',$kode_id);
				if($gambar_db->num_rows()>0){
					$pros=$gambar_db->row();
					$name_gambar=$pros->foto_bukti;

					if(file_exists($lok=FCPATH.'Foto/Bayar_Hutang/'.$name_gambar)){
					unlink($lok);
					}
				}
			}else{
				// Bayar Hutang
				$data_bayar_hutang = array(
					'hutang_id' => $this->input->post('hutang_id'),
					'nilai_bayar' => $this->input->post('nilai_bayar'),
					'tanggal' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan'),
				);
			}
			$this->m_akum->edit_pembayaran_hutang($idbayar,$data_bayar_hutang);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Pembayaran Hutang Usaha berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment/pembayaran_hutang_usaha');
	}
	public function delete_pembayaran_hutang_usaha() {
		$id = $this->input->post('id');
		$this->m_akum->delete_pembayaran_hutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Hutang Non Usaha berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pembayaran_hutang_usaha');
	}

	// Adjustment Pembayaran Hutang Non Usaha
	public function pembayaran_hutang_non_usaha(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT *, bh.keterangan as ket FROM hutang h JOIN bayar_hutang bh ON h.id = bh.hutang_id WHERE h.jenis_hutang != 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/pembayaran_hutang_non_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_pembayaran_hutang_non_usaha(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pembayaran_hutang_non_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_pembayaran_hutang_non_usaha_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->m_akum->update_pembayaran_hutang($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pembayaran_hutang_non_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pembayaran_hutang_non_usaha() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idbayar = $this->input->post('id');
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

		if ($op=='tambah'){
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
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
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

				$kode_id = array('id'=>$id);
				$gambar_db = $this->db->get_where('bayar_hutang',$kode_id);
				if($gambar_db->num_rows()>0){
					$pros=$gambar_db->row();
					$name_gambar=$pros->foto_bukti;

					if(file_exists($lok=FCPATH.'Foto/Bayar_Hutang/'.$name_gambar)){
					unlink($lok);
					}
				}
			}else{
				// Bayar Hutang
				$data_bayar_hutang = array(
					'hutang_id' => $this->input->post('hutang_id'),
					'nilai_bayar' => $this->input->post('nilai_bayar'),
					'tanggal' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan'),
				);
			}
			$this->m_akum->edit_pembayaran_hutang($idbayar,$data_bayar_hutang);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Pembayaran Hutang berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment/pembayaran_hutang_non_usaha');
	}
	public function delete_pembayaran_hutang_non_usaha() {
		$id = $this->input->post('id');
		$this->m_akum->delete_pembayaran_hutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Hutang Non Usaha berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pembayaran_hutang_non_usaha');
	}

	// Adjustment Piutang Transaksi Pokok
	public function piutang_transaksi_pokok(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT *, bp.keterangan as ket FROM piutang p JOIN bayar_piutang bp ON p.id = bp.piutang_id WHERE p.jenis_piutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/piutang_transaksi_pokok',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_piutang_transaksi_pokok(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/piutang_transaksi_pokok',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_piutang_transaksi_pokok_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->m_akum->update_bayar_piutang($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/piutang_transaksi_pokok',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_piutang_transaksi_pokok() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idbayar = $this->input->post('id');
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

		if ($op=='tambah'){
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

			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Piutang berhasil ditambahkan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
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

				$kode_id = array('id'=>$id);
				$gambar_db = $this->db->get_where('bayar_piutang',$kode_id);
				if($gambar_db->num_rows()>0){
					$pros=$gambar_db->row();
					$name_gambar=$pros->foto_bukti;

					if(file_exists($lok=FCPATH.'Foto/Bayar_Piutang/'.$name_gambar)){
					unlink($lok);
					}
				}
			}else{
				// Bayar Piutang
				$data_bayar_piutang = array(
					'piutang_id' => $this->input->post('piutang_id'),
					'nilai_bayar' => $this->input->post('nilai_bayar'),
					'tanggal' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan')
				);
			}
			$this->m_akum->edit_bayar_piutang($idbayar,$data_bayar_piutang);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Piutang berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment/piutang_transaksi_pokok');
	}
	public function delete_piutang_transaksi_pokok() {
		$id = $this->input->post('id');
		$this->m_akum->delete_bayar_piutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Piutang berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_transaksi_pokok');
	}

	// Adjustment Piutang Non Usaha
	public function piutang_non_usaha(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/piutang_non_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_piutang_non_usaha() {
		$id = $this->session->userdata('id');
		$nilai_piutang = $this->input->post('nilai_piutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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

		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Piutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('bukti_transaksi');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];
		$data = array(
			'iduser' => $id,
    		'jenis_piutang' => "lainnya",
    		'nama_piutang' => $this->input->post('nama_piutang'),
    		'nilai_piutang' => $nilai_piutang,
    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'bukti_transaksi' => $bukti_transaksi,
    		'keterangan' => $this->input->post('keterangan'),
    		'status' => $status
    	);
        $this->m_akum->create_piutang($data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Piutang Lainnya berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_non_usaha');
	}
	function edit_piutang_non_usaha() {
		$id = $this->input->post('id');
		$nilai_piutang = $this->input->post('nilai_piutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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

		$iduser = $this->input->post('iduser');
		$filename = date("YmdHis")."_".$iduser;
		$config = array(
			'upload_path'=>'Foto/Piutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload('bukti_transaksi')){
			$finfo = $this->upload->data();
			$bukti_transaksi = $finfo['file_name'];

			$data = array(
	    		'nama_piutang' => $this->input->post('nama_piutang'),
	    		'nilai_piutang' => $nilai_piutang,
	    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'bukti_transaksi' => $bukti_transaksi,
	    		'keterangan' => $this->input->post('keterangan'),
	    		'status' => $status
	    	);

	    	$kode_id = array('id'=>$id);
			$gambar_db = $this->db->get_where('piutang',$kode_id);
			if($gambar_db->num_rows()>0){
				$pros=$gambar_db->row();
				$name_gambar=$pros->bukti_transaksi;

				if(file_exists($lok=FCPATH.'Foto/Piutang/'.$name_gambar)){
				  unlink($lok);
				}
			}
		}else{
			$data = array(
	    		'nama_piutang' => $this->input->post('nama_piutang'),
	    		'nilai_piutang' => $nilai_piutang,
	    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'keterangan' => $this->input->post('keterangan'),
	    		'status' => $status
	    	);
		}
        $this->m_akum->edit_piutang($id,$data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Piutang Lainnya berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_non_usaha');
	}
	public function delete_piutang_non_usaha() {
		$id = $this->input->post('id');
		$this->m_akum->delete_piutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Piutang Lainnya berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_non_usaha');
	}

	// Adjustment Piutang Transaksi Lainnya
	public function piutang_transaksi_lainnya(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT *, bp.keterangan as ket FROM piutang p JOIN bayar_piutang bp ON p.id = bp.piutang_id WHERE p.jenis_piutang != 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/piutang_transaksi_lainnya',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_piutang_transaksi_lainnya(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/piutang_transaksi_lainnya',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	public function form_piutang_transaksi_lainnya_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->m_akum->update_bayar_piutang($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/piutang_transaksi_lainnya',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_piutang_transaksi_lainnya() {
		$id = $this->session->userdata('id');
		$op = $this->input->post('op');
		$idbayar = $this->input->post('id');
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

		if ($op=='tambah'){
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

			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Piutang berhasil ditambahkan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}else{
			$this->upload->initialize($config);
			if($this->upload->do_upload('photo')){
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

				$kode_id = array('id'=>$id);
				$gambar_db = $this->db->get_where('bayar_piutang',$kode_id);
				if($gambar_db->num_rows()>0){
					$pros=$gambar_db->row();
					$name_gambar=$pros->foto_bukti;

					if(file_exists($lok=FCPATH.'Foto/Bayar_Piutang/'.$name_gambar)){
					unlink($lok);
					}
				}
			}else{
				// Bayar Piutang
				$data_bayar_piutang = array(
					'piutang_id' => $this->input->post('piutang_id'),
					'nilai_bayar' => $this->input->post('nilai_bayar'),
					'tanggal' => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan')
				);
			}
			$this->m_akum->edit_bayar_piutang($idbayar,$data_bayar_piutang);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Piutang berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('adjustment/piutang_transaksi_lainnya');
	}
	public function delete_piutang_transaksi_lainnya() {
		$id = $this->input->post('id');
		$this->m_akum->delete_bayar_piutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Piutang berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_transaksi_lainnya');
	}

	// Adjustment Piutang Usaha
	public function piutang_usaha(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/piutang_usaha',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_piutang_usaha() {
		$id = $this->session->userdata('id');
		$nilai_piutang = $this->input->post('nilai_piutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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

		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Piutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('bukti_transaksi');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];
		$data = array(
			'iduser' => $id,
    		'jenis_piutang' => "usaha",
    		'nama_piutang' => $this->input->post('nama_piutang'),
    		'nilai_piutang' => $nilai_piutang,
    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'bukti_transaksi' => $bukti_transaksi,
    		'keterangan' => $this->input->post('keterangan'),
    		'status' => $status
    	);
        $this->m_akum->create_piutang($data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Piutang Usaha berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_usaha');
	}
	function edit_piutang_usaha() {
		$id = $this->input->post('id');
		$nilai_piutang = $this->input->post('nilai_piutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

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

		$iduser = $this->input->post('iduser');
		$filename = date("YmdHis")."_".$iduser;
		$config = array(
			'upload_path'=>'Foto/Piutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload('bukti_transaksi')){
			$finfo = $this->upload->data();
			$bukti_transaksi = $finfo['file_name'];

			$data = array(
	    		'nama_piutang' => $this->input->post('nama_piutang'),
	    		'nilai_piutang' => $nilai_piutang,
	    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'bukti_transaksi' => $bukti_transaksi,
	    		'keterangan' => $this->input->post('keterangan'),
	    		'status' => $status
	    	);

	    	$kode_id = array('id'=>$id);
			$gambar_db = $this->db->get_where('piutang',$kode_id);
			if($gambar_db->num_rows()>0){
				$pros=$gambar_db->row();
				$name_gambar=$pros->bukti_transaksi;

				if(file_exists($lok=FCPATH.'Foto/Piutang/'.$name_gambar)){
				  unlink($lok);
				}
			}
		}else{
			$data = array(
	    		'nama_piutang' => $this->input->post('nama_piutang'),
	    		'nilai_piutang' => $nilai_piutang,
	    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'keterangan' => $this->input->post('keterangan'),
	    		'status' => $status
	    	);
		}
        $this->m_akum->edit_piutang($id,$data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Piutang Usaha berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_usaha');
	}
	public function delete_piutang_usaha() {
		$id = $this->input->post('id');
		$this->m_akum->delete_piutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Piutang Usaha berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/piutang_usaha');
	}

}
