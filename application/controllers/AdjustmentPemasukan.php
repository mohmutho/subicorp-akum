<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdjustmentPemasukan extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('upload');
		$this->load->model('m_akum');
		if ($this->session->userdata('udhmasuk')==false){
			redirect('.');
		}
	}

	// Pemasukan Modal
	public function modal(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pemasukan/modal','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_modal() {
		$id = $this->session->userdata('id');
		$query = $this->db->query('SELECT * FROM saldo_kas where iduser = '.$id.'');
		$saldo_kas = 0;
		foreach ($query->result() as $val) {
			$saldo_kas+=$val->saldo_kas;
		}
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pemasukan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		// Modal
		$data_modal = array(
			'iduser' => $id,
    		'jumlah_modal' => $this->input->post('jumlah_modal'),
    		'jenis' => 'Pemasukan',
    		'tgl_disetor' => $this->input->post('tanggal_setor'),
    		'bukti_setor' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan_modal($data_modal);
		
		// Pemasukan
		$data_pemasukan = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Modal',
			'nama_transaksi' => 'Setor Modal',
			'tanggal_transaksi' => $this->input->post('tanggal_setor'),
    		'nilai_transaksi' => $this->input->post('jumlah_modal'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('jumlah_modal'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan($data_pemasukan);
		
		// Saldo Kas
		$data_saldo = array(
			'saldo_kas' => $saldo_kas + $this->input->post('jumlah_modal')
    	);
        $this->m_akum->update_saldo_kas($id,$data_saldo);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Modal berhasil disetor. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pemasukan');
	}

	// Pemasukan Hutang Bank
	public function hutang_bank(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pemasukan/hutang_bank','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_hutang_bank() {
		$id = $this->session->userdata('id');
		$filename = date("YmdHis")."_".$id;
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

		$config = array(
			'upload_path'=>'Foto/Pemasukan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_hutang = $finfo['file_name'];
		
		// Pemasukan
		$data_pemasukan = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Hutang Bank',
			'nama_transaksi' => $this->input->post('pilih_bank'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('nilai_hutang'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('nilai_hutang'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan($data_pemasukan);
		
		// Hutang
		$data_hutang = array(
			'iduser' => $id,
    		'jenis_hutang' => "bank",
    		'nama_hutang' => $this->input->post('pilih_bank'),
    		'nilai_hutang' => $this->input->post('nilai_hutang'),
    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'bukti_transaksi' => $bukti_hutang,
			'status' => $status
    	);
        $this->m_akum->create_hutang($data_hutang);
		
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Hutang Bank berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pemasukan');
	}

	// Pemasukan Hutang Lainnya
	public function hutang_lainnya(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pemasukan/hutang_lainnya','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_hutang_lainnya() {
		$id = $this->session->userdata('id');
		$filename = date("YmdHis")."_".$id;
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

		$config = array(
			'upload_path'=>'Foto/Pemasukan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Hutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_hutang = $finfo['file_name'];
		
		// Pemasukan
		$data_pemasukan = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Hutang Lainnya',
			'nama_transaksi' => $this->input->post('nama_hutang'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('nilai_hutang'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('nilai_hutang'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan($data_pemasukan);
		
		// Hutang
		$data_hutang = array(
			'iduser' => $id,
    		'jenis_hutang' => "lainnya",
    		'nama_hutang' => $this->input->post('nama_hutang'),
    		'nilai_hutang' => $this->input->post('nilai_hutang'),
    		'tgl_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tgl_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'keterangan' => $this->input->post('keterangan'),
    		'bukti_transaksi' => $bukti_hutang,
			'status' => $status
    	);
		$this->m_akum->create_hutang($data_hutang);
		
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Hutang Lainnya berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pemasukan');
	}

	// Pemasukan Hibah
	public function hibah(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pemasukan/hibah','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_hibah() {
		$id = $this->session->userdata('id');
		$jenis_hibah = $this->input->post('pilih_jenis_hibah');
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pemasukan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Activa_Tetap/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_actetap = $finfo['file_name'];

		$config3 = array(
			'upload_path'=>'Foto/Activa_Lainnya/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config3);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_aclainnya = $finfo['file_name'];

		if($jenis_hibah=='Tanah' OR $jenis_hibah=='Tanah dan Bangunan'){
			$data_actetap = array(
				'iduser' => $id,
				'jenis_activa' => $this->input->post('pilih_jenis_hibah'),
				'nama_activa' => $this->input->post('nama_hibah'),
				'nilai_tanah' => $this->input->post('nilai_barang'),
				'tahun_beli' => $this->input->post('tanggal_transaksi'),
				'bukti_bayar' => $bukti_actetap
			);
			$this->m_akum->create_activa_tetap($data_actetap);
		}else{
			$data_aclainnya = array(
				'iduser' => $id,
				'jenis_activa' => 'BARU',
				'nama_activa' => $this->input->post('nama_barang'),
				'nama_penjual' => $this->input->post('nama_hibah'),
				'nilai_activa' => $this->input->post('nilai_barang'),
				'tahun_beli' => $this->input->post('tanggal_transaksi'),
				'bukti_bayar' => $bukti_aclainnya
			);
			$this->m_akum->create_activa_lainnya($data_aclainnya);
		}
		
		// Pemasukan
		$data_pemasukan = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Hibah',
			'nama_transaksi' => $this->input->post('nama_hibah'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('nilai_barang'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('nilai_barang'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan($data_pemasukan);

		// Hibah
		$data_hibah = array(
			'iduser' => $id,
			'jenis_hibah' => 'Pemasukan',
			'nama_penerima' => $this->input->post('nama_hibah'),
			'nama_barang' => $this->input->post('nama_barang'),
			'nilai_barang' => $this->input->post('nilai_barang'),
			'tgl_penerimaan' => $this->input->post('tanggal_transaksi'),
			'keterangan' => $this->input->post('keterangan'),
			'bukti_foto' => $bukti_transaksi
    	);
		$this->m_akum->create_hibah($data_hibah);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Hibah berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pemasukan');
	}

	// Pemasukan Piutang Lainnya
	public function piutang_lainnya(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pemasukan/piutang_lainnya','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_piutang_lainnya() {
		$id = $this->session->userdata('id');
		$filename = date("YmdHis")."_".$id;
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

		$config = array(
			'upload_path'=>'Foto/Pemasukan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Piutang/',
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_piutang = $finfo['file_name'];
		
		// Pemasukan
		$data_pemasukan = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Piutang Lainnya',
			'nama_transaksi' => $this->input->post('nama_piutang'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('nilai_piutang'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('nilai_piutang'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan($data_pemasukan);

		// Piutang
		$data_piutang = array(
			'iduser' => $id,
    		'jenis_piutang' => "usaha",
    		'nama_piutang' => $this->input->post('nama_piutang'),
    		'nilai_piutang' => $this->input->post('nilai_piutang'),
    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
    		'bukti_transaksi' => $bukti_piutang,
    		'keterangan' => $this->input->post('keterangan'),
    		'status' => $status
    	);
		$this->m_akum->create_piutang($data_piutang);
		
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Piutang Lainnya berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pemasukan');
	}

	// Penjualan Asset
	public function penjualan_asset(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM activa_tetap WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pemasukan/penjualan_asset',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_penjualan_asset() {
		$id = $this->session->userdata('id');
		$jenis_asset = $this->input->post('pilih_jenis_asset');
		$tipe_pembayaran = $this->input->post('jenis_pembayaran');
		$saldo_kas = $this->input->post('saldo_kas');
		$idasset = $this->input->post('id_asset');
		$query = $this->db->query('SELECT * FROM activa_tetap WHERE id = "'.$idasset.'"');
		foreach ($query->result() as $val) {
			$nama_asset= $val->nama_activa;
		}
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pemasukan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_transaksi = $finfo['file_name'];

		$config2 = array(
			'upload_path'=>'Foto/Piutang/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);
		$this->upload->initialize($config2);
		$this->upload->do_upload('photo');
		$finfo = $this->upload->data();
		$bukti_piutang = $finfo['file_name'];

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

		if ($tipe_pembayaran=='Cash') {
			// Saldo Kas
      $data_saldo = array(
				'saldo_kas' => $saldo_kas + $this->input->post('total')
	    	);
			$this->m_akum->update_saldo_kas($id,$data_saldo);
			$cash = $this->input->post('total');
			$kredit = "";
    }else if ($tipe_pembayaran=='Kredit') {
			// Piutang
      $data_piutang = array(
				  'iduser' => $id,
	    		'jenis_piutang' => "usaha",
	    		'nama_piutang' => $nama_asset,
	    		'nilai_piutang' => $this->input->post('total'),
	    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
          'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'bukti_transaksi' => $bukti_piutang,
          'status' => $status
	    	);
			$this->m_akum->create_piutang($data_piutang);
			$cash = "";
			$kredit = $this->input->post('total');
    }else{
			// Saldo Kas
      $data_saldo = array(
				'saldo_kas' => $saldo_kas + $this->input->post('cash')
	    	);
	    $this->m_akum->update_saldo_kas($id,$data_saldo);

			// Piutang
	    $data_piutang = array(
				  'iduser' => $id,
	    		'jenis_piutang' => "usaha",
	    		'nama_piutang' => $nama_asset,
	    		'nilai_piutang' => $this->input->post('sisa_kredit'),
	    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
          'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
	    		'bukti_transaksi' => $bukti_piutang,
          'status' => $status
	    	);
			$this->m_akum->create_piutang($data_piutang);
			$cash = $this->input->post('cash');
			$kredit = $this->input->post('sisa_kredit');
        }
		
		// Pemasukan
		$data_pemasukan = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Penjualan Asset',
			'nama_transaksi' => $nama_asset,
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('total'),
			'jenis_pembayaran' => $tipe_pembayaran,
			'cash' => $cash,
			'kredit' => $kredit,
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan($data_pemasukan);

		// Activa Tetap
		$data_actetap = array(
			'status' => 'Jual'
		);
		$this->m_akum->edit_activa_tetap($idasset,$data_actetap);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Penjualan Asset berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pemasukan');
	}

	// Form Edit Pemasukan
	public function form_pemasukan_edit($id){
		$data['title'] = 'Akum';
		$data['op'] = 'edit';
		$data['sql'] = $this->m_akum->update_pemasukan($id);
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/adjustment/form/pemasukan',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function edit_pemasukan() {
		$id = $this->session->userdata('id');
		$idpemasukan = $this->input->post('id');
		$tipe_pembayaran = $this->input->post('jenis_pembayaran');

		if ($tipe_pembayaran=='Cash') {
			$cash = $this->input->post('nilai_transaksi');
			$kredit = "";
		}else if ($tipe_pembayaran=='Kredit') {
			$cash = "";
			$kredit = $this->input->post('nilai_transaksi');
		}else{
			$cash = $this->input->post('cash');
			$kredit = $this->input->post('sisa_kredit');
		}
		
		$filename = date("YmdHis")."_".$id;
		$config = array(
			'upload_path'=>'Foto/Pemasukan/',
			'allowed_types'=>'jpg|png|jpeg|pdf',
			'max_size'=>2086,
			'file_name'=>$filename
		);

		$this->upload->initialize($config);
		if($this->upload->do_upload('photo')){
			$finfo = $this->upload->data();
			$bukti_transaksi = $finfo['file_name'];

			// Pemasukan
			$data_pemasukan = array(
				'iduser' => $id,
				'jenis_transaksi' => $this->input->post('pilih_jenis_transaksi'),
				'nama_transaksi' => $this->input->post('nama_transaksi'),
				'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
				'nilai_transaksi' => $this->input->post('nilai_transaksi'),
				'jenis_pembayaran' => $tipe_pembayaran,
				'cash' => $cash,
				'kredit' => $kredit,
				'bukti_bayar' => $bukti_transaksi
			);

			$kode_id = array('id'=>$id);
			$gambar_db = $this->db->get_where('pemasukan',$kode_id);
			if($gambar_db->num_rows()>0){
				$pros=$gambar_db->row();
				$name_gambar=$pros->bukti_bayar;

				if(file_exists($lok=FCPATH.'Foto/Pemasukan/'.$name_gambar)){
				unlink($lok);
				}
			}
		}else{
			// Pemasukan
			$data_pemasukan = array(
				'iduser' => $id,
				'jenis_transaksi' => $this->input->post('pilih_jenis_transaksi'),
				'nama_transaksi' => $this->input->post('nama_transaksi'),
				'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
				'nilai_transaksi' => $this->input->post('nilai_transaksi'),
				'jenis_pembayaran' => $tipe_pembayaran,
				'cash' => $cash,
				'kredit' => $kredit
			);
		}
		$this->m_akum->edit_pemasukan($idpemasukan,$data_pemasukan);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong>Pemasukan berhasil diubah. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');

		redirect('adjustment/pemasukan');
	}
	// Delete Pemasukan
	public function delete_pemasukan() {
		$id = $this->input->post('id');
		$this->m_akum->delete_pemasukan($id);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Retur Penjualan berhasil dihapus.</strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('adjustment/pemasukan');
	}
}