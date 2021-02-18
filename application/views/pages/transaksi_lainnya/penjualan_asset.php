<!-- Pemasukan Penjualan Asset -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Penjualan Asset
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Pemasukan</li>
          <li class="active">Penjualan Asset</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header">
                
            </div>
            <div class="box-body form-horizontal">
            <?php echo form_open_multipart('pemasukan/create_penjualan_asset/');?>
              <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pilih Jenis Asset</label>
                    <div class="col-sm-10">
                        <select name="pilih_jenis_asset" id="pilih_jenis_asset" class="form-controls-select" onchange='jenis_asset(this.value)' required>
                          <option value="">Pilih Jenis Asset</option>
                          <option value="Tanah">Tanah</option>
                          <option value="Tanah dan Bangunan">Tanah dan Bangunan</option>
                          <option value="BARU">Baru</option>
                          <option value="BEKAS">Bekas</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pilih Asset</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" name="nama_asset" class="form-controls" placeholder="Nama Asset" required> -->
                        <select id="selectAssetKosong" class="form-controls-select">
                          <option value="">Pilih Asset</option>
                        </select>
                        <select name="id_asset_tanah" id="selectAssetTetapTanah" class="form-controls-select" style="display: none;" onchange='changeValue(this.value)'>
                          <option value="">Pilih Asset</option>
                          <?php 
                            $jsArraytanah = "var prdNameTanah = new Array();\n";
                            foreach($main['sql4']->result() as $obj){
                                $nama_activa = $obj->nama_activa;
                                $nilai_tanah = $obj->nilai_tanah;
                                $nilai_bangunan = $obj->nilai_bangunan;
                          ?>
                          <option value="<?php echo $obj->id;?>"><?php echo $nama_activa;?></option>
                          <?php
                            $jsArraytanah .= "prdNameTanah['". $obj->id . "'] = {nilai_tanah:'" . addslashes($nilai_tanah) .
                              "',nilai_bangunan:'" . addslashes($nilai_bangunan) . 
                              "',nama_activa:'" . addslashes($nama_activa) . 
                              "'};\n";
                            }
                          ?>
                        </select>

                        <select name="id_asset_tanah_dan_bangunan" id="selectAssetTetapTanahdanBangunan" class="form-controls-select" style="display: none;" onchange='changeValue(this.value)'>
                          <option value="">Pilih Asset</option>
                          <?php 
                            $jsArraytnb = "var prdNametnb = new Array();\n";
                            foreach($main['sql5']->result() as $obj){
                                $nama_activa = $obj->nama_activa;
                                $nilai_tanah = $obj->nilai_tanah;
                                $nilai_bangunan = $obj->nilai_bangunan;
                          ?>
                          <option value="<?php echo $obj->id;?>"><?php echo $nama_activa;?></option>
                          <?php
                            $jsArraytnb .= "prdNametnb['". $obj->id . "'] = {nilai_tanah:'" . addslashes($nilai_tanah) .
                              "',nilai_bangunan:'" . addslashes($nilai_bangunan) . 
                              "',nama_activa:'" . addslashes($nama_activa) . 
                              "'};\n";
                            }
                          ?>
                        </select>

                        <select name="id_asset_lainnya_baru" id="selectAssetLainnyaBaru" class="form-controls-select" style="display: none;" onchange='changeValue(this.value)'>
                          <option value="">Pilih Asset</option>
                          <?php 
                            $jsArraybaru = "var prdNameBaru = new Array();\n";
                            foreach($main['sql7']->result() as $obj){
                                $nama_activa = $obj->nama_activa;
                                $nilai_activa = $obj->nilai_activa;
                          ?>
                          <option value="<?php echo $obj->id;?>"><?php echo $nama_activa;?></option>
                          <?php
                            $jsArraybaru .= "prdNameBaru['". $obj->id . "'] = {nilai_activa:'" . addslashes($nilai_activa) .
                              "',nama_activa:'" . addslashes($nama_activa) . 
                              "'};\n";
                            }
                          ?>
                        </select>

                        <select name="id_asset_lainnya_bekas" id="selectAssetLainnyaBekas" class="form-controls-select" style="display: none;" onchange='changeValue(this.value)'>
                          <option value="">Pilih Asset</option>
                          <?php 
                            $jsArraybekas = "var prdNameBekas = new Array();\n";
                            foreach($main['sql6']->result() as $obj){
                                $nama_activa = $obj->nama_activa;
                                $nilai_activa = $obj->nilai_activa;
                          ?>
                          <option value="<?php echo $obj->id;?>"><?php echo $nama_activa;?></option>
                          <?php
                            $jsArraybekas .= "prdNameBekas['". $obj->id . "'] = {nilai_activa:'" . addslashes($nilai_activa) .
                              "',nama_activa:'" . addslashes($nama_activa) . 
                              "'};\n";
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
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Penjualan</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker" placeholder="Tanggal Penjualan" required>
                    </div>
                </div>
                <div id="formAssetLainnya" style="display : none;">
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Jumlah Unit</label>
                      <div class="col-sm-10">
                          <input type="text" name="jumlah" class="form-controls" id="jumlah" placeholder="Jumlah Unit">
                          <input type="text" id="jml" value="" class="span-block" readonly>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Harga Asset</label>
                    <div class="col-sm-10">
                        <input readonly type="text" name="harga_barang" class="form-controls" id="harga_barang" placeholder="Harga Barang" required>
                        <input type="text" id="hrg_brng" value="Rp. " class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Penjualan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-controls" id="total" name="total" placeholder="Total Penjualan" required>
                        <input type="text" id="ttl" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Upload Bukti</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Pembayaran</label>
                    <div class="col-sm-10">
                        <select name="jenis_pembayaran" class="form-controls-select" onchange="show_value(this.value)" required>
                          <option value="">Pilih</option>
                          <option value="Cash">Cash</option>
                          <option value="Kredit">Kredit</option>
                          <option value="Cash dan Kredit">Cash dan Kredit</option>
                        </select>
                    </div>
                </div>
                <div id="formck" style="display : none;">
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
                            <input readonly type="text" id="sisa_kredit" name="sisa_kredit" class="form-controls" placeholder="Kredit">
                            <input type="text" id="ss_krdt" value="" class="span-block" readonly>
                        </div>
                    </div>
                </div>
                <div id="formdate" style="display : none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal_jatuh_tempo" class="form-controls" id="datepicker2" placeholder="Tanggal Penjualan">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-akumm">Simpan</button>
                    </div>
                </div>
              </div>
            <?php echo form_close();?>
            </div>
        </div>
    </section>
  </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type ="text/javascript">

$(".autoSum").keyup(function(){
  var harga_barang = Number($("#harga_barang").val());
  var cash = Number($("#cash").val());
  var asset = $("#pilih_jenis_asset").val();
  var total = Number($("#total").val());
  var jumlah = Number($("#jumlah").val());
  var fix_total = total * jumlah;
  if(jumlah > 0){
    var kredit = fix_total - cash;
  }else if(jumlah == 0){
    var kredit = total - cash;
  }

  $("#hrg_brng").attr("value","Rp. "+ formatRupiah($("#harga_barang").val()));
  $("#ttl").attr("value","Rp. "+formatRupiah($("#total").val()));
  $("#csh").attr("value","Rp. "+ formatRupiah($("#cash").val()));
  $("#sisa_kredit").attr("value", kredit);
  $("#ss_krdt").attr("value","Rp. "+formatRupiah($("#sisa_kredit").val()));
});

var a = document.getElementById("selectAssetTetapTanah");
var b = document.getElementById("selectAssetTetapTanahdanBangunan");
var c = document.getElementById("selectAssetLainnyaBaru");
var d = document.getElementById("selectAssetLainnyaBekas");
var e = document.getElementById("selectAssetKosong");
var f = document.getElementById("formAssetLainnya");

function jenis_asset(val){
  if (val=='') {
      a.style.display = "none";
      b.style.display = "none";
      c.style.display = "none";
      d.style.display = "none";
      e.style.display = "block";
      f.style.display = "block";
  }else if (val=='Tanah') {
      a.style.display = "block";
      b.style.display = "none";
      c.style.display = "none";
      d.style.display = "none";
      e.style.display = "none";
      f.style.display = "none";
  }else if (val == 'Tanah dan Bangunan' ){
      a.style.display = "none";
      b.style.display = "block";
      c.style.display = "none";
      d.style.display = "none";
      e.style.display = "none";
      f.style.display = "none";
  }else if (val == 'BARU' ){
      a.style.display = "none";
      b.style.display = "none";
      c.style.display = "block";
      d.style.display = "none";
      e.style.display = "none";
      f.style.display = "block";
  }else if (val == 'BEKAS' ){
      a.style.display = "none";
      b.style.display = "none";
      c.style.display = "none";
      d.style.display = "block";
      e.style.display = "none";
      f.style.display = "block";
  }
}
var y = document.getElementById("formdate");
var x = document.getElementById("formck");
function show_value(val){
  if (val=='Cash dan Kredit') {
      x.style.display = "block";
      y.style.display = "block";
  }else if(val=='Kredit'){
      x.style.display = "none";
      y.style.display = "block";
  }else{
      x.style.display = "none";
      y.style.display = "none";
  }
}

function changeValue(val){
  var asset =  $("#pilih_jenis_asset").val();
  if(asset == "Tanah"){
    <?php echo $jsArraytanah; ?>
    document.getElementById('harga_barang').value = Number(prdNameTanah[val].nilai_tanah) + Number(prdNameTanah[val].nilai_bangunan);
  }
  else if(asset == "Tanah dan Bangunan"){
    <?php echo $jsArraytnb; ?>
    document.getElementById('harga_barang').value = Number(prdNametnb[val].nilai_tanah) + Number(prdNametnb[val].nilai_bangunan);
  }
  else if(asset == "BARU"){
    <?php echo $jsArraybaru; ?>
    document.getElementById('harga_barang').value = Number(prdNameBaru[val].nilai_activa);
  }
  else if(asset == "BEKAS"){
    <?php echo $jsArraybekas; ?>
    document.getElementById('harga_barang').value = Number(prdNameBekas[val].nilai_activa);
  }
}

function formatRupiah(angka, prefix){
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