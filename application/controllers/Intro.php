<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intro extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	public function index(){
		$cek_opening = $this->db->query("SELECT * FROM user WHERE id = ".$this->session->userdata('id')."")->result();
		foreach ($cek_opening as $open){
        	$intro_dashboard = $open->status_opening;
		}
		if($intro_dashboard==1){
			redirect('dashboard');
		}else{
			$data['title'] = 'Akum';
			$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
	        $data['pages'] = $this->load->view('pages/intro','',true);
			$this->load->view('main_intro',array('main'=>$data));
		}
	}

}
