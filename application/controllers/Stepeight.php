<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stepeight extends CI_Controller {

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
		$data['sql'] = $this->db->query("SELECT * FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar','',true);
        $data['pages'] = $this->load->view('pages/stepeight',array('main'=>$data),true);
		$this->load->view('main_intro',array('main'=>$data));
	}

	function create() {
		$id = $this->session->userdata('id');
		$nilai_hutang = $this->input->post('nilai_hutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

		if ((int)$tanggal_transaksi[2]>=15) {
			$hitung = 1+((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
			$hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
		}else{
			$hitung = ((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
			$hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
		}
		if ($hitung<12) {
          $status = "Jangka Pendek";
        } else if($hitung>=12){
          $status = "Jangka Panjang";
		}
		
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('bukti_transaksi');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];
		$data = array(
			'iduser' => $id,
    		'jenis_hutang' => "usaha",
    		'nama_hutang' => $this->input->post('nama_hutang'),
    		'nilai_hutang' => $nilai_hutang,
    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'bukti_transaksi' => $bukti_transaksi,
			'keterangan' => $this->input->post('keterangan'),
			'status' => $status
    	);
        $this->m_akum->create_hutang($data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Hutang Usaha berhasil disimpan. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepeight');
	}

	function edit() {
		$id = $this->input->post('id');
		$nilai_hutang = $this->input->post('nilai_hutang');
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

		if ((int)$tanggal_transaksi[2]>=15) {
			$hitung = 1+((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
			$hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
		}else{
			$hitung = ((int)$tanggal_jatuh_tempo[0]-(int)$tanggal_transaksi[0])*12;
			$hitung += (int)$tanggal_jatuh_tempo[1]-(int)$tanggal_transaksi[1];
		}
		if ($hitung<12) {
          $status = "Jangka Pendek";
        } else if($hitung>=12){
          $status = "Jangka Panjang";
		}

		$iduser = $this->input->post('iduser');
		$filename = date("YmdHis")."_".$iduser;
		$config = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload('bukti_transaksi')){
			$finfo = $this->upload->data();
			$bukti_transaksi = $finfo['file_name'];

			$data = array(
	    		'nama_hutang' => $this->input->post('nama_hutang'),
	    		'nilai_hutang' => $nilai_hutang,
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'bukti_transaksi' => $bukti_transaksi,
				'keterangan' => $this->input->post('keterangan'),
				'status' => $status
	    	);

	    	$kode_id = array('id'=>$id);
			$gambar_db = $this->db->get_where('hutang',$kode_id);
			if($gambar_db->num_rows()>0){
				$pros=$gambar_db->row();
				$name_gambar=$pros->bukti_transaksi;

				if(file_exists($lok=FCPATH.'Foto/Hutang/'.$name_gambar)){
				  unlink($lok);
				}
			}
		}else{
			$data = array(
	    		'nama_hutang' => $this->input->post('nama_hutang'),
	    		'nilai_hutang' => $nilai_hutang,
	    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => $status
	    	);
		}
        $this->m_akum->edit_hutang($id,$data);
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Hutang Usaha berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepeight');
	}

	public function delete() {
		$id = $this->input->post('id');
		$this->m_akum->delete_hutang($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Hutang Usaha berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('stepeight');
	}
}