<?php
  $id= "";
  $jenis_activa = "";
  $nama_activa = "";
  $nilai_tanah = "";
  $nilai_tanah2 = "";
  $nilai_bangunan = "";
  $nilai_bangunan_fix = "";
  $jenis_bangunan = "";
  $nilai_ekonomi = "";
  $tahun_beli = "";
  $tahun_berdiri = "";
  $akumulasi_penyusutan = "";
  $akumulasi_penyusutan2 = "";
  $harga_sisa = "";
  $harga_sisa2 = "";
  $alamat = "";
  $bulan_sisa = "";
  $bulan_terpakai = "";
  $tahun_sisa = "";
  $no_sertifikat = "";
  if ($main['op']=="edit") {
    foreach ($main['sql']->result() as $obj) {
      $op = "edit";
      $id = $obj->id;
      $jenis_activa = $obj->jenis_activa;
      $nama_activa = $obj->nama_activa;
      $nilai_tanah = $obj->nilai_tanah;
      $nilai_tanah2 = number_format($obj->nilai_tanah,0,'','.');
      $nilai_bangunan = number_format($obj->nilai_bangunan,0, '', '.');
      $nilai_bangunan_fix = $obj->nilai_bangunan;
      $jenis_bangunan = $obj->jenis_bangunan;
      $nilai_ekonomi = $obj->nilai_ekonomi;
      $tahun_beli = $obj->tahun_beli;
      $tahun_berdiri = $obj->tahun_berdiri;
      $bulan_sisa = $obj->bulan_sisa;
      $bulan_terpakai = $obj->bulan_terpakai;
      $tahun_sisa = floor($obj->bulan_sisa/12)." Tahun ". ($obj->bulan_sisa%12). " Bulan";
      $akumulasi_penyusutan = number_format($obj->akumulasi_penyusutan,0, '', '.');
      $akumulasi_penyusutan2 = $obj->akumulasi_penyusutan;
      $harga_sisa = number_format($obj->harga_sisa,0, '', '.');
      $harga_sisa2 = $obj->harga_sisa;
      $alamat = $obj->alamat;
      $no_sertifikat = $obj->no_sertifikat;
    }
  }
?>
<div class="row">
  <div class="col-sm-12">
    <!-- <div class="stepsix-page-left"> -->
      <section class="content-header">
        <h1>
          Activa Tetap
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Activa Tetap</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
      </section>

      <section class="content">
        <div class="box">
          <div class="box-header"></div>
          <div class="box-body form-horizontal">
          <?php echo form_open('adjustment/create_activa_tetap/')?>
          <input type="hidden" name="op" value="<?php echo $main['op'];?>">
          <input type="hidden" name="id" value="<?php echo $id;?>">
          <div class="autoSum">
            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Activa Tetap</label>
              <div class="col-sm-10">
                <select name="jenis_activa" class="form-controls-select" onchange="show_value(this.value)">
                  <option value="Tanah" <?php if ($jenis_activa=='Tanah') echo 'selected'?>>Tanah</option>
                  <option value="Tanah dan Bangunan" <?php if ($jenis_activa=='Tanah dan Bangunan') echo 'selected'?>>Tanah dan Bangunan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Activa Tetap</label>
              <div class="col-sm-10">
                <input type="text" class="form-controls" placeholder="Nama Activa Tetap" name="nama_activa" value="<?php echo $nama_activa;?>" required>
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nilai Tanah</label>
                <div class="col-sm-10">
                  <input type="text" name="nilai_tanah" class="form-controls" id="nilai_tanah" placeholder="Nilai Tanah" value="<?php echo $nilai_tanah;?>" required>
                  <input type="text" id="nl_tnh" value="Rp. <?php echo $nilai_tanah2;?>" class="span-block" readonly>
                </div>
              </div>
            </div>
            <?php
              if ($main['op']=='tambah') {
                ?>
                <div id="formck" style="display: none;">
                <?php
              }elseif($main['op']=='edit' AND $jenis_activa=='Tanah dan Bangunan'){
                ?>
                <div id="formck">
                <?php
              }else{
                ?>
                <div id="formck" style="display: none;">
                <?php
              }
            ?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nilai Bangunan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-controls" id="nilai_bangunan" name="nilai_bangunan" placeholder="Nilai Bangunan" value="<?php echo $nilai_bangunan_fix;?>">
                  <input type="text" id="nl_bangunan" value="Rp. <?php echo $nilai_bangunan;?>" class="span-block" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Bangunan</label>
                <div class="col-sm-10">
                  <select name="jenis_bangunan" class="form-controls-select" onchange="show_value2(this.value)">
                    <option value="">Pilih Jenis Bangunan</option>
                    <option value="NON PERMANEN" <?php if ($jenis_bangunan=='NON PERMANEN') echo 'selected'?>>Non Permanen</option>
                    <option value="PERMANEN" <?php if ($jenis_bangunan=='PERMANEN') echo 'selected'?>>Permanen</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                  <?php
                    if ($main['op']=='tambah') {
                      ?>
                      <div id="formckbangunan" style="display: none">
                      <?php
                    }elseif($main['op']=='edit' AND $jenis_activa=='Tanah dan Bangunan' AND $jenis_bangunan=='NON PERMANEN'){
                      ?>
                      <div id="formckbangunan">
                      <?php
                    }else{
                      ?>
                      <div id="formckbangunan" style="display: none;">
                      <?php
                    }
                  ?>
                    <label class="col-sm-2 control-label">Nilai Ekonomi (dalam tahun)</label>
                    <div class="col-sm-10">
                      <input class="form-controls" id="ne" placeholder="Masukan tahun (10 tahun)" value="<?php echo $nilai_ekonomi;?>">
                    </div>
                  </div>
                  <?php
                    if ($main['op']=='tambah') {
                      ?>
                      <div id="formckbangunan2" style="display: none">
                      <?php
                    }elseif($main['op']=='edit' AND $jenis_activa=='Tanah dan Bangunan' AND $jenis_bangunan=='PERMANEN'){
                      ?>
                      <div id="formckbangunan2">
                      <?php
                    }else{
                      ?>
                      <div id="formckbangunan2" style="display: none;">
                      <?php
                    }
                  ?>
                    <label class="col-sm-2 control-label">Nilai Ekonomi (dalam tahun)</label>
                    <div class="col-sm-10">
                      <input class="form-controls" type="text" id="nek" placeholder="Masukan tahun (20 - 30 tahun)" value="<?php echo $nilai_ekonomi;?>">
                    </div>
                  </div>
                  <input type="hidden" name="nilai_ekonomi" id="ne_fix" placeholder="Nilai Ekonomi" value="<?php echo $nilai_ekonomi;?>">
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tahun Berdiri</label>
                <div class="col-sm-10">
                  <input type="text" name="tahun_berdiri" class="tahun_berdiri form-controls" id="datepicker" placeholder="Tahun Berdiri" value="<?php echo $tahun_berdiri;?>">
                  <input type="hidden" name="tahun_sekarang" id="tahun_sekarang" value="<?php echo date('Y-m-d');?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tahun Beli</label>
              <div class="col-sm-10">
                <input class="form-controls" type="text" name="tahun_beli" class="tahun_beli" id="datepicker2" placeholder="Tahun Beli" value="<?php echo $tahun_beli;?>" required>
              </div>
            </div>
            <?php
              if ($main['op']=='tambah') {
                ?>
                <div id="formckbutton" style="display: none;">
                <?php
              }elseif($main['op']=='edit' AND $jenis_activa=='Tanah dan Bangunan' AND $jenis_bangunan=='PERMANEN' OR $jenis_bangunan=='NON PERMANEN'){
                ?>
                <div id="formckbutton">
                <?php
              }else{
                ?>
                <div id="formckbutton" style="display: none;">
                <?php
              }
            ?>
              <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-10" align="center">
                  <a id="hitung" class="btn btn-akumm">Hitung</a>
                </div>
              </div>
            </div>
            <?php
              if ($main['op']=='tambah') {
                ?>
                <div id="formckhitung" style="display: none;">
                <?php
              }elseif($main['op']=='edit' AND $jenis_activa=='Tanah dan Bangunan' AND $jenis_bangunan=='PERMANEN' OR $jenis_bangunan=='NON PERMANEN'){
                ?>
                <div id="formckhitung">
                <?php
              }else{
                ?>
                <div id="formckhitung" style="display: none;">
                <?php
              }
            ?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tahun Sisa</label>
                <div class="col-sm-10">
                  <input type="text" class="form-controls" readonly name="tahun_sisa" id="ts_fix" placeholder="Tahun Sisa" value="<?php echo $tahun_sisa;?>">
                  <input type="hidden" readonly name="bulan_sisa" id="bulan_sisa" placeholder="Bulan Sisa" value="<?php echo $bulan_sisa;?>">
                  <input type="hidden" readonly name="bulan_terpakai" id="bulan_terpakai" placeholder="Bulan Terpakai" value="<?php echo $bulan_terpakai;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Akumulasi Penyusutan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controls" readonly id="akumulasi_penyusutan" placeholder="Akumulasi Penyusutan" value="Rp. <?php echo $akumulasi_penyusutan;?>">
                    <input type="hidden" id="akm_pny" name="akumulasi_penyusutan" value="<?php echo $akumulasi_penyusutan2;?>" class="span-block" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Sisa (dalam tahun)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-controls" readonly id="harga_sisa" placeholder="Harga Sisa" value="Rp. <?php echo $harga_sisa;?>">
                  <input type="hidden" id="hrg_ss" name="harga_sisa" value="<?php echo $harga_sisa2;?>" class="span-block" readonly>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea name="alamat" class="form-controls" cols="10" rows="5" placeholder="Alamat" required><?php echo $alamat;?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">No. Sertifikat Tanah</label>
              <div class="col-sm-10">
                <input type="number" class="form-controls" name="no_sertifikat" placeholder="No. Sertifikat Tanah" value="<?php echo $no_sertifikat;?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-10">
                <a href="<?php echo base_url();?>adjustment/activa_tetap" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-akumm">Simpan</button>
              </div>
            </div>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script type ="text/javascript">
              var x = document.getElementById("formck");
              var y = document.getElementById("formckhitung");
              var z = document.getElementById("formckbutton");
              function show_value(val){
                if (val=='Tanah dan Bangunan') {
                    x.style.display = "block";
                    y.style.display = "block";
                    z.style.display = "block";
                }else if (val=='Tanah'){
                    x.style.display = "none";
                    y.style.display = "none";
                    z.style.display = "none";
                }
              }

              var jenis_bangunan = document.getElementById("formckbangunan");
              var jenis_bangunan2 = document.getElementById("formckbangunan2");
              function show_value2(val){
                if (val=='PERMANEN') {
                    jenis_bangunan.style.display = "none";
                    jenis_bangunan2.style.display = "block";
                }else if(val=='NON PERMANEN'){
                    jenis_bangunan.style.display = "block";
                    jenis_bangunan2.style.display = "none";
                }
              }

              $(document).ready(function(){
                $('#hitung').click(function(){
                  var nilai_ekonomi = $("#ne_fix").val();
                  var nilai_bangunan = $("#nilai_bangunan").val();
                  var tahun_berdiri = $(".tahun_berdiri").val();
                  var konvert_berdiri = tahun_berdiri.split("-");
                  if (tahun_berdiri==''||nilai_bangunan==''||nilai_ekonomi=='') {
                    alert('Data belum lengkap!');
                  }else{
                    var tahun_sekarang = $("#tahun_sekarang").val();
                    var konvert_sekarang = tahun_sekarang.split("-");

                    if (konvert_sekarang[2]>=15) {
                      hitung = 1+(konvert_sekarang[0]-konvert_berdiri[0])*12;
                      hitung += konvert_sekarang[1]-konvert_berdiri[1];
                    }else{
                      hitung = (konvert_sekarang[0]-konvert_berdiri[0])*12;
                      hitung += konvert_sekarang[1]-konvert_berdiri[1];
                    }

                    var bulan_sisa = (nilai_ekonomi * 12) - hitung;
                    var hitung_sisa = Math.floor((bulan_sisa / 12)) +" Tahun " + (bulan_sisa % 12) + " Bulan";
                    var penyusutan_perbulan = Math.round(nilai_bangunan/(nilai_ekonomi*12));
                    var akumulasi_penyusutan = penyusutan_perbulan*hitung;
                    var harga_sisa = nilai_bangunan - akumulasi_penyusutan;

                    var reverse = akumulasi_penyusutan.toString().split('').reverse().join('');
                    konvert_akumulasi  = reverse.match(/\d{1,3}/g);
                    konvert_akumulasi  = konvert_akumulasi.join('.').split('').reverse().join('');

                    var reverse2 = harga_sisa.toString().split('').reverse().join('');
                    konvert_harga  = reverse2.match(/\d{1,3}/g);
                    konvert_harga  = konvert_harga.join('.').split('').reverse().join('');

                    $("#ts_fix").attr("value",hitung_sisa);
                    $("#akumulasi_penyusutan").attr("value","Rp. "+konvert_akumulasi);
                    $("#akm_pny").attr("value",akumulasi_penyusutan);
                    $("#harga_sisa").attr("value","Rp. "+konvert_harga);
                    $("#hrg_ss").attr("value",harga_sisa);
                    $("#bulan_sisa").attr("value",bulan_sisa);
                    $("#bulan_terpakai").attr("value",hitung);
                  }
                });
              });

              var nilai_tanah = document.getElementById('nilai_tanah');
              nilai_tanah.addEventListener('keyup', function(e){
                var nl_tnh = formatRupiah(this.value);
                $("#nl_tnh").attr("value","Rp. "+nl_tnh);
              });
              var nilai_bangunan = document.getElementById('nilai_bangunan');
              nilai_bangunan.addEventListener('keyup', function(e){
                var nl_bangunan = formatRupiah(this.value);
                $("#nl_bangunan").attr("value","Rp. "+nl_bangunan);
              });
              var ne = document.getElementById('ne');
              ne.addEventListener('keyup', function(e){
                $("#ne_fix").attr("value",this.value);
              });
              var nek = document.getElementById('nek');
              nek.addEventListener('keyup', function(e){
                $("#ne_fix").attr("value",this.value);
              });
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
          </div>
          <?php echo form_close()?>
          </div>
        </div>
      </section>
    <!-- </div> -->
  </div>
</div>