<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stepfinish extends CI_Controller {

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
		// Neraca Saldo
		$data['saldo_kas'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['piutang_dagang'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang != 'retur'");
		$data['piutang_retur'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang = 'retur'");
		$data['persediaan'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['persediaan_lainnya'] = $this->db->query("SELECT * FROM barang_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['activa_tetap'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')."");
		$data['activa_lainnya'] = $this->db->query("SELECT * FROM activa_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['hutang_dagang'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'usaha'");
		$data['hutang_retur'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'retur'");
		$data['hutang_lainnya'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'lainnya'");
		$data['hutang_bank'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'bank'");
		
		// Laba / Rugi
		$data['barang_jasa'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['asset'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')." AND status = 'Jual'");
		$data['lainnya'] = $this->db->query("SELECT * FROM pemasukan WHERE iduser = ".$this->session->userdata('id')."");
		$data['biaya'] = $this->db->query("SELECT * FROM biaya WHERE iduser = ".$this->session->userdata('id')."");
		
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/stepfinish',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	function update_status() {
		$id = $this->session->userdata('id');
		$data = array(
    		'status_opening' => $this->input->post('status_opening'),
    	);
        $this->m_akum->update_user($id,$data);
        redirect('dashboard');
	}
}