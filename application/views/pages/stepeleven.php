<?php
  foreach ($main['saldo_kas']->result() as $obj) {
    $saldo_laba = $obj->saldo_labarugi;
    $saldo_laba2 = number_format($obj->saldo_labarugi,0,'','.');
    $modal_disetor = $obj->modal_disetor;
    $modal_disetor2 = number_format($obj->modal_disetor,0,'','.');
  }
?>
<div class="row">
  <div class="col-sm-5">
    <div class="stepone-page-left">
      <section class="content-header">
        <h1>
          STEP 11
        </h1>
      </section>

      <section class="content">
        <p>Masukan Saldo Laba/Rugi dan Modal Disetor Anda saat ini : </p>
      </section>
    </div>
  </div>
  <div class="col-sm-7">
    <div class="stepone-page-right">
    <?php echo form_open_multipart('stepeleven/create/');?>
      <div class="row">
        <div class="col-sm-11">
          <label>Masukan Saldo Laba/Rugi Anda</label>
          <input type="text" name="saldo_labarugi" placeholder="Saldo Laba/Rugi" value="<?php echo $saldo_laba;?>" id="saldo_laba" style="background: #FFF5AB;" required>
          <input type="text" id="sld_lb" value="Rp. <?php echo $saldo_laba2;?>" class="span-block" readonly>
        </div>
      </div><br>
      <div class="row">
        <div class="col-sm-11">
          <label>Masukan Modal Disetor Anda</label>
          <input type="text" name="modal_disetor" placeholder="Modal Disetor" id="modal_setor" value="<?php echo $modal_disetor;?>" style="background: #FFF5AB;" required>
          <input type="text" id="mdl_st" value="Rp. <?php echo $modal_disetor2;?>" class="span-block" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-11">
          <div class="align-right">
            <a href="<?php echo base_url('stepten');?>" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
            <button type="submit" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  /* Tanpa Rupiah */
  var tanpa_rupiah = document.getElementById('saldo_laba');
  var tanpa_rupiah2 = document.getElementById('modal_setor');
  tanpa_rupiah.addEventListener('keyup', function(e)
  {
    var sld_lb = formatRupiah(this.value);
    $("#sld_lb").attr("value","Rp. "+sld_lb);
  });
  tanpa_rupiah2.addEventListener('keyup', function(e)
  {
    var mdl_st = formatRupiah(this.value);
    $("#mdl_st").attr("value","Rp. "+mdl_st);
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