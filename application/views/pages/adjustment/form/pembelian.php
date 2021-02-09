<?php
$id = "";
$idbarang = 0;
$pembelian_dari = "";
$nama_barang = "";
$jenis_barang = "";
$satuan = "";
$jumlah = "";
$jumlah2 = "";
$harga_diskon = "";
$harga_diskon2 = 0;
$harga_barang = "";
$harga_barang2 = "";
$harga_lainnya = "";
$harga_lainnya2 = 0;
$total_harga = "";
$total_harga2 = "";
$tanggal_pembelian = "";
$tipe_pembayaran = "";
$total_cash = "";
$total_cash2 = "";
$total_credit = "";
$total_credit2 = "";
$bukti_pembelian = "";
$notes_harga_lainnya = "";
if ($main['op']=='edit') {
    foreach ($main['sql']->result() as $obj) {
        $op = "edit";
        $id = $obj->id;
        $pembelian_dari = $obj->pembelian_dari;
        $nama_barang = $obj->nama_barang;
        $jenis_barang = $obj->jenis_barang;
        $satuan = $obj->satuan;
        $jumlah = number_format($obj->jumlah,0,'','.');
        $jumlah2 = $obj->jumlah;
        $harga_diskon = number_format($obj->harga_diskon,0, '', '.');
        $harga_diskon2 = $obj->harga_diskon;
        $harga_barang = number_format($obj->harga_barang,0, '', '.');
        $harga_barang2 = $obj->harga_barang;
        $harga_lainnya = number_format($obj->harga_lainnya,0, '', '.');
        $harga_lainnya2 = $obj->harga_lainnya;
        $total_harga = number_format($obj->total_harga,0, '', '.');
        $total_harga2 = $obj->total_harga;
        $tanggal_pembelian = $obj->tanggal_pembelian;
        $tipe_pembayaran = $obj->tipe_pembayaran;
        $total_cash = number_format($obj->total_cash,0, '', '.');
        $total_cash2 = $obj->total_cash;
        $total_credit = number_format($obj->total_credit,0, '', '.');
        $total_credit2 = $obj->total_credit;
        $bukti_pembelian = $obj->bukti_pembelian;
        $notes_harga_lainnya = $obj->notes_harga_lainnya;
    }
    $query_barang = $this->db->query("SELECT * FROM barang_dagangan where nama_barang = '$nama_barang'");
    foreach ($query_barang->result() as $val) {
        $idbarang = $val->id;
    }
}
?>
<!-- Form Adjustment Pembelian -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Pembelian
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Pembelian</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body form-horizontal">
              <?php echo form_open_multipart('adjustment/create_pembelian/');?>
                <input type="hidden" name="op" value="<?php echo $main['op'];?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">
              <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_pembelian" class="form-controls" id="datepicker" placeholder="Tanggal Transaksi" value="<?php echo $tanggal_pembelian;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" name="pembelian_dari" class="form-controls" id="inputName" placeholder="Nama Supplier" value="<?php echo $pembelian_dari;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Barang</label>
                    <div class="col-sm-10">
                        <select name="jenis_barang" class="form-controls-select">
                          <option value="">Pilih</option>
                          <option value="Barang Setengah Jadi" <?php if ($jenis_barang=='Barang Setengah Jadi') echo 'selected'?>>Barang Setengah Jadi</option>
                          <option value="Barang Jadi" <?php if ($jenis_barang=='Barang Jadi') echo 'selected'?>>Barang Jadi</option>
                          <option value="Barang Baku" <?php if ($jenis_barang=='Barang Baku') echo 'selected'?>>Barang Baku</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="idbarang" value="<?php echo $idbarang;?>">
                        <input type="text" class="form-controls" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jumlah Barang</label>
                    <div class="col-sm-10">
                        <input type="text" id="jumlah_barang" onkeyup="total();" name="jumlah" class="form-controls" placeholder="Jumlah Barang" value="<?php echo $jumlah2;?>" required>
                        <input type="text" id="jml_brg" class="span-block" value="<?php echo $jumlah;?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Satuan</label>
                    <div class="col-sm-10">
                        <select name="satuan" class="form-controls-select">
                          <option value="">Pilih</option>
                          <option value="Kg" <?php if ($satuan=='Kg') echo 'selected'?>>Kg</option>
                          <option value="Ton" <?php if ($satuan=='Ton') echo 'selected'?>>Ton</option>
                          <option value="Sack" <?php if ($satuan=='Sack') echo 'selected'?>>Sack</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Harga Satuan</label>
                    <div class="col-sm-10">
                        <input type="number" id="harga_satuan" onkeyup="total();" name="harga_barang" class="form-controls" placeholder="Harga Satuan Barang" value="<?php echo $harga_barang2;?>" required>
                        <input type="text" id="hrg_brg" class="span-block" value="Rp. <?php echo $harga_barang;?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Diskon Pembelian</label>
                    <div class="col-sm-10">
                        <input type="number" id="diskon" onkeyup="total();" name="diskon" class="form-controls" placeholder="Diskon Pembelian" value="<?php echo $harga_diskon2;?>" required>
                        <input type="text" id="dsk" class="span-block" value="Rp. <?php echo $harga_diskon;?>" readonly>
                    </div>
                </div>
                <form>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <input type="number" id="biaya_lain" onkeyup="total();" name="harga_lainnya" class="form-controls" placeholder="Harga Lain-lain" value="<?php echo $harga_lainnya2;?>" required>
                        <input type="text" id="hrg_lain" class="span-block" value="Rp. <?php echo $harga_lainnya;?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Keterangan Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <textarea name="notes_harga_lainnya" id="" cols="10" rows="5" placeholder="Keterangan Biaya Lain-lain" class="form-controls"><?php echo $notes_harga_lainnya; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Bukti Transaksi</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo" <?php if($main['op']=='tambah') echo 'required';?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Nilai Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" id="total" class="form-controls" placeholder="Total Nilai Transaksi" value="<?php echo "Rp. ".$total_harga;?>" readonly required>
                        <input type="hidden" id="ttl_hrg" name="total_harga" class="span-block" value="<?php echo $total_harga2;?>" readonly>
                    </div>
                </div>
                </form>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Pembayaran</label>
                    <div class="col-sm-10">
                        <select name="tipe_pembayaran" class="form-controls-select" onchange="show_value(this.value)" required>
                          <option value="">Pilih</option>
                          <option value="Cash" <?php if ($tipe_pembayaran=='Cash') echo 'selected'?>>Cash</option>
                          <option value="Kredit" <?php if ($tipe_pembayaran=='Kredit') echo 'selected'?>>Kredit</option>
                          <option value="Cash dan Kredit" <?php if ($tipe_pembayaran=='Cash dan Kredit') echo 'selected'?>>Cash dan Kredit</option>
                        </select>
                    </div>
                </div>
                <?php 
                    if ($tipe_pembayaran=='Cash dan Kredit' AND $main['op']=='edit') {
                ?>
                <div id="formck">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Cash</label>
                        <div class="col-sm-10">
                            <input type="text" id="cash" name="cash" class="form-controls" placeholder="Cash" value="<?php echo $total_cash2;?>">
                            <input type="text" id="csh" class="span-block" value="Rp. <?php echo $total_cash;?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Kredit</label>
                        <div class="col-sm-10">
                            <input readonly type="text" id="sisa_kredit" class="form-controls" placeholder="Kredit" value="Rp. <?php echo $total_credit;?>">
                            <input type="hidden" id="ss_krdt" name="sisa_kredit" class="span-block" value="<?php echo $total_credit2;?>" readonly>
                        </div>
                    </div>
                </div>
                <?php
                    } else{ ?>
                    <div id="formck" style="display: none;">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Cash</label>
                            <div class="col-sm-10">
                                <input type="text" id="cash" name="cash" class="form-controls" placeholder="Cash">
                                <input type="text" id="csh" value="" class="span-block" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Kredit</label>
                            <div class="col-sm-10">
                                <input readonly type="text" id="sisa_kredit" class="form-controls" placeholder="Kredit">
                                <input type="hidden" id="ss_krdt" name="sisa_kredit" value="" class="span-block" readonly>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="<?php echo base_url();?>adjustment" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-akumm">Simpan</button>
                    </div>
                </div>
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script type ="text/javascript">
                    $(".autoSum").keyup(function(){
                        var jumlah_barang = parseInt($("#jumlah_barang").val())
                        var harga_satuan = parseInt($("#harga_satuan").val())
                        var diskon = parseInt($("#diskon").val())
                        var biaya_lain = parseInt($("#biaya_lain").val())
                        var cash = parseInt($("#cash").val())
                        
                        var total = ((jumlah_barang * harga_satuan) - diskon) + biaya_lain;
                        $("#ttl_hrg").attr("value",total);

                        var ttl_hrg = formatRupiah($("#ttl_hrg").val())
                        $("#total").attr("value","Rp "+ttl_hrg);

                        if (cash>total) {
                            alert('Nilai Cash tidak boleh melebihi Total Nilai Transaksi!');
                        }else{
                            var sisa_kredit = total - cash;
                        }

                        var jml = formatRupiah($("#jumlah_barang").val());
                        var hrg = formatRupiah($("#harga_satuan").val());
                        var dsk = formatRupiah($("#diskon").val());
                        var hrg_lain = formatRupiah($("#biaya_lain").val());
                        var csh = formatRupiah($("#cash").val());

                        $("#jml_brg").attr("value",jml);
                        $("#hrg_brg").attr("value","Rp "+hrg);
                        $("#dsk").attr("value","Rp. "+dsk);
                        $("#hrg_lain").attr("value","Rp "+hrg_lain);
                        $("#csh").attr("value","Rp. "+csh);
                        $("#ss_krdt").attr("value",sisa_kredit);

                        var ss_krdt = formatRupiah($("#ss_krdt").val());
                        $("#sisa_kredit").attr("value","Rp. "+ss_krdt);

                    });
                    var x = document.getElementById("formck");
                    function show_value(val){
                        if (val=='Cash dan Kredit') {
                            x.style.display = "block";
                        }else{
                            x.style.display = "none";
                        }
                    }
                    function formatRupiah(angka, prefix)
                    {
                        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa  = split[0].length % 3,
                        rupiah  = split[0].substr(0, sisa),
                        ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
                        
                        if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                        }
                        
                        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                    }
                </script>
              </div>
              <?php echo form_close();?>
            </div>
        </div>
    </section>
  </div>
</div>