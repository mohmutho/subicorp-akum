<!-- Pengeluaran Pembelian Asset -->
<div class="row">
  <div class="col-sm-12">
    <section class="content-header">
        <h1>
          Pembelian Asset
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Pengeluaran</li>
          <li class="active">Pembelian Asset</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body form-horizontal">
            <?php echo form_open_multipart('pengeluaran/create_pengeluaran_pembelian_asset/');?>
            <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pilih Jenis Asset</label>
                    <div class="col-sm-10">
                        <select name="pilih_jenis_asset" id="jenset" class="form-controls-select" onchange="jenis_asset(this.value)" required>
                          <option value="">Pilih Jenis Asset</option>
                          <option value="Tanah">Tanah</option>
                          <option value="Tanah dan Bangunan">Tanah dan Bangunan</option>
                          <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Asset</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_asset" class="form-controls" placeholder="Nama Asset" required>
                    </div>
                </div>
                <div id="formJenisAssetLainnya" style="display: none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Pilih Jenis Asset Lainnya</label>
                        <div class="col-sm-10">
                            <select name="pilih_jenis_asset_lainnya" id="jenset_lainnya" class="form-controls-select" onchange="jenis_asset_lainnya(this.value)">
                                <option value="">Pilih Jenis Asset Lainnya</option>
                                <option value="BARU">Baru</option>
                                <option value="BEKAS">Bekas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="formJenisAssetBaru" style="display: none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama Pihak Penjual</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_penjual" id="nama_penjual" class="form-controls" placeholder="Nama Pihak Penjual">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nilai Aktiva</label>
                        <div class="col-sm-10">
                            <input type="text" id="nilai_activa" class="form-controls" placeholder="Nilai Aktiva" name="nilai_activa">
                            <input type="text" class="span-block" readonly value="Rp. " id="nl_act">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nilai Ekonomi (dalam tahun)</label>
                        <div class="col-sm-10">
                            <input type="text" id="ne_lainnya" name="nilai_ekonomi_lainnya" class="form-controls" placeholder="Nilai Ekonomi">
                        </div>
                    </div>
                    <div id="formJenisAssetBekas" style="display: none;">
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
                <div id="formJenisAssetTanah" style="display: none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nilai Tanah</label>
                        <div class="col-sm-10">
                            <input type="text" name="nilai_tanah" id="nilai_tanah" class="form-controls" placeholder="Nilai Tanah">
                            <input type="text" id="nl_tnh" value="Rp. " class="span-block" readonly>
                        </div>
                    </div>
                    <div id="formJenisAssetTanahBangunan" style="display: none;">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Nilai Bangunan</label>
                            <div class="col-sm-10">
                                <input type="text" id="nilai_bangunan" class="form-controls" name="nilai_bangunan" placeholder="Nilai Bangunan">
                                <input type="text" id="nl_bangunan" value="Rp. " class="span-block" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Tahun Berdiri</label>
                            <div class="col-sm-10">
                                <input type="text" name="tahun_berdiri" class="tahun_berdiri form-controls" id="datepicker" placeholder="Tahun Berdiri">
                                <input type="hidden" name="tahun_sekarang" id="tahun_sekarang" value="<?php echo date('Y-m-d');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Jenis Bangunan</label>
                            <div class="col-sm-10">
                                <select name="jenis_bangunan" class="form-controls-select" onchange="jenis_b(this.value)">
                                    <option value="">Pilih Jenis Bangunan</option>
                                    <option value="NON PERMANEN">Non Permanen</option>
                                    <option value="PERMANEN">Permanen</option>
                                </select>
                            </div>
                        </div>
                        <div id="formJBNon" style="display: none;">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Nilai Ekonomi (dalam tahun)</label>
                                <div class="col-sm-10">
                                    <input id="ne" class="form-controls" placeholder="Masukan tahun (10 tahun)">
                                </div>
                            </div>
                        </div>
                        <div id="formJBPer" style="display: none;">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Nilai Ekonomi (dalam tahun)</label>
                                <div class="col-sm-10">
                                    <input type="text" id="nek" class="form-controls" placeholder="Masukan tahun (20 - 30 tahun)">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="nilai_ekonomi" id="ne_fix" placeholder="Nilai Ekonomi">
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tahun Beli</label>
                        <div class="col-sm-10">
                            <input type="text" name="tahun_beli" class="tahun_beli form-controls" id="datepicker2" placeholder="Tahun Beli">
                        </div>
                    </div>
                    <div id="formJenisAssetTanahBangunan2" style="display: none;">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Tahun Sisa</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name="tahun_sisa" id="ts_fix" placeholder="Tahun Sisa" class="form-controls">
                                <input type="hidden" readonly name="bulan_sisa" id="bulan_sisa" placeholder="Bulan Sisa">
                                <input type="hidden" readonly name="bulan_terpakai" id="bulan_terpakai" placeholder="Bulan Terpakai">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Akumulasi Penyusutan</label>
                            <div class="col-sm-10">
                                <input type="text" readonly id="akumulasi_penyusutan" class="form-controls" placeholder="Akumulasi Penyusutan" value="Rp. ">
                                <input type="hidden" id="akm_pny" name="akumulasi_penyusutan" class="span-block" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Harga Sisa (dalam tahun)</label>
                            <div class="col-sm-10">
                                <input type="text" readonly id="harga_sisa" class="form-controls" placeholder="Harga Sisa" value="Rp. ">
                                <input type="hidden" id="hrg_ss" name="harga_sisa" value="0" class="span-block" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" cols="10" rows="5" placeholder="Alamat" class="form-controls"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">No. Sertifikat Tanah</label>
                        <div class="col-sm-10">
                            <input type="number" name="no_sertifikat" placeholder="No. Sertifikat Tanah" class="form-controls">
                        </div>
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
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Pembelian</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker3" placeholder="Tanggal Pembelian" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Pembelian</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-controls" id="total" placeholder="Total Pembelian" required>
                        <input type="hidden" name="total" id="ttl" value="" class="span-block" readonly>
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
                <div id="formdate" style="display : none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal_jatuh_tempo" class="form-controls" id="datepicker4" value="2021-01-01" placeholder="Tanggal Jatuh Tempo">
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
// form jenis asset
var j = document.getElementById("formJenisAssetTanah");
var k = document.getElementById("formJenisAssetTanahBangunan");
var l = document.getElementById("formJenisAssetTanahBangunan2");
var m = document.getElementById("formJenisAssetLainnya");
var n = document.getElementById("formJenisAssetBaru");
var o = document.getElementById("formJenisAssetBekas");
function jenis_asset(val){
    if (val=='') {
        j.style.display = "none";
        k.style.display = "none";
        l.style.display = "none";
        m.style.display = "none";
        n.style.display = "none";
        o.style.display = "none";
        $('#ttl').val("");
        $('#total').val("");
    }else if (val=='Tanah dan Bangunan') {
        j.style.display = "block";
        k.style.display = "block";
        l.style.display = "block";
        m.style.display = "none";
        n.style.display = "none";
        o.style.display = "none";
    }else if (val=='Tanah'){
        j.style.display = "block";
        k.style.display = "none";
        l.style.display = "none";
        m.style.display = "none";
        n.style.display = "none";
        o.style.display = "none";
    }else if (val=='Lainnya'){
        j.style.display = "none";
        k.style.display = "none";
        l.style.display = "none";
        m.style.display = "block";
    }
}
// form jenis asset lainnya
function jenis_asset_lainnya(val){
    if (val=='') {
        n.style.display = "none";
        o.style.display = "none";
    }else if (val=='BARU') {
        n.style.display = "block";
        o.style.display = "none";
    }else if (val=='BEKAS') {
        n.style.display = "block";
        o.style.display = "block";
    }
}
// form jenis bangunan
var jb = document.getElementById("formJBNon");
var jb2 = document.getElementById("formJBPer");
function jenis_b(val){
    if (val=='PERMANEN') {
        jb.style.display = "none";
        jb2.style.display = "block";
    }else if(val=='NON PERMANEN'){
        jb.style.display = "block";
        jb2.style.display = "none";
    }
}

$(".autoSum").keyup(function(){
    var p = document.getElementById("jenset").value;
    if (p=="Tanah") {
        // fungsi total pembelian
        var total_nilai_tanah = parseInt($("#nilai_tanah").val());
        var total = total_nilai_tanah;
        $("#ttl").attr("value",total);
        $("#total").attr("value","Rp. "+formatRupiah($("#ttl").val()));

        // fungsi jenis pembayaran
        var cash = parseInt($("#cash").val());
        var csh = formatRupiah($("#cash").val());
        $("#csh").attr("value","Rp. "+csh);
        var kredit = total - cash;
        $("#ss_krdt").attr("value",kredit);
        $("#sisa_kredit").attr("value","Rp. "+formatRupiah($("#ss_krdt").val()));
    }else if(p=="Tanah dan Bangunan"){
        // fungsi perhitungan depresiasi tanah dan bangunan
        var nilai_ekonomi = $("#ne_fix").val();
        var nilai_bangunan = $("#nilai_bangunan").val();
        var tahun_berdiri = $(".tahun_berdiri").val();
        var konvert_berdiri = tahun_berdiri.split("-");
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

        // fungsi total pembelian
        var total_nilai_tanah = parseInt($("#nilai_tanah").val());
        var total_nilai_bangunan = parseInt($("#hrg_ss").val());

        var total = total_nilai_tanah + total_nilai_bangunan;
        $("#ttl").attr("value",total);
        $("#total").attr("value","Rp. "+formatRupiah($("#ttl").val()));

        // fungsi jenis pembayaran
        var cash = parseInt($("#cash").val());
        var csh = formatRupiah($("#cash").val());
        $("#csh").attr("value","Rp. "+csh);
        var kredit = total - cash;
        $("#ss_krdt").attr("value",kredit);
        $("#sisa_kredit").attr("value","Rp. "+formatRupiah($("#ss_krdt").val()));
    }else{
        var q = document.getElementById("jenset_lainnya").value;

        // fungsi asset lainnya
        var nilai_ekonomi_lainnya = $("#ne_lainnya").val();
        var nilai_activa = $("#nilai_activa").val();
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

        // fungsi jenis pembayaran
        var cash = parseInt($("#cash").val());
        var csh = formatRupiah($("#cash").val());
        $("#csh").attr("value","Rp. "+csh);
        var kredit = total - cash;
        $("#ss_krdt").attr("value",kredit);
        $("#sisa_kredit").attr("value","Rp. "+formatRupiah($("#ss_krdt").val()));
    }
});

// input nilai tanah
var nilai_tanah = document.getElementById('nilai_tanah');
nilai_tanah.addEventListener('keyup', function(e){
    var nl_tnh = formatRupiah(this.value);
    $("#nl_tnh").attr("value","Rp. "+nl_tnh);
});
// input nilai bangunan
var nilai_bangunan = document.getElementById('nilai_bangunan');
nilai_bangunan.addEventListener('keyup', function(e){
    var nl_bangunan = formatRupiah(this.value);
    $("#nl_bangunan").attr("value","Rp. "+nl_bangunan);
});
// input nilai ekonomi non
var ne = document.getElementById('ne');
    ne.addEventListener('keyup', function(e){
    $("#ne_fix").attr("value",this.value);
});
// input nilai ekonomi per
var nek = document.getElementById('nek');
    nek.addEventListener('keyup', function(e){
    $("#ne_fix").attr("value",this.value);
});
// input nilai aktiva
var nilai_activa = document.getElementById('nilai_activa');
nilai_activa.addEventListener('keyup', function(e){
    var nl_act = formatRupiah(this.value);
    $("#nl_act").attr("value","Rp. "+nl_act);
});
// input jumlah unit
var jml = document.getElementById('jumlah');
jml.addEventListener('keyup', function(e){
    var jml_unit = formatRupiah(this.value);
    $("#jml").attr("value",jml_unit);
});

// form jenis pembayaran
var x = document.getElementById("formck");
var y = document.getElementById("formdate");
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

// fungsi format rupiah
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