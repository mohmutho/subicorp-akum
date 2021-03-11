<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akum extends CI_Model {

	// User
	function create_user($data){
        $this->db->insert('user',$data);
    }
    function update_user($id,$data){
        $this->db->where("id",$id);
        $this->db->update('user',$data);
    }

    // Check Login
    function check_login($user,$pass){
        $this->db->where('username',$user);
        $this->db->where('password',$pass);
        return $this->db->get('user');
    }

    // Saldo Kas
    function create_saldo_kas($data){
        $this->db->insert('saldo_kas',$data);
    }
    function update_saldo_kas($id,$data){
        $this->db->where('iduser',$id);
        $this->db->update('saldo_kas',$data);
    }

    // Piutang
    function create_piutang($data){
        $this->db->insert('piutang',$data);
    }
    function edit_piutang($id,$data){
        $this->db->where("id",$id);
        $this->db->update('piutang',$data);
    }
    function delete_piutang($id){
        $this->db->where("id", $id);
        $query = $this->db->get('piutang');
        $row = $query->row();
        unlink("Foto/Piutang/$row->bukti_transaksi");
        $this->db->delete('piutang', array('id' => $id));
    }

    // Barang dagang
    function create_barang_dagang($data){
        $this->db->insert('barang_dagangan',$data);
    }
    function edit_barang_dagang($id,$data){
        $this->db->where("id",$id);
        $this->db->update('barang_dagangan',$data);
    }
    function delete_barang_dagang($id){
        $this->db->where("id", $id);
        $this->db->delete('barang_dagangan');
    }
    function edit_barang_dagang_retur($id_user,$nama_barang,$data){
        $this->db->where("iduser",$id_user);
        $this->db->where("nama_barang",$nama_barang);
        $this->db->update('barang_dagangan',$data);
    }

    function get_barang($title,$id){
        $this->db->where('iduser',$id);
        $this->db->like('nama_barang', $title , 'both');
        return $this->db->get('barang_dagangan')->result();
    }

    // Barang Lainnya
    function create_barang_lainnya($data){
        $this->db->insert('barang_lainnya',$data);
    }
    function edit_barang_lainnya($id,$data){
        $this->db->where("id",$id);
        $this->db->update('barang_lainnya',$data);
    }
    function delete_barang_lainnya($id){
        $this->db->where("id", $id);
        $this->db->delete('barang_lainnya');
    }

    // Activa Tetap
    function create_activa_tetap($data){
        $this->db->insert('activa_tetap',$data);
    }
    function edit_activa_tetap($id,$data){
        $this->db->where("id",$id);
        $this->db->update('activa_tetap',$data);
    }
    function update_activa_tetap($id){
        $this->db->where("id",$id);
        return $this->db->get('activa_tetap');
    }
    function delete_activa_tetap($id){
        $this->db->where("id", $id);
        $this->db->delete('activa_tetap');
    }

    // Activa Lainnya
    function create_activa_lainnya($data){
        $this->db->insert('activa_lainnya',$data);
    }
    function edit_activa_lainnya($id,$data){
        $this->db->where("id",$id);
        $this->db->update('activa_lainnya',$data);
    }
    function update_activa_lainnya($id){
        $this->db->where("id",$id);
        return $this->db->get('activa_lainnya');
    }
    function delete_activa_lainnya($id){
        $this->db->where("id", $id);
        $this->db->delete('activa_lainnya');
    }

    // Hutang
    function create_hutang($data){
        $this->db->insert('hutang',$data);
    }
    function edit_hutang($id,$data){
        $this->db->where("id",$id);
        $this->db->update('hutang',$data);
    }
    function delete_hutang($id){
        $this->db->where("id", $id);
        $query = $this->db->get('hutang');
        $row = $query->row();
        unlink("Foto/Hutang/$row->bukti_transaksi");
        $this->db->delete('hutang', array('id' => $id));
    }

    // Transaksi Pokok : Pembelian
    function create_transaksi_pokok_pembelian($data){
        $this->db->insert('pembelian',$data);
    }
    // Adjustment Pembelian
    function delete_pembelian($id){
        $this->db->where("id", $id);
        $query = $this->db->get('pembelian');
        $row = $query->row();
        unlink("Foto/Pembelian/$row->bukti_pembelian");
        $this->db->delete('pembelian', array('id' => $id));
    }
    function update_pembelian($id){
        $this->db->where("id",$id);
        return $this->db->get('pembelian');
    }
    function edit_pembelian($id,$data){
        $this->db->where("id",$id);
        $this->db->update('pembelian',$data);
    }

    // Transaksi Pokok : Penjualan
    function create_transaksi_pokok_penjualan($data){
        $this->db->insert('penjualan',$data);
    }
    // Adjustment Penjualan
    function update_penjualan($id){
        $this->db->where("id",$id);
        return $this->db->get('penjualan');
    }
    function edit_penjualan($id,$data){
        $this->db->where("id",$id);
        $this->db->update('penjualan',$data);
    }
    function delete_penjualan($id){
        $this->db->where("id", $id);
        $query = $this->db->get('penjualan');
        $row = $query->row();
        unlink("Foto/Penjualan/$row->bukti_penjualan");
        $this->db->delete('penjualan', array('id' => $id));
    }

    // Transaksi Pokok : Pembayaran Hutang
    function create_transaksi_pokok_pembayaran_hutang($data){
        $this->db->insert('bayar_hutang',$data);
    }
    // Adjustment Pembayaran Hutang
    function update_pembayaran_hutang($id){
        $this->db->where("id",$id);
        return $this->db->get('bayar_hutang');
    }
    function edit_pembayaran_hutang($id,$data){
        $this->db->where("id",$id);
        $this->db->update('bayar_hutang',$data);
    }
    function delete_pembayaran_hutang($id){
        $this->db->where("id", $id);
        $query = $this->db->get('bayar_hutang');
        $row = $query->row();
        unlink("Foto/Bayar_Hutang/$row->foto_bukti");
        $this->db->delete('bayar_hutang', array('id' => $id));
    }

    // Transaksi Pokok : Penerimaan Piutang
    function create_transaksi_pokok_penerimaan_piutang($data){
        $this->db->insert('bayar_piutang',$data);
    }
    // Adjustment Bayar Piutang
    function update_bayar_piutang($id){
        $this->db->where("id",$id);
        return $this->db->get('bayar_piutang');
    }
    function edit_bayar_piutang($id,$data){
        $this->db->where("id",$id);
        $this->db->update('bayar_piutang',$data);
    }
    function delete_bayar_piutang($id){
        $this->db->where("id", $id);
        $query = $this->db->get('bayar_piutang');
        $row = $query->row();
        unlink("Foto/Bayar_Piutang/$row->foto_bukti");
        $this->db->delete('bayar_piutang', array('id' => $id));
    }

    // Transaksi Pokok Retur
    function create_retur($data){
        $this->db->insert('retur',$data);
    }
    // Adjustment Retur
    function update_retur($id){
        $this->db->where("id",$id);
        return $this->db->get('retur');
    }
    function edit_retur($id,$data){
        $this->db->where("id",$id);
        $this->db->update('retur',$data);
    }
    function delete_retur($id){
        $this->db->where("id", $id);
        $query = $this->db->get('retur');
        $row = $query->row();
        if ($row->jenis_retur=='Pembelian') {
            unlink("Foto/Retur_Pembelian/$row->bukti_pembelian");
        } else {
            unlink("Foto/Retur_Penjualan/$row->bukti_pembelian");
        }
        $this->db->delete('retur', array('id' => $id));
    }

    // Transaksi Lainnya
    function create_pemasukan_modal($data){
        $this->db->insert('modal',$data);
    }
    function create_pemasukan($data){
        $this->db->insert('pemasukan',$data);
    }
    function create_pengeluaran($data){
        $this->db->insert('pengeluaran',$data);
    }
    function create_hibah($data){
        $this->db->insert('hibah',$data);
    }
    function create_dividen($data){
        $this->db->insert('dividen',$data);
    }
    function create_biaya($data){
        $this->db->insert('biaya',$data);
    }

    // Adjustment Pemasukan
    function update_pemasukan($id){
        $this->db->where("id",$id);
        return $this->db->get('pemasukan');
    }
    function edit_pemasukan($id,$data){
        $this->db->where("id",$id);
        $this->db->update('pemasukan',$data);
    }
    function delete_pemasukan($id){
        $this->db->where("id", $id);
        $query = $this->db->get('pemasukan');
        $row = $query->row();
        unlink("Foto/Pemasukan/$row->bukti_bayar");
        $this->db->delete('pemasukan', array('id' => $id));
    }

    // Adjustment Pengeluaran
    function update_pengeluaran($id){
        $this->db->where("id",$id);
        return $this->db->get('pengeluaran');
    }
    function edit_pengeluaran($id,$data){
        $this->db->where("id",$id);
        $this->db->update('pengeluaran',$data);
    }
    function delete_pengeluaran($id){
        $this->db->where("id", $id);
        $query = $this->db->get('pengeluaran');
        $row = $query->row();
        unlink("Foto/Pengeluaran/$row->bukti_bayar");
        $this->db->delete('pengeluaran', array('id' => $id));
    }

    public function cekUsername($data){
        $query = $this->db->get_where('user', ['username' => $data['username']]);
        return $query;
    }  
}