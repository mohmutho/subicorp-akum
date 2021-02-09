<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

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
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/modal','',true);
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
		redirect('pemasukan/modal');
	}

	// Pemasukan Hutang Bank
	public function hutang_bank(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/hutang_bank','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_hutang_bank() {
		$id = $this->session->userdata('id');
		$filename = date("YmdHis")."_".$id;
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

		if ($tanggal_transaksi[2]>=15) {
			$hitung = 1+($tanggal_jatuh_tempo[0]-$tanggal_transaksi[0])*12;
			$hitung += $tanggal_jatuh_tempo[1]-$tanggal_transaksi[1];
		}else{
			$hitung = ($tanggal_jatuh_tempo[0]-$tanggal_transaksi[0])*12;
			$hitung += $tanggal_jatuh_tempo[1]-$tanggal_transaksi[1];
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
			'bukti_bayar' => $bukti_transaksi,
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
			'status' => $status,
			'keterangan' => $this->input->post('keterangan')
    	);
		$this->m_akum->create_hutang($data_hutang);
		
		$query_sld = $this->db->query('SELECT * FROM saldo_kas where iduser = "'.$id.'"');
		$saldo_kas = 0;
		foreach ($query_sld->result() as $val2) {
			$saldo_kas += $val2->saldo_kas;
		}
		// Saldo Kas
		$data_saldo_kas = array(
			'iduser' => $id,
			'saldo_kas' => $saldo_kas + $this->input->post('nilai_hutang'),
		);
		$this->m_akum->update_saldo_kas($id,$data_saldo_kas);
		
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Hutang Bank berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pemasukan/hutang_bank');
	}

	// Pemasukan Hutang Lainnya
	public function hutang_lainnya(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/hutang_lainnya','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_hutang_lainnya() {
		$id = $this->session->userdata('id');
		$filename = date("YmdHis")."_".$id;
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

		if ($tanggal_transaksi[2]>=15) {
			$hitung = 1+($tanggal_jatuh_tempo[0]-$tanggal_transaksi[0])*12;
			$hitung += $tanggal_jatuh_tempo[1]-$tanggal_transaksi[1];
		}else{
			$hitung = ($tanggal_jatuh_tempo[0]-$tanggal_transaksi[0])*12;
			$hitung += $tanggal_jatuh_tempo[1]-$tanggal_transaksi[1];
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

		$query_sld = $this->db->query('SELECT * FROM saldo_kas where iduser = "'.$id.'"');
		$saldo_kas = 0;
		foreach ($query_sld->result() as $val2) {
			$saldo_kas += $val2->saldo_kas;
		}
		// Saldo Kas
		$data_saldo_kas = array(
			'iduser' => $id,
			'saldo_kas' => $saldo_kas + $this->input->post('nilai_hutang'),
		);
		$this->m_akum->update_saldo_kas($id,$data_saldo_kas);
		
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Hutang Lainnya berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pemasukan/hutang_lainnya');
	}

	// Pemasukan Hibah
	public function hibah(){
		$data['title'] = 'Akum';
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/hibah',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_hibah() {
		$id = $this->session->userdata('id');
		$jenis_hibah = $this->input->post('pilih_jenis_hibah');
		$saldo_kas = $this->input->post('saldo_kas');
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
				'nilai_tanah' => $this->input->post('total'),
				'tahun_beli' => $this->input->post('tanggal_transaksi'),
				'bukti_bayar' => $bukti_actetap
			);
			$this->m_akum->create_activa_tetap($data_actetap);
		}else if($jenis_hibah=='Lainnya'){
			$jenis_hibah_lainnya = $this->input->post('pilih_jenis_hibah_lainnya');
			if($jenis_hibah_lainnya=="BARU"){
				// Baru
				$data_aclainnya = array(
					'iduser' => $id,
					'jenis_activa' => $jenis_hibah_lainnya,
					'nama_activa' => $this->input->post('nama_barang'),
					'nama_penjual' => $this->input->post('nama_hibah'),
					'nilai_activa' => $this->input->post('total'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi_lainnya'),
					'kuantitas' => $this->input->post('jumlah'),
					'tahun_beli' => $this->input->post('tahun_beli_lainnya'),
					'bulan_sisa' => $this->input->post('bulan_sisa_lainnya'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai_lainnya'),
		    		'akumulasi_penyusutan' => $this->input->post('akumulasi_penyusutan_lainnya'),
					'harga_sisa' => $this->input->post('harga_sisa_lainnya'),
					'status' => 'Aktif',
					'bukti_bayar' => $bukti_aclainnya
				);
			}else{
				// Bekas
				$data_aclainnya = array(
					'iduser' => $id,
					'jenis_activa' => $jenis_hibah_lainnya,
					'nama_activa' => $this->input->post('nama_barang'),
					'nama_penjual' => $this->input->post('nama_hibah'),
					'nilai_activa' => $this->input->post('total'),
					'nilai_ekonomi' => $this->input->post('nilai_ekonomi_lainnya'),
					'kuantitas' => $this->input->post('jumlah'),
					'tahun_berdiri' => $this->input->post('tahun_berdiri_lainnya'),
					'tahun_beli' => $this->input->post('tahun_beli_lainnya'),
					'bulan_sisa' => $this->input->post('bulan_sisa_lainnya'),
		    		'bulan_terpakai' => $this->input->post('bulan_terpakai_lainnya'),
		    		'akumulasi_penyusutan' => $this->input->post('akumulasi_penyusutan_lainnya'),
					'harga_sisa' => $this->input->post('harga_sisa_lainnya'),
					'status' => 'Aktif',
					'bukti_bayar' => $bukti_aclainnya
				);
			}
			$this->m_akum->create_activa_lainnya($data_aclainnya);
		}
		
		// Pemasukan
		$data_pemasukan = array(
			'iduser' => $id,
			'jenis_transaksi' => 'Hibah',
			'nama_transaksi' => $this->input->post('nama_hibah'),
			'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
    		'nilai_transaksi' => $this->input->post('total'),
			'jenis_pembayaran' => 'Cash',
			'cash' => $this->input->post('total'),
    		'bukti_bayar' => $bukti_transaksi
    	);
		$this->m_akum->create_pemasukan($data_pemasukan);

		// Hibah
		$data_hibah = array(
			'iduser' => $id,
			'jenis_hibah' => 'Pemasukan',
			'nama_penerima' => $this->input->post('nama_hibah'),
			'nama_barang' => $this->input->post('nama_barang'),
			'nilai_barang' => $this->input->post('total'),
			'tgl_penerimaan' => $this->input->post('tanggal_transaksi'),
			'keterangan' => $this->input->post('keterangan'),
			'bukti_foto' => $bukti_transaksi
    	);
		$this->m_akum->create_hibah($data_hibah);

		// Saldo Kas
		$data_saldo = array(
			'saldo_kas' => $saldo_kas+$this->input->post('total')
		);
		$this->m_akum->update_saldo_kas($id,$data_saldo);

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Pemasukan Hibah berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pemasukan/hibah');
	}

	// Pemasukan Piutang Lainnya
	public function piutang_lainnya(){
		$data['title'] = 'Akum';
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/piutang_lainnya','',true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_pemasukan_piutang_lainnya() {
		$id = $this->session->userdata('id');
		$filename = date("YmdHis")."_".$id;
		$tanggal_jatuh_tempo = explode("-",$this->input->post('tanggal_jatuh_tempo'));
		$tanggal_transaksi = explode("-",$this->input->post('tanggal_transaksi'));

		if ($tanggal_transaksi[2]>=15) {
			$hitung = 1+($tanggal_jatuh_tempo[0]-$tanggal_transaksi[0])*12;
			$hitung += $tanggal_jatuh_tempo[1]-$tanggal_transaksi[1];
		}else{
			$hitung = ($tanggal_jatuh_tempo[0]-$tanggal_transaksi[0])*12;
			$hitung += $tanggal_jatuh_tempo[1]-$tanggal_transaksi[1];
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
		redirect('pemasukan/piutang_lainnya');
	}

	// Penjualan Asset
	public function penjualan_asset(){
		$data['title'] = 'Akum';
		$data['sql'] = $this->db->query("SELECT * FROM activa_tetap WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sql3'] = $this->db->query("SELECT * FROM activa_lainnya WHERE status = 'Aktif' AND iduser = ".$this->session->userdata('id')."");
		$data['sql2'] = $this->db->query("SELECT * FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
		$data['sidebar'] = $this->load->view('layouts/sidebar_dashboard','',true);
        $data['pages'] = $this->load->view('pages/transaksi_lainnya/penjualan_asset',array('main'=>$data),true);
		$this->load->view('main_dashboard',array('main'=>$data));
	}
	function create_penjualan_asset() {
		$id = $this->session->userdata('id');
		$jenis_asset = $this->input->post('pilih_jenis_asset');
		$tipe_pembayaran = $this->input->post('jenis_pembayaran');
		$saldo_kas = $this->input->post('saldo_kas');
		if ($jenis_asset=="Tanah" OR $jenis_asset=="Tanah dan Bangunan") {
			$idasset = $this->input->post('id_asset');
			$query = $this->db->query('SELECT * FROM activa_tetap WHERE id = "'.$idasset.'"');
			// Activa Tetap
			$data_actetap = array(
				'status' => 'Jual'
			);
			$this->m_akum->edit_activa_tetap($idasset,$data_actetap);
		}else{
			$idasset = $this->input->post('id_asset_lainnya');
			$query = $this->db->query('SELECT * FROM activa_lainnya WHERE id = "'.$idasset.'"');
			// Activa Lainnya
			$data_actlain = array(
				'status' => 'Jual'
			);
			$this->m_akum->edit_activa_lainnya($idasset,$data_actlain);
		}
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

		if ($tipe_pembayaran=='Cash') {
			// Saldo Kas
        	$data_saldo = array(
				'saldo_kas' => $saldo_kas+$this->input->post('total')
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
	    		'bukti_transaksi' => $bukti_piutang
	    	);
			$this->m_akum->create_piutang($data_piutang);
			$cash = "";
			$kredit = $this->input->post('total');
        }else{
			// Saldo Kas
        	$data_saldo = array(
				'saldo_kas' => $saldo_kas+$this->input->post('cash')
	    	);
	        $this->m_akum->update_saldo_kas($id,$data_saldo);

			// Piutang
	        $data_piutang = array(
				'iduser' => $id,
	    		'jenis_piutang' => "usaha",
	    		'nama_piutang' => $nama_asset,
	    		'nilai_piutang' => $this->input->post('sisa_kredit'),
	    		'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
	    		'bukti_transaksi' => $bukti_piutang
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

        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible"><strong> Penjualan Asset berhasil. </strong><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
		redirect('pemasukan/penjualan_asset');
	}
}