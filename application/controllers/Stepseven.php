<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stepseven extends CI_Controller {

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
		$data['sql'] = $this->db->query("SELECT * FROM activa_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/stepseven',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	public function form(){
		$data['title'] = 'Akum';
		$data['op'] = 'tambah';
		$data['stepseven'] = 'baru';
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/form/stepseven',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	public function form_edit($id){
		$data['title'] = 'Akum';
		$data['stepsix'] = 'baru';
		$data['op'] = 'edit';
		$data['sql'] = $this->m_akum->update_activa_lainnya($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/form/stepseven',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	function create() {
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
			redirect('stepseven');
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
			redirect('stepseven');
	    }
	}

	public function delete() {
		$id = $this->input->post('id');
		$this->m_akum->delete_activa_lainnya($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Activa Lainnya berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepseven');
	}
}