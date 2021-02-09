<!-- Pemasukan Hibah -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Hibah
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Pemasukan</li>
          <li class="active">Hibah</li>
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
              <?php echo form_open_multipart('pemasukan/create_pemasukan_hibah/');?>
              <div class="autoSum">
                <?php
                    foreach ($main['sql2']->result() as $obj) {
                        $saldo_kas = $obj->saldo_kas;
                ?>
                    <input type="hidden" name="saldo_kas" value="<?php echo $saldo_kas;?>">
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pilih Hibah</label>
                    <div class="col-sm-10">
                        <select name="pilih_jenis_hibah" id="jenbah" class="form-controls-select" onchange="jenis_hibah(this.value)" required>
                          <option value="">Pilih Jenis Hibah</option>
                          <option value="Tanah">Tanah</option>
                          <option value="Tanah dan Bangunan">Tanah dan Bangunan</option>
                          <option value="Lainnya">Lainnya</option>
                          <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Pemberi Hibah</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_hibah" class="form-controls" placeholder="Nama Pemberi Hibah" required>
                    </div>
                </div>
                <div id="formJenisHibahLainnya" style="display: none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Pilih Jenis Hibah Lainnya</label>
                        <div class="col-sm-10">
                            <select name="pilih_jenis_hibah_lainnya" id="jenbah_lainnya" class="form-controls-select" onchange="jenis_hibah_lainnya(this.value)">
                                <option value="">Pilih Jenis Hibah Lainnya</option>
                                <option value="BARU">Baru</option>
                                <option value="BEKAS">Bekas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_barang" class="form-controls" id="inputName" placeholder="Nama Barang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nilai Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="nilai_barang" class="form-controls" id="nilai_barang" placeholder="Nilai Barang" required>
                        <input type="text" id="nl_brng" value="Rp. " class="span-block" readonly>
                    </div>
                </div>
                <div id="formJenisHibahBaru" style="display: none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nilai Ekonomi (dalam tahun)</label>
                        <div class="col-sm-10">
                            <input type="text" id="ne_lainnya" name="nilai_ekonomi_lainnya" class="form-controls" placeholder="Nilai Ekonomi">
                        </div>
                    </div>
                    <div id="formJenisHibahBekas" style="display: none;">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Tahun Rilis</label>
                            <div class="col-sm-10">
                                <input type="text" name="tahun_berdiri_lainnya" class="tahun_berdiri_lainnya form-controls" id="datepicker5" placeholder="Tahun Rilis">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tahun Beli</label>
                        <div class="col-sm-10">
                            <input type="text" name="tahun_beli_lainnya" class="tahun_beli_lainnya form-controls" id="datepicker4" placeholder="Tahun Beli">
                            <input type="hidden" name="tahun_sekarang_lainnya" id="tahun_sekarang_lainnya" value="<?php echo date('Y-m-d');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Jumlah Unit</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah" class="form-controls" id="jumlah" placeholder="Jumlah Unit">
                            <input type="text" id="jml" value="" class="span-block" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tahun Sisa</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="tahun_sisa_lainnya" id="ts_fix_lainnya" placeholder="Tahun Sisa" class="form-controls">
                            <input type="hidden" readonly name="bulan_sisa_lainnya" id="bulan_sisa_lainnya" placeholder="Bulan Sisa">
                            <input type="hidden" readonly name="bulan_terpakai_lainnya" id="bulan_terpakai_lainnya" placeholder="Bulan Terpakai">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Akumulasi Penyusutan</label>
                        <div class="col-sm-10">
                            <input type="text" readonly id="akumulasi_penyusutan_lainnya" class="form-controls" placeholder="Akumulasi Penyusutan" value="Rp. ">
                            <input type="hidden" id="akm_pny_lainnya" name="akumulasi_penyusutan_lainnya" class="span-block" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Harga Sisa (dalam tahun)</label>
                        <div class="col-sm-10">
                            <input type="text" readonly id="harga_sisa_lainnya" class="form-controls" placeholder="Harga Sisa" value="Rp. ">
                            <input type="hidden" id="hrg_ss_lainnya" name="harga_sisa_lainnya" value="0" class="span-block" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Penerimaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker" placeholder="Tanggal Penerimaan" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Penerimaan</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-controls" id="total" placeholder="Total Penerimaan" required>
                        <input type="hidden" name="total" id="ttl" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Upload Bukti Hibah</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-10">
                      <textarea name="keterangan" id="" cols="10" rows="5" class="form-controls" placeholder="Keterangan"></textarea>
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
  var p = document.getElementById("jenbah").value;
  if (p!="Lainnya") {
    // fungsi total penerimaan
    var total_nilai_barang = parseInt($("#nilai_barang").val());

    var total = total_nilai_barang;
    $("#ttl").attr("value",total);
    $("#total").attr("value","Rp. "+formatRupiah($("#ttl").val()));
  }else{
    var q = document.getElementById("jenbah_lainnya").value;

    // fungsi hibah lainnya
    var nilai_ekonomi_lainnya = $("#ne_lainnya").val();
    var nilai_activa = $("#nilai_barang").val();
    var jumlah_lainnya = $("#jumlah").val();
    var tahun_berdiri_lainnya = $(".tahun_berdiri_lainnya").val();
    var konvert_berdiri_lainnya = tahun_berdiri_lainnya.split("-");
    var tahun_beli_lainnya = $(".tahun_beli_lainnya").val();
    var konvert_beli_lainnya = tahun_beli_lainnya.split("-");
    var tahun_sekarang_lainnya = $("#tahun_sekarang_lainnya").val();
    var konvert_sekarang_lainnya = tahun_sekarang_lainnya.split("-");

    if (q=="BARU") {
      // hitung depresiasi baru
      if (konvert_sekarang_lainnya[2]>=15) {
          hitung_lainnya = 1+(konvert_sekarang_lainnya[0]-konvert_beli_lainnya[0])*12;
          hitung_lainnya += konvert_sekarang_lainnya[1]-konvert_beli_lainnya[1];
      }else{
          hitung_lainnya = (konvert_sekarang_lainnya[0]-konvert_beli_lainnya[0])*12;
          hitung_lainnya += konvert_sekarang_lainnya[1]-konvert_beli_lainnya[1];
      }

      var bulan_sisa_lainnya = (nilai_ekonomi_lainnya * 12) - hitung_lainnya;
      var hitung_sisa_lainnya = Math.floor((bulan_sisa_lainnya / 12)) +" Tahun " + (bulan_sisa_lainnya % 12) + " Bulan";
      var penyusutan_perbulan_lainnya = Math.round((nilai_activa*jumlah_lainnya)/(nilai_ekonomi_lainnya*12));
      var akumulasi_penyusutan_lainnya = penyusutan_perbulan_lainnya*hitung_lainnya;
      var harga_sisa_lainnya = (nilai_activa*jumlah_lainnya) - akumulasi_penyusutan_lainnya;

      var reverse_lainnya = akumulasi_penyusutan_lainnya.toString().split('').reverse().join('');
      konvert_akumulasi_lainnya  = reverse_lainnya.match(/\d{1,3}/g);
      konvert_akumulasi_lainnya  = konvert_akumulasi_lainnya.join('.').split('').reverse().join('');

      var reverse2_lainnya = harga_sisa_lainnya.toString().split('').reverse().join('');
      konvert_harga_lainnya  = reverse2_lainnya.match(/\d{1,3}/g);
      konvert_harga_lainnya  = konvert_harga_lainnya.join('.').split('').reverse().join('');
    }else{
      // hitung depresiasi bekas
      if (konvert_sekarang_lainnya[2]>=15) {
          hitung_lainnya = 1+(konvert_sekarang_lainnya[0]-konvert_berdiri_lainnya[0])*12;
          hitung_lainnya += konvert_sekarang_lainnya[1]-konvert_berdiri_lainnya[1];
      }else{
          hitung_lainnya = (konvert_sekarang_lainnya[0]-konvert_berdiri_lainnya[0])*12;
          hitung_lainnya += konvert_sekarang_lainnya[1]-konvert_berdiri_lainnya[1];
      }

      var bulan_sisa_lainnya = (nilai_ekonomi_lainnya * 12) - hitung_lainnya;
      var hitung_sisa_lainnya = Math.floor((bulan_sisa_lainnya / 12)) +" Tahun " + (bulan_sisa_lainnya % 12) + " Bulan";
      var penyusutan_perbulan_lainnya = Math.round((nilai_activa*jumlah_lainnya)/(nilai_ekonomi_lainnya*12));
      var akumulasi_penyusutan_lainnya = penyusutan_perbulan_lainnya*hitung_lainnya;
      var harga_sisa_lainnya = (nilai_activa*jumlah_lainnya) - akumulasi_penyusutan_lainnya;

      var reverse_lainnya = akumulasi_penyusutan_lainnya.toString().split('').reverse().join('');
      konvert_akumulasi_lainnya  = reverse_lainnya.match(/\d{1,3}/g);
      konvert_akumulasi_lainnya  = konvert_akumulasi_lainnya.join('.').split('').reverse().join('');

      var reverse2_lainnya = harga_sisa_lainnya.toString().split('').reverse().join('');
      konvert_harga_lainnya  = reverse2_lainnya.match(/\d{1,3}/g);
      konvert_harga_lainnya  = konvert_harga_lainnya.join('.').split('').reverse().join('');
    }
    $("#ts_fix_lainnya").attr("value",hitung_sisa_lainnya);
    $("#akumulasi_penyusutan_lainnya").attr("value","Rp. "+konvert_akumulasi_lainnya);
    $("#akm_pny_lainnya").attr("value",akumulasi_penyusutan_lainnya);
    $("#harga_sisa_lainnya").attr("value","Rp. "+konvert_harga_lainnya);
    $("#hrg_ss_lainnya").attr("value",harga_sisa_lainnya);
    $("#bulan_sisa_lainnya").attr("value",bulan_sisa_lainnya);
    $("#bulan_terpakai_lainnya").attr("value",hitung_lainnya);

    // fungsi total pembelian
    var total_lainnya = parseInt($("#hrg_ss_lainnya").val());

    var total = total_lainnya;
    $("#ttl").attr("value",total);
    $("#total").attr("value","Rp. "+formatRupiah($("#ttl").val()));
  }
});
// input nilai barang
var nilai_barang = document.getElementById('nilai_barang');
nilai_barang.addEventListener('keyup', function(e){
    var nl_brng = formatRupiah(this.value);
    $("#nl_brng").attr("value","Rp. "+nl_brng);
});

var a = document.getElementById("formJenisHibahLainnya");
var b = document.getElementById("formJenisHibahBaru");
var c = document.getElementById("formJenisHibahBekas");
function jenis_hibah(val){
  if (val=='') {
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
  }else if (val=='Tanah dan Bangunan') {
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
  }else if (val=='Tanah'){
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
  }else if (val=='Lainnya'){
    a.style.display = "block";
  }
}
// form jenis asset lainnya
function jenis_hibah_lainnya(val){
  if (val=='') {
      b.style.display = "none";
      c.style.display = "none";
  }else if (val=='BARU') {
      b.style.display = "block";
      c.style.display = "none";
  }else if (val=='BEKAS') {
      b.style.display = "block";
      c.style.display = "block";
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