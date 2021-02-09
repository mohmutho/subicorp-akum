<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	public function laporan_laba(){
		$data['title'] = 'Akum';
		$data['barang_jasa'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['asset'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')." AND status = 'Jual'");
		$data['lainnya'] = $this->db->query("SELECT * FROM pemasukan WHERE iduser = ".$this->session->userdata('id')."");
		$data['biaya'] = $this->db->query("SELECT * FROM biaya WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/laporan_laba',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function laporan_neraca(){
		$data['title'] = 'Akum';
		// Neraca Saldo
		$data['saldo_kas'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['piutang_dagang'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang = 'usaha'");
		$data['piutang_retur'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang = 'retur'");
		$data['piutang_lainnya'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang = 'lainnya'");
		$data['persediaan'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['persediaan_lainnya'] = $this->db->query("SELECT * FROM barang_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['activa_tetap'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')."");
		$data['activa_lainnya'] = $this->db->query("SELECT * FROM activa_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['hutang_dagang'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'usaha'");
		$data['hutang_retur'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'retur'");
		$data['hutang_lainnya'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'lainnya'");
		$data['hibah'] = $this->db->query("SELECT * FROM hibah WHERE iduser = ".$this->session->userdata('id')." AND jenis_hibah = 'Pemasukan'");
		$data['hutang_bank'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'bank'");
		
		// Laba / Rugi
		$data['barang_jasa'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['asset'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')." AND status = 'Jual'");
		$data['lainnya'] = $this->db->query("SELECT * FROM pemasukan WHERE iduser = ".$this->session->userdata('id')."");
		$data['biaya'] = $this->db->query("SELECT * FROM biaya WHERE iduser = ".$this->session->userdata('id')."");

		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/laporan_neraca',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function cetak_laba(){
		$data['title'] = 'Akum';
		$data['barang_jasa'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['asset'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')." AND status = 'Jual'");
		$data['lainnya'] = $this->db->query("SELECT * FROM pemasukan WHERE iduser = ".$this->session->userdata('id')."");
		$data['biaya'] = $this->db->query("SELECT * FROM biaya WHERE iduser = ".$this->session->userdata('id')."");
        $data['pages'] = $this->load->view('pages/cetak/laba',array('main'=>$data),true);
		$this->load->view('main_login',array('main'=>$data));
	}

	public function cetak_neraca(){
		$data['title'] = 'Akum';
		// Neraca Saldo
		$data['saldo_kas'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['piutang_dagang'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang = 'usaha'");
		$data['piutang_retur'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang = 'retur'");
		$data['piutang_lainnya'] = $this->db->query("SELECT * FROM piutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_piutang = 'lainnya'");
		$data['persediaan'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['persediaan_lainnya'] = $this->db->query("SELECT * FROM barang_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['activa_tetap'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')."");
		$data['activa_lainnya'] = $this->db->query("SELECT * FROM activa_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['hutang_dagang'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'usaha'");
		$data['hutang_retur'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'retur'");
		$data['hutang_lainnya'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'lainnya'");
		$data['hibah'] = $this->db->query("SELECT * FROM hibah WHERE iduser = ".$this->session->userdata('id')." AND jenis_hibah = 'Pemasukan'");
		$data['hutang_bank'] = $this->db->query("SELECT * FROM hutang WHERE iduser = ".$this->session->userdata('id')." AND jenis_hutang = 'bank'");
		
		// Laba / Rugi
		$data['barang_jasa'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['asset'] = $this->db->query("SELECT * FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')." AND status = 'Jual'");
		$data['lainnya'] = $this->db->query("SELECT * FROM pemasukan WHERE iduser = ".$this->session->userdata('id')."");
		$data['biaya'] = $this->db->query("SELECT * FROM biaya WHERE iduser = ".$this->session->userdata('id')."");

		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/cetak/neraca',array('main'=>$data),true);
		$this->load->view('main_login',array('main'=>$data));
	}

}
