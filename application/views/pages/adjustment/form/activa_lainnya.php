<?php
  $id= "";
  $jenis_activa = "";
  $nama_activa = "";
  $nama_penjual = "";
  $kuantitas = "";
  $kuantitas2 = "";
  $nilai_activa = "";
  $nilai_activa_fix = "";
  $nilai_ekonomi = "";
  $tahun_beli = "";
  $tahun_berdiri = "";
  $akumulasi_penyusutan = "";
  $akumulasi_penyusutan2 = "";
  $harga_sisa = "";
  $harga_sisa2 = "";
  $bulan_sisa = "";
  $bulan_terpakai = "";
  $tahun_sisa = "";
  if ($main['op']=="edit") {
    foreach ($main['sql']->result() as $obj) {
      $op = "edit";
      $id = $obj->id;
      $jenis_activa = $obj->jenis_activa;
      $nama_activa = $obj->nama_activa;
      $nama_penjual = $obj->nama_penjual;
      $kuantitas = $obj->kuantitas;
      $kuantitas2 = number_format($obj->kuantitas,0,'','.');
      $nilai_activa = number_format($obj->nilai_activa,0, '', '.');
      $nilai_activa_fix = $obj->nilai_activa;
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
    }
  }
?>
<div class="row">
  <div class="col-sm-12">
    <!-- <div class="stepsix-page-left"> -->
      <section class="content-header">
        <h1>
          Activa Lainnya
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Activa Lainnya</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
      </section>

      <section class="content">
        <div class="box">
          <div class="box-header"></div>
          <div class="box-body form-horizontal">
          <?php echo form_open('adjustment/create_activa_lainnya/')?>
          <input type="hidden" name="op" value="<?php echo $main['op'];?>">
          <input type="hidden" name="id" value="<?php echo $id;?>">
          <div class="autoSum">
            <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Activa Lainnya</label>
                <div class="col-sm-10">
                    <select name="jenis_activa" class="form-controls-select" onchange="show_value(this.value)">
                    <option value="BARU" <?php if ($jenis_activa=='BARU') echo 'selected'?>>Baru</option>
                    <option value="BEKAS" <?php if ($jenis_activa=='BEKAS') echo 'selected'?>>Bekas</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Activa Lainnya</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controls" placeholder="Nama Activa Lainnya" name="nama_activa" value="<?php echo $nama_activa;?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pihak Penjual</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controls" name="nama_penjual" id="nama_penjual" placeholder="Nama Pihak Penjual" value="<?php echo $nama_penjual;?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kuantitas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controls" name="kuantitas" id="kuantitas" placeholder="Kuantitas" value="<?php echo $kuantitas;?>" required>
                    <input type="text" id="kts" value="<?php echo $kuantitas2;?>" class="span-block" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nilai Aktiva Lainnya</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controls" id="nilai_activa" placeholder="Nilai Activa Lainnya" name="nilai_activa" value="<?php echo $nilai_activa_fix;?>">
                    <input type="text" class="span-block" readonly value="Rp. <?php echo $nilai_activa;?>" id="nl_act">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nilai Ekonomi (dalam tahun)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controls" id="ne" name="nilai_ekonomi" placeholder="Nilai Ekonomi" value="<?php echo $nilai_ekonomi;?>">
                </div>
            </div>
            <!-- Tahun Rilis -->
            <?php
              if ($main['op']=='tambah') {
                ?>
                <div id="formck" style="display: none;">
                <?php
              }elseif($main['op']=='edit' AND $jenis_activa=='BEKAS'){
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
                <label class="col-sm-2 control-label">Tahun Rilis</label>
                <div class="col-sm-10">
                  <input type="text" name="tahun_berdiri" class="tahun_berdiri form-controls" id="datepicker" value="<?php echo $tahun_berdiri;?>" placeholder="Tahun Berdiri">
                  <input type="hidden" name="tahun_sekarang" id="tahun_sekarang" value="<?php echo date('Y-m-d');?>">
                </div>
              </div>
            </div>
            <!-- END Tahun Rilis -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Tahun Beli</label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker2" name="tahun_beli" class="tahun_beli form-controls" placeholder="Tahun Beli" value="<?php echo $tahun_beli;?>" required>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-10" align="center">
                <a id="hitung" class="btn btn-akumm">Hitung</a>
              </div>
            </div>
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
                    <input type="text" class="form-controls" readonly id="akumulasi_penyusutan" placeholder="Akumulasi Penyusutan" value="<?php echo $akumulasi_penyusutan;?>">
                    <input type="text" id="akm_pny" name="akumulasi_penyusutan" value="<?php echo $akumulasi_penyusutan2;?>" class="span-block" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Sisa (dalam tahun)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controls" id="harga_sisa" placeholder="Harga Sisa" value="<?php echo $harga_sisa;?>">
                    <input type="text" id="hrg_ss" name="harga_sisa" value="<?php echo $harga_sisa2;?>" class="span-block" readonly>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-10">
                <a href="<?php echo base_url();?>adjustment/activa_lainnya" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-akumm">Simpan</button>
              </div>
            </div>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script type ="text/javascript">
              var x = document.getElementById("formck");
              function show_value(val){
                if (val=='BEKAS') {
                    x.style.display = "block";
                }else if (val=='BARU'){
                    x.style.display = "none";
                }
              }

              $(document).ready(function(){
                $('#hitung').click(function(){
                  var nilai_ekonomi = $("#ne").val();
                  var nilai_activa = $("#nilai_activa").val();
                  var kuantitas = $("#kuantitas").val();
                  var tahun_berdiri = $(".tahun_berdiri").val();
                  var konvert_berdiri = tahun_berdiri.split("-");
                  var tahun_beli = $(".tahun_beli").val();
                  var konvert_beli = tahun_beli.split("-");
                  var tahun_sekarang = $("#tahun_sekarang").val();
                  var konvert_sekarang = tahun_sekarang.split("-");
                  if (tahun_beli==''||nilai_activa==''||nilai_ekonomi==''||kuantitas=='') {
                    alert('Data belum lengkap!');
                  }else if(tahun_berdiri!=''&&tahun_beli!=''&&nilai_activa!=''&&nilai_ekonomi!=''&&kuantitas!=''){
                    if (konvert_beli[2]>=15) {
                      hitung = 1+(konvert_beli[0]-konvert_berdiri[0])*12;
                      hitung += konvert_beli[1]-konvert_berdiri[1];
                    }else{
                      hitung = (konvert_beli[0]-konvert_berdiri[0])*12;
                      hitung += konvert_beli[1]-konvert_berdiri[1];
                    }

                    var bulan_sisa = (nilai_ekonomi * 12) - hitung;
                    var hitung_sisa = Math.floor((bulan_sisa / 12)) +" Tahun " + (bulan_sisa % 12) + " Bulan";
                    var penyusutan_perbulan = Math.round((nilai_activa*kuantitas)/(nilai_ekonomi*12));
                    var akumulasi_penyusutan = penyusutan_perbulan*hitung;
                    var harga_sisa = (nilai_activa*kuantitas) - akumulasi_penyusutan;

                    var reverse = akumulasi_penyusutan.toString().split('').reverse().join('');
                    konvert_akumulasi  = reverse.match(/\d{1,3}/g);
                    konvert_akumulasi  = konvert_akumulasi.join('.').split('').reverse().join('');

                    var reverse2 = harga_sisa.toString().split('').reverse().join('');
                    konvert_harga  = reverse2.match(/\d{1,3}/g);
                    konvert_harga  = konvert_harga.join('.').split('').reverse().join('');
                  }else if(tahun_beli!=''&&nilai_activa!=''&&nilai_ekonomi!=''&&kuantitas!=''){
                    if (konvert_sekarang[2]>=15) {
                      hitung = 1+(konvert_sekarang[0]-konvert_beli[0])*12;
                      hitung += konvert_sekarang[1]-konvert_beli[1];
                    }else{
                      hitung = (konvert_sekarang[0]-konvert_beli[0])*12;
                      hitung += konvert_sekarang[1]-konvert_beli[1];
                    }

                    var bulan_sisa = (nilai_ekonomi * 12) - hitung;
                    var hitung_sisa = Math.floor((bulan_sisa / 12)) +" Tahun " + (bulan_sisa % 12) + " Bulan";
                    var penyusutan_perbulan = Math.round((nilai_activa*kuantitas)/(nilai_ekonomi*12));
                    var akumulasi_penyusutan = penyusutan_perbulan*hitung;
                    var harga_sisa = (nilai_activa*kuantitas) - akumulasi_penyusutan;

                    var reverse = akumulasi_penyusutan.toString().split('').reverse().join('');
                    konvert_akumulasi  = reverse.match(/\d{1,3}/g);
                    konvert_akumulasi  = konvert_akumulasi.join('.').split('').reverse().join('');

                    var reverse2 = harga_sisa.toString().split('').reverse().join('');
                    konvert_harga  = reverse2.match(/\d{1,3}/g);
                    konvert_harga  = konvert_harga.join('.').split('').reverse().join('');
                  }else{
                    alert('coba lagi!');
                  }
                  $("#ts_fix").attr("value",hitung_sisa);
                  $("#akumulasi_penyusutan").attr("value",konvert_akumulasi);
                  $("#akm_pny").attr("value",akumulasi_penyusutan);
                  $("#harga_sisa").attr("value",konvert_harga);
                  $("#hrg_ss").attr("value",harga_sisa);
                  $("#bulan_sisa").attr("value",bulan_sisa);
                  $("#bulan_terpakai").attr("value",hitung);
                });
              });

              var kuantitas = document.getElementById('kuantitas');
              kuantitas.addEventListener('keyup', function(e){
                var kts = formatRupiah(this.value);
                $("#kts").attr("value",kts);
              });
              var nilai_activa = document.getElementById('nilai_activa');
              nilai_activa.addEventListener('keyup', function(e){
                var nl_act = formatRupiah(this.value);
                $("#nl_act").attr("value","Rp. "+nl_act);
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