<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('m_akum');
	}

	public function index(){
		$data['title'] = 'Akum';
        $data['pages'] = $this->load->view('pages/login','',true);
		$this->load->view('main_login',array('main'=>$data));
	}

	function create() {
		$username = $this->input->post('username');
		$data = array(
    		'nama' => $this->input->post('nama'),
    		'username' => $username,
    		// 'password' => md5($this->input->post('password'))
    		'password' => $this->input->post('password'),
    		'email' => $this->input->post('email'),
    		// 'nama_usaha' => $this->input->post('nama_usaha'),
    		'jenis_usaha' => $this->input->post('jenis_usaha')
		);
		$query = $this->m_akum->cekUsername($data);
		if ($query->num_rows() != 0) {
			$this->session->set_flashdata('msgError', 'Username sudah terpakai, silahkan gunakan Username lain!', 'error');
		}else{
			$this->m_akum->create_user($data);
			$this->session->set_flashdata('msgSuccess', 'Register berhasil', 'success');
			// $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible" style="margin: 15px; width: 100%;"><strong>Registers berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		}
		redirect('.');
	}

	function check_login(){
		if (isset($_POST['login'])) {
			$user=$this->input->post('username');
			$pass=$this->input->post('password');
			$cek=$this->m_akum->check_login($user, $pass)->result();
			$hasil=count($cek);
			if ($hasil > 0) {
				$yglogin=$this->db->get_where('user',array('username'=>$user, 'password'=>$pass))->row();
				$data = array('udhmasuk' => true,
					'id'=>$yglogin->id,
					'jenis_usaha'=>$yglogin->jenis_usaha,
					'nama' => $yglogin->nama);
					$this->session->set_userdata($data);
				redirect('intro');
			}else {
				$this->session->set_flashdata('notif','<div class="alert alert-danger alert-dismissible" style="margin: 15px; width: 100%;"><strong> Maaf Email atau Password Anda Salah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
				redirect('.');
			}
		}
	}

	function keluar(){
		$this->session->sess_destroy();
		redirect('.');
	}
}