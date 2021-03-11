<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stepone extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	public function index(){
		// $step1 = $this->db->query("SELECT COUNT(*) as cek FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		// foreach ($step1->result() as $obj) {
		// 	$stepsatu = $obj->cek;
		// }
		// if ($stepsatu==1) {
		// 	redirect('steptwo');
		// }else{
			$data['title'] = 'Akum';
			$data['sql'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."")->result();
			$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
			$data['pages'] = $this->load->view('pages/stepone',$data,true);
			$this->load->view('main_intro',array('main'=>$data));
		// }
	}

	function create() {
    $id = $this->session->userdata('id');
		$step1 = $this->db->query("SELECT COUNT(*) as cek FROM saldo_kas WHERE iduser = ".$id."");
    // $query_saldo = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$id."");
		$saldo_kas = $this->input->post('saldo_kas');
		$saldo_bank = $this->input->post('saldo_bank');
		$surat_berharga = $this->input->post('surat_berharga');
    foreach($step1->result() as $obj) {
			$stepsatu = $obj->cek;
		}
    
		if ($stepsatu==1) {
      $data = array(
				'iduser' => $id,
				'saldo_kas' => $saldo_kas,
				'saldo_bank' => $saldo_bank,
				'surat_berharga' => $surat_berharga
			);
      $this->m_akum->update_saldo_kas($id, $data);
			redirect('steptwo');
		}else{
			$data = array(
				'iduser' => $id,
				'saldo_kas' => $saldo_kas,
				'saldo_bank' => $saldo_bank,
				'surat_berharga' => $surat_berharga
			);
			$this->m_akum->create_saldo_kas($data);
      redirect('steptwo');
		}
	}
}
