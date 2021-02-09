<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stepfive extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('upload');
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	public function index(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM barang_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/stepfive',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	function create() {
		$id = $this->session->userdata('id');
		$jumlah_barang = $this->input->post('jumlah_barang');
		$harga_satuan = $this->input->post('harga_satuan');
		$data = array(
			'iduser' => $id,
    		'nama_barang' => $this->input->post('nama_barang'),
    		'jumlah_barang' => $jumlah_barang,
    		'satuan' => $this->input->post('satuan'),
    		'harga_satuan' => $harga_satuan,
    		'total_nilai_barang' => $jumlah_barang * $harga_satuan
    	);
        $this->m_akum->create_barang_lainnya($data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Barang Lainnya berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepfive');
	}

	function edit() {
		$id = $this->input->post('id');
		$jumlah_barang = $this->input->post('jumlah_barang');
		$harga_satuan = $this->input->post('harga_satuan');
		$data = array(
    		'nama_barang' => $this->input->post('nama_barang'),
    		'jumlah_barang' => $jumlah_barang,
    		'satuan' => $this->input->post('satuan'),
    		'harga_satuan' => $harga_satuan,
    		'total_nilai_barang' => $jumlah_barang * $harga_satuan
    	);
        $this->m_akum->edit_barang_lainnya($id,$data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Barang Lainnya berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepfive');
	}

	public function delete() {
		$id = $this->input->post('id');
		$this->m_akum->delete_barang_lainnya($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Barang Lainnya berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepfive');
	}
}