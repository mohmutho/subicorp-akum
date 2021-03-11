<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	// Retur Pembelian
	public function retur_pembelian(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM pembelian WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_pokok/retur_pembelian',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_retur_pembelian() {
		$id = $this->session->userdata('id');
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

		// Retur
		$data_retur = array(
			'iduser' => $id,
    		'nama_barang' => $this->input->post('pembelian_dari'),
    		'jenis_retur' => 'Pembelian',
    		'jumlah' => $this->input->post('jumlah_retur'),
        'harga_barang' => $this->input->post('harga_barang'),
        'total_harga' => $this->input->post('total_harga_retur'),
    		'tgl_retur' => $this->input->post('tanggal'),
        'tgl_jatuh' => $this->input->post('tanggal_jatuh'),
    		'keterangan' => $this->input->post('keterangan'),
			'bukti_pembelian' => $bukti_pembelian,
			'created_date' => date('Y-m-d H:i:s')
    	);
		$this->m_akum->create_retur($data_retur);
		
		// Piutang
    $tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal'));

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
		$data_piutang = array(
			'iduser' => $id,
    		'nama_piutang' => $this->input->post('pembelian_dari'),
    		'jenis_piutang' => 'usaha',
    		'nilai_piutang' => $this->input->post('total_harga_retur'),
    		'tanggal_transaksi' => $this->input->post('tanggal'),
        'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh'),
        'bukti_transaksi' => $bukti_pembelian,
        'status' => $status,
    		'keterangan' => $this->input->post('keterangan'),
    	);
		$this->m_akum->create_piutang($data_piutang);
		
		$nama_barang = $this->input->post('nama_barang');
		$query_brg = $this->db->query('SELECT * FROM barang_dagangan where iduser = "'.$id.'" AND nama_barang = "'.$nama_barang.'"');
		$jml_brg = 0;
		foreach ($query_brg->result() as $val) {
			$jml_brg += $val->jumlah_barang;
		}
		// Barang Dagangan
		$data_barang_dagangan = array(
			'jumlah_barang' => $jml_brg - $this->input->post('jumlah_retur'),
		);
		$this->m_akum->edit_barang_dagang_retur($id,$nama_barang,$data_barang_dagangan);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Pembelian berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('retur/retur_pembelian');
	}

	// Retur Penjualan
	public function retur_penjualan(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_pokok/retur_penjualan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_retur_penjualan() {
		$id = $this->session->userdata('id');
		$idpenjualan = $this->input->post('penjualan_id');
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

		// Retur
		$data_retur = array(
			'iduser' => $id,
    		'nama_barang' => $this->input->post('penjualanke'),
    		'jenis_retur' => 'Penjualan',
    		'jumlah' => $this->input->post('jumlah_retur'),
        'harga_barang' => $this->input->post('harga_barang'),
        'total_harga' => $this->input->post('total_harga_retur'),
    		'tgl_retur' => $this->input->post('tanggal'),
        'tgl_jatuh' => $this->input->post('tanggal_jatuh'),
    		'keterangan' => $this->input->post('keterangan'),
			'bukti_pembelian' => $bukti_pembelian,
			'created_date' => date('Y-m-d H:i:s')
    	);
		$this->m_akum->create_retur($data_retur);
		
		// Hutang
    $tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal'));

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
		$data_hutang = array(
			'iduser' => $id,
    		'nama_hutang' => $this->input->post('penjualanke'),
    		'jenis_hutang' => 'usaha',
    		'nilai_hutang' => $this->input->post('total_harga_retur'),
    		'tgl_transaksi' => $this->input->post('tanggal'),
        'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh'),
        'bukti_transaksi' => $bukti_pembelian,
        'status' => $status,
    		'keterangan' => $this->input->post('keterangan'),
    	);
		$this->m_akum->create_hutang($data_hutang);
		
		$nama_barang = $this->input->post('nama_barang');
		$query_brg = $this->db->query('SELECT * FROM barang_dagangan where iduser = "'.$id.'" AND nama_barang = "'.$nama_barang.'"');
		$jml_brg = 0;
		foreach ($query_brg->result() as $val) {
			$jml_brg += $val->jumlah_barang;
		}
		// Barang Dagangan
		$data_barang_dagangan = array(
			'jumlah_barang' => $jml_brg + $this->input->post('jumlah_retur'),
		);
		$this->m_akum->edit_barang_dagang_retur($id,$nama_barang,$data_barang_dagangan);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Penjualan berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('retur/retur_penjualan');
	}

}
