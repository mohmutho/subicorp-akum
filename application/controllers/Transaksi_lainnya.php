<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_lainnya extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('upload');
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	public function pengeluaran(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/pengeluaran','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}

	// Pembayaran Hutang
	public function pembayaran_hutang(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE (jenis_hutang = 'lainnya' OR jenis_hutang = 'bank') AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/pembayaran_hutang',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_transaksi_lainnya_pembayaran_hutang() {
		$id = $this->session->userdata('id');
		$idhutang = $this->input->post('hutang_id');
		$saldo_kas = $this->input->post('saldo_kas');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Bayar_Hutang/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		// Bayar Hutang
		$data_bayar_hutang = array(
			'hutang_id' => $this->input->post('hutang_id'),
    		'nilai_bayar' => $this->input->post('nilai_bayar'),
    		'tanggal' => $this->input->post('tanggal'),
    		'keterangan' => $this->input->post('keterangan'),
    		'foto_bukti' => $bukti_transaksi
    	);
        $this->m_akum->create_transaksi_pokok_pembayaran_hutang($data_bayar_hutang);

		// Hutang
        $data_hutang = array(
			'nilai_hutang' => $this->input->post('nhutang') - $this->input->post('nilai_bayar')
    	);
        $this->m_akum->edit_hutang($idhutang,$data_hutang);

		// Saldo Kas
        $data_saldo = array(
			'saldo_kas' => $saldo_kas - $this->input->post('nilai_bayar')
    	);
        $this->m_akum->update_saldo_kas($id,$data_saldo);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pembayaran Hutang berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('transaksi_lainnya/pembayaran_hutang');
	}

	// Penerimaan Piutang
	public function penerimaan_piutang(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM piutang WHERE jenis_piutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/penerimaan_piutang',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_transaksi_lainnya_penerimaan_piutang() {
		$id = $this->session->userdata('id');
		$idpiutang = $this->input->post('piutang_id');
		$saldo_kas = $this->input->post('saldo_kas');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Bayar_Piutang/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		// Bayar Piutang
		$data_bayar_piutang = array(
			'piutang_id' => $this->input->post('piutang_id'),
    		'nilai_bayar' => $this->input->post('nilai_bayar'),
    		'tanggal' => $this->input->post('tanggal'),
    		'keterangan' => $this->input->post('keterangan'),
    		'foto_bukti' => $bukti_transaksi
    	);
        $this->m_akum->create_transaksi_pokok_penerimaan_piutang($data_bayar_piutang);

		// Piutang
        $data_piutang = array(
			'nilai_piutang' => $this->input->post('npiutang') - $this->input->post('nilai_bayar')
    	);
        $this->m_akum->edit_piutang($idpiutang,$data_piutang);

		// Saldo Kas
        $data_saldo = array(
			'saldo_kas' => $saldo_kas + $this->input->post('nilai_bayar')
    	);
        $this->m_akum->update_saldo_kas($id,$data_saldo);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Penerimaan Piutang berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('transaksi_lainnya/penerimaan_piutang');
	}

}
