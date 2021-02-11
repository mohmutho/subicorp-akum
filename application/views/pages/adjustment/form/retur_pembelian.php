<?php
$id = "";
$id = "";
$nama_barang = "";
$jumlah = "";
$tanggal = "";
$bukti_pembelian = "";
$keterangan = "";
$nm_brg_beli = "";
$total_harga = "";
$beli_dari = "";
$stok = "";
if ($main['op']=='edit') {
    foreach ($main['sql2']->result() as $obj) {
        $op = "edit";
        $id = $obj->id;
        $nama_barang = $obj->nama_barang;
        $jumlah = $obj->jumlah;
        $harga_barang = $obj->harga_barang;
        $total_harga_retur = $obj->total_harga;
        $tanggal = $obj->tgl_retur;
        $tanggal_jatuh = $obj->tgl_jatuh;
        $bukti_pembelian = $obj->bukti_pembelian;
        $keterangan = $obj->keterangan;
    }
    $query = $this->db->query("SELECT * FROM pembelian where pembelian_dari = '$nama_barang'");
    foreach ($query->result() as $val) {
        $nm_brg_beli = $val->nama_barang;
        $total_harga = $val->total_harga;
        $beli_dari = $val->pembelian_dari;
        $stok = $val->jumlah;
    }
}
?>
<!-- Form Adjustment Piutang Transaksi Pokok -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Retur Pembelian
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Retur Pembelian</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body form-horizontal">
            <?php echo form_open_multipart('adjustment/create_retur_pembelian/');?>
            <input type="hidden" name="op" value="<?php echo $main['op'];?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="autoSum">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal" class="form-controls" id="datepicker"  placeholder="Tanggal Transaksi" value="<?php echo $tanggal;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama Transaksi</label>
                        <div class="col-sm-10">
                            <select id="pilih_retur" name="pembelian_id" class="form-controls-select" onchange='changeValue(this.value)' required>
                            <option value="">Pilih</option>
                                <?php
                                    $jsArray = "var prdName = new Array();\n";
                                    foreach($main['sql']->result() as $obj){
                                        $pembelian_dari = $obj->pembelian_dari;
                                        $jumlah_barang = $obj->jumlah;
                                        $nama_barang_beli = $obj->nama_barang;
                                        $harga_barang = $obj->harga_barang;
                                        $total_harga_beli = $obj->total_harga;
                                ?>
                                <option value="<?php echo $obj->id;?>" <?php if($nama_barang==$pembelian_dari) echo 'selected';?>>
                                    <?php echo $pembelian_dari;?>
                                </option>
                                <?php
                                    $jsArray .= "prdName['". $obj->id . "'] = {jumlah_barang:'" . addslashes($jumlah_barang) . 
                                      "',nama_barang_beli:'" . addslashes($nama_barang_beli) . 
                                      "',total_harga_beli:'" . addslashes($total_harga_beli) . 
                                      "',pembelian_dari:'" . addslashes($pembelian_dari) . 
                                      "',harga_barang:'" . addslashes($harga_barang) . 
                                      "'};\n";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input readonly type="text" name="nama_barang" id="nama_barang" class="form-controls" placeholder="Nama Barang" value="<?php echo $nm_brg_beli;?>" required>
                            <input readonly type="hidden" name="total_harga" id="total_harga" class="form-controls" placeholder="Nama Barang" value="<?php echo $total_harga;?>" required>
                            <input readonly type="hidden" name="pembelian_dari" id="pembelian_dari" class="form-controls" placeholder="Nama Barang" value="<?php echo $beli_dari;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Jumlah Barang</label>
                        <div class="col-sm-10">
                            <input readonly type="text" id="jumlah" class="form-controls" placeholder="Jumlah Barang" value="<?php echo $stok;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Harga Satuan Barang</label>
                        <div class="col-sm-10">
                            <input readonly type="text" name="harga_barang" id="harga_barang" class="form-controls" placeholder="Harga Satuan Barang" value="<?php echo $harga_barang;?>" required>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Jumlah Barang Diretur</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah_retur" class="form-controls" id="jumlah_retur" placeholder="Jumlah Barang Diretur" value="<?php echo $jumlah;?>" oninput="gantiValueJumlah()" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Total Harga Barang diretur</label>
                        <div class="col-sm-10">
                            <input readonly type="text" name="total_harga_retur" id="total_harga_retur" class="form-controls" placeholder="Total Harga Barang" value="<?php echo $total_harga_retur;?>" required>    
                        </div>
                    </div>
                    <script type="text/javascript">    
                        <?php echo $jsArray; ?>  
                        function changeValue(x){  
                            document.getElementById('nama_barang').value = prdName[x].nama_barang_beli;
                            document.getElementById('jumlah').value = prdName[x].jumlah_barang;
                            document.getElementById('harga_barang').value = prdName[x].harga_barang;
                            document.getElementById('pembelian_dari').value = prdName[x].pembelian_dari;
                            // document.getElementById('total_harga').value = prdName[x].total_harga_beli;
                        };
                        function gantiValueJumlah(){
                            var valueJumlah = $('#pilih_retur').val();
                            // console.log(valueJumlah);
                            var jumlah_barang_retur = document.getElementById('jumlah_retur').value;
                            // console.log(jumlah_barang_retur);
                            var total_harga_retur = jumlah_barang_retur * prdName[valueJumlah].harga_barang;
                            console.log();
                            document.getElementById('total_harga_retur').value = total_harga_retur;
                        };
                    </script>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal_jatuh" class="form-controls" id="datepicker2"  placeholder="Tanggal Jatuh Tempo" value="<?php echo $tanggal_jatuh;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Bukti Transaksi</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-controls" name="photo" <?php if($main['op']=='tambah') echo 'required';?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="" cols="10" rows="5" placeholder="Keterangan Biaya Lain-lain" class="form-controls"><?php echo $keterangan;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="<?php echo site_url('adjustment/retur_pembelian');?>" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-akumm">Simpan</button>
                        </div>
                    </div>
                    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                    <script type ="text/javascript">
                        $(".autoSum").keyup(function(){
                            var jumlah_barang = parseInt($("#jumlah").val())
                            var jumlah_retur = parseInt($("#jumlah_retur").val())

                            if(jumlah_retur>jumlah_barang){
                                alert('Jumlah retur melebihi jumlah barang yang dijual.');
                            }
                        });
                    </script>
                </div>
            <?php echo form_close();?>
            </div>
        </div>
    </section>
  </div>
</div>