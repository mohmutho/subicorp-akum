<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_transaksi extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	public function transaksi_pokok(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM pembelian WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM penjualan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->db->query("SELECT * FROM retur WHERE jenis_retur = 'Pembelian' AND iduser = ".$this->session->userdata('id')."");
		$data['sql4'] = $this->db->query("SELECT * FROM retur WHERE jenis_retur = 'Penjualan' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/riwayat_transaksi/transaksi_pokok',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function transaksi_lainnya(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM pemasukan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM pengeluaran WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/riwayat_transaksi/transaksi_lainnya',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function data_persediaan(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM barang_lainnya WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/riwayat_transaksi/data_persediaan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function data_aktiva(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM activa_tetap WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM activa_lainnya WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->db->query("SELECT * FROM `pengeluaran` WHERE jenis_transaksi = 'Pembelian Asset' AND iduser = ".$this->session->userdata('id')."");
		$data['sql4'] = $this->db->query("SELECT * FROM `pemasukan` WHERE jenis_transaksi = 'Penjualan Asset' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/riwayat_transaksi/data_aktiva',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function data_hutang(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'bank' AND iduser = ".$this->session->userdata('id')."");
		$data['sql4'] = $this->db->query("SELECT *, bh.keterangan as ket FROM hutang h JOIN bayar_hutang bh ON h.id = bh.hutang_id WHERE h.jenis_hutang = 'usaha' AND h.iduser = ".$this->session->userdata('id')."");
		$data['sql5'] = $this->db->query("SELECT *, bh.keterangan as ket FROM hutang h JOIN bayar_hutang bh ON h.id = bh.hutang_id WHERE h.jenis_hutang != 'usaha' AND h.iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/riwayat_transaksi/data_hutang',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function data_piutang(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->db->query("SELECT *, bp.keterangan as ket FROM piutang p JOIN bayar_piutang bp ON p.id = bp.piutang_id WHERE p.jenis_piutang = 'usaha' AND h.iduser = ".$this->session->userdata('id')."");
		$data['sql4'] = $this->db->query("SELECT *, bp.keterangan as ket FROM piutang p JOIN bayar_piutang bp ON p.id = bp.piutang_id WHERE p.jenis_piutang != 'usaha' AND h.iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/riwayat_transaksi/data_piutang',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	public function log_aktivitas(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM log_aktivitas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/riwayat_transaksi/log_aktivitas',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

}