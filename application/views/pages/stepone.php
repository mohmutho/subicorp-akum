<?php
$saldo_bank = '';
$saldo_kas = '';
$surat_berharga = '';
foreach ($sql as $key => $value) {
  $saldo_kas = $value->saldo_kas;
  $saldo_bank = $value->saldo_bank;
  $surat_berharga = $value->surat_berharga;
}
function rupiah($angka){
	$hasil_rupiah = number_format($angka,0,'','.');
	return $hasil_rupiah;
}
?>
<div class="row">
  <div class="col-sm-5">
    <div class="stepone-page-left">
      <section class="content-header">
        <h1>
          STEP 1
        </h1>
      </section>

      <section class="content">
        <p>Masukan Saldo KAS, Saldo Bank dan Nilai surat berharga Anda saat ini : </p>
      </section>
    </div>
  </div>
  <div class="col-sm-7">
    <div class="stepone-page-right">
    <?php echo form_open_multipart('stepone/create/');?>
      <div class="row">
        <div class="col-sm-11">
          <label>Masukan saldo kas</label>
          <input type="text" name="saldo_kas" id="saldo_kas" placeholder="Saldo Kas" style="background: #FFF5AB;" value="<?= $saldo_kas;?>" required>
          <input type="text" id="sld_ks" value="Rp. <?php if($saldo_kas==''){ echo 0;}else{ echo rupiah($saldo_kas); } ?>" class="span-block" readonly>
        </div>
      </div><br>
      <div class="row">
        <div class="col-sm-11">
          <label>Masukan saldo bank</label>
          <input type="text" name="saldo_bank" id="saldo_bank" placeholder="Saldo Bank" style="background: #FFF5AB;" value="<?= $saldo_bank;?>" required>
          <input type="text" id="sld_bk" value="Rp. <?php if($saldo_bank==''){ echo 0;}else{ echo rupiah($saldo_bank); } ?>" class="span-block" readonly>
        </div>
      </div><br>
      <div class="row">
        <div class="col-sm-11">
          <label>Masukan nilai surat berharga</label>
          <input type="text" name="surat_berharga" id="surat_berharga" placeholder="Surat Berharga" style="background: #FFF5AB;" value="<?= $surat_berharga;?>" required>
          <input type="text" id="srt_hrg" value="Rp. <?php if($surat_berharga==''){ echo 0;}else{ echo rupiah($surat_berharga); } ?>" class="span-block" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-11">
          <div class="align-right">
            <a href="<?php echo base_url();?>intro" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
            <button type="submit" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></button>
          </div>
        </div>
      </div>
    <?php echo form_close();?>
    </div>
  </div>
</div>
<script type="text/javascript">

  /* Tanpa Rupiah */
  var saldo_kas = document.getElementById('saldo_kas');
  var saldo_bank = document.getElementById('saldo_bank');
  var surat_berharga = document.getElementById('surat_berharga');

  saldo_kas.addEventListener('keyup', function(e)
  {
    var sld_ks = formatRupiah(this.value);
    $("#sld_ks").attr("value","Rp. "+sld_ks);
  });
  saldo_bank.addEventListener('keyup', function(e)
  {
    var sld_bk = formatRupiah(this.value);
    $("#sld_bk").attr("value","Rp. "+sld_bk);
  });
  surat_berharga.addEventListener('keyup', function(e)
  {
    var srt_hrg = formatRupiah(this.value);
    $("#srt_hrg").attr("value","Rp. "+srt_hrg);
  });
  
  /* Fungsi */
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