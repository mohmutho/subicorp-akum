<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stepsix extends CI_Controller {

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
		$data['sql'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/stepsix',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	public function form(){
		$data['title'] = 'Akum';
		$data['stepsix'] = 'Tanah';
		$data['op'] = 'tambah';
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/form/stepsix',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	public function form_edit($id){
		$data['title'] = 'Akum';
		$data['stepsix'] = 'Tanah';
		$data['op'] = 'edit';
		$data['sql'] = $this->m_akum->update_activa_tetap($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/form/stepsix',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	function create() {
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
			redirect('stepsix');
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
			redirect('stepsix');
	    }
	}

	public function delete() {
		$id = $this->input->post('id');
		$this->m_akum->delete_activa_tetap($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Activa tetap berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepsix');
	}
}