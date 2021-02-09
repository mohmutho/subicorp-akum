<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stepeleven extends CI_Controller {

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
		$data['saldo_kas'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/stepeleven',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	function create() {
		$id = $this->session->userdata('id');
		$saldo_laba = $this->input->post('saldo_labarugi');
		$modal_setor = $this->input->post('modal_disetor');
		$data = array(
    		'saldo_labarugi' => $saldo_laba,
    		'modal_disetor' => $modal_setor,
    		'created_date' => date('Y-m-d H:i:s')
    	);
        $this->m_akum->update_saldo_kas($id,$data);
        redirect('stepfinish');
	}
}