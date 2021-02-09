<?php
$id = "";
$idbarang = 0;
$penjualanke = "";
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
$harga_pokok_penjualan = "";
$harga_pokok_penjualan2 = "";
$tanggal_penjualan = "";
$jenis_pembayaran = "";
$total_cash = "";
$total_cash2 = "";
$total_credit = "";
$total_credit2 = "";
$bukti_penjualan = "";
$notes_harga_lainnya = "";
if ($main['op']=='edit') {
    foreach ($main['sql3']->result() as $obj) {
        $op = "edit";
        $id = $obj->id;
        $penjualanke = $obj->penjualanke;
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
        $harga_pokok_penjualan = number_format($obj->harga_pokok_penjualan,0, '', '.');
        $harga_pokok_penjualan2 = $obj->harga_pokok_penjualan;
        $tanggal_penjualan = $obj->tanggal_penjualan;
        $jenis_pembayaran = $obj->jenis_pembayaran;
        $total_cash = number_format($obj->total_cash,0, '', '.');
        $total_cash2 = $obj->total_cash;
        $total_credit = number_format($obj->total_credit,0, '', '.');
        $total_credit2 = $obj->total_credit;
        $bukti_penjualan = $obj->bukti_penjualan;
        $notes_harga_lainnya = $obj->notes_harga_lainnya;
    }
    $query_barang = $this->db->query("SELECT * FROM barang_dagangan where nama_barang = '$nama_barang'");
    foreach ($query_barang->result() as $val) {
        $idbarang = $val->id;
        $stok = $val->jumlah_barang;
    }
}
?>
<!-- Form Adjustment Penjualan -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Penjualan
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Penjualan</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body form-horizontal">
            <?php echo form_open_multipart('adjustment/create_penjualan/');?>
            <input type="hidden" name="op" value="<?php echo $main['op'];?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_penjualan" class="form-controls" id="datepicker" placeholder="Tanggal Transaksi" value="<?php echo $tanggal_penjualan;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Costumer</label>
                    <div class="col-sm-10">
                        <input type="text" name="penjualanke" class="form-controls" id="inputName" placeholder="Nama Costumer" value="<?php echo $penjualanke;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <select id="id_barang" name="id_barang" class="form-controls-select" onchange='changeValue(this.value)' required>
                          <option value="">Pilih</option>
                            <?php
                                $jsArray = "var prdName = new Array();\n";
                                foreach($main['sql']->result() as $obj){
                                    $jbarang = $obj->jenis_barang;
                                    $sbarang = $obj->satuan;
                                    $hsbarang = $obj->harga_satuan;
                                    $nmbarang = $obj->nama_barang;
                                    $jmbarang = $obj->jumlah_barang;
                            ?>
                            <option value="<?php echo $obj->id;?>" <?php if($nama_barang==$obj->nama_barang) echo 'selected';?>>
                                <?php echo $obj->nama_barang;?>
                            </option>
                            <?php
                                $jsArray .= "prdName['". $obj->id . "'] = {jenis_barang:'" . addslashes($jbarang) . "',satuan:'" . addslashes($sbarang) . "',harga_satuan:'" . addslashes($hsbarang) . "',nama_barang:'" . addslashes($nmbarang) . "',jumlah_barang:'" . addslashes($jmbarang) . "'};\n";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
                    foreach ($main['sql2']->result() as $obj) {
                        $saldo_kas = $obj->saldo_kas;
                ?>
                    <input type="hidden" name="saldo_kas" value="<?php echo $saldo_kas;?>">
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Barang</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="jenis_barang" name="jenis_barang" class="form-controls" placeholder="Jenis Barang" value="<?php echo $jenis_barang;?>" required>
                        <input type="hidden" id="nama_barang" name="nama_barang" class="form-controls" placeholder="Jenis Barang" value="<?php echo $nama_barang;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Stock Barang</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="jumlah" name="jumlah" class="form-controls" placeholder="Stock Barang" value="<?php echo $stok;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jumlah Barang</label>
                    <div class="col-sm-10">
                        <input type="text" id="jumlah_barang" onkeyup="total();" name="jumlah_barang" class="form-controls" placeholder="Jumlah Barang" value="<?php echo $jumlah2;?>" required>
                        <input type="text" id="jml_brg" value="<?php echo $jumlah;?>" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Satuan</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="satuan" name="satuan" class="form-controls" value="<?php echo $satuan;?>" placeholder="Satuan" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Harga Satuan</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="harga_satuan" class="form-controls" placeholder="Harga Satuan Barang" value="Rp. <?php echo $harga_barang;?>" required>
                        <input type="hidden" id="hrg_st" name="harga_satuan" value="<?php echo $harga_barang2;?>" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Diskon Pembelian</label>
                    <div class="col-sm-10">
                        <input type="text" id="diskon" onkeyup="total();" name="diskon" class="form-controls" value="<?php echo $harga_diskon2;?>" placeholder="Diskon Pembelian (Isikon 0 (nol) jika tidak ada)" required>
                        <input type="text" id="dsk" value="Rp. <?php echo $harga_diskon;?>" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Harga Pokok Penjualan</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="total_nilai_barang" class="form-controls" placeholder="Total Harga Pokok Penjualan" value="Rp. <?php echo $harga_pokok_penjualan;?>" required>
                        <input type="hidden" id="ttl_nl" name="harga_pokok_penjualan" value="<?php echo $harga_pokok_penjualan2;?>" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <input type="text" id="harga_lainnya" onkeyup="total();" name="harga_lainnya" class="form-controls" value="0" placeholder="Harga Lain-lain (Isikon 0 (nol) jika tidak ada)" value="<?php echo $harga_lainnya2;?>" required>
                        <input type="text" id="hrg_ln" class="span-block" value="Rp. <?php echo $harga_lainnya;?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Keterangan Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <textarea name="notes_harga_lainnya" cols="10" rows="5" placeholder="Keterangan Biaya Lain-lain" class="form-controls"><?php echo $notes_harga_lainnya;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Bukti Transaksi</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo" <?php if($main['op']=='tambah') echo 'required';?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Harga Transaksi</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="total" class="form-controls" id="inputName" placeholder="Total Harga Transaksi" value="Rp. <?php echo $total_harga;?>" required>
                        <input type="hidden" id="ttl_hrg" name="total_harga" value="<?php echo $total_harga2;?>" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Pembayaran</label>
                    <div class="col-sm-10">
                        <select name="jenis_pembayaran" class="form-controls-select" onchange="show_value(this.value)" required>
                          <option value="">Pilih</option>
                          <option value="Cash" <?php if ($jenis_pembayaran=='Cash') echo 'selected'?>>Cash</option>
                          <option value="Kredit" <?php if ($jenis_pembayaran=='Kredit') echo 'selected'?>>Kredit</option>
                          <option value="Cash dan Kredit" <?php if ($jenis_pembayaran=='Cash dan Kredit') echo 'selected'?>>Cash dan Kredit</option>
                        </select>
                    </div>
                </div>
                <?php 
                    if ($jenis_pembayaran=='Cash dan Kredit' AND $main['op']=='edit') {
                ?>
                <div id="formck">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Cash</label>
                        <div class="col-sm-10">
                            <input type="text" id="cash" name="cash" class="form-controls" placeholder="Cash" value="<?php echo $total_cash2;?>">
                            <input type="text" id="csh" value="Rp. <?php echo $total_cash;?>" class="span-block" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Kredit</label>
                        <div class="col-sm-10">
                            <input readonly type="text" id="sisa_kredit" class="form-controls" placeholder="Kredit" value="Rp. <?php echo $total_credit;?>">
                            <input type="hidden" id="ss_krdt" name="sisa_kredit" value="<?php echo $total_credit2;?>" class="span-block" readonly>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
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
                <?php } ?>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-akumm">Simpan</button>
                    </div>
                </div>
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script type ="text/javascript">
                  $(".autoSum").keyup(function(){
                    var jumlah_barang = parseInt($("#jumlah_barang").val())
                    var harga_satuan = parseInt($("#hrg_st").val())
                    var diskon = parseInt($("#diskon").val())
                    var biaya_lain = parseInt($("#harga_lainnya").val())
                    var cash = parseInt($("#cash").val())
                    var stock = parseInt($("#jumlah").val())

                    if (jumlah_barang>stock) {
                        alert('Stock tidak mencukupi.');
                    }

                    var total_pokok = (jumlah_barang * harga_satuan) - diskon
                    $("#ttl_nl").attr("value",total_pokok);
                    var ttl_nl = formatRupiah($("#ttl_nl").val())
                    $("#total_nilai_barang").attr("value","Rp. "+ttl_nl);

                    var total = ((jumlah_barang * harga_satuan) - diskon) + biaya_lain
                    $("#ttl_hrg").attr("value",total);
                    var ttl_hrg = formatRupiah($("#ttl_hrg").val())
                    $("#total").attr("value","Rp. "+ttl_hrg);

                    if (cash>total) {
                        alert('Nilai Cash tidak boleh melebihi Total Harga Transaksi!');
                    }else{
                        var sisa_kredit = total - cash;
                    }

                    var jml = formatRupiah($("#jumlah_barang").val());
                    var dsk = formatRupiah($("#diskon").val());
                    var hrg_ln = formatRupiah($("#harga_lainnya").val());
                    var csh = formatRupiah($("#cash").val());

                    $("#hrg_ln").attr("value","Rp. "+hrg_ln);
                    $("#dsk").attr("value","Rp. "+dsk);
                    $("#jml_brg").attr("value",jml);
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
                  <?php echo $jsArray; ?>
                    function changeValue(x){
                        document.getElementById('jumlah').value = prdName[x].jumlah_barang;   
                        document.getElementById('jenis_barang').value = prdName[x].jenis_barang;   
                        document.getElementById('satuan').value = prdName[x].satuan;   
                        document.getElementById('harga_satuan').value = formatRupiah(prdName[x].harga_satuan,0,'','.');
                        document.getElementById('hrg_st').value = prdName[x].harga_satuan;
                        document.getElementById('nama_barang').value = prdName[x].nama_barang;
                    };
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