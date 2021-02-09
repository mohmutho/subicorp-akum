<?php 
    foreach ($main['sql']->result() as $val) {
        $id = $val->id;
        $jenis_transaksi = $val->jenis_transaksi;
        $nama_transaksi = $val->nama_transaksi;
        $tanggal_transaksi = $val->tanggal_transaksi;
        $nilai_transaksi = $val->nilai_transaksi;
        $nilai_transaksi2 = number_format($val->nilai_transaksi,0,'','.');
        $jenis_pembayaran = $val->jenis_pembayaran;
        $cash = $val->cash;
        $cash2 = number_format($val->cash,0,'','.');
        $kredit = $val->kredit;
        $kredit2 = number_format($val->kredit,0,'','.');
        $bukti_bayar = $val->bukti_bayar;
    }
?>
<!-- Edit Pengeluaran -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Pengeluaran
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Adjustment</li>
          <li class="active">Pengeluaran</li>
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
            <?php echo form_open_multipart('adjustmentpengeluaran/edit_pengeluaran/');?>
            <input type="hidden" name="id" value="<?php echo $id;?>">
              <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pilih Jenis Transaksi</label>
                    <div class="col-sm-10">
                        <select name="pilih_jenis_transaksi" class="form-controls-select" required>
                          <option value="">Pilih Jenis Transaksi</option>
                          <option value="Modal" <?php if($jenis_transaksi=='Modal') echo 'selected';?>>Modal</option>
                          <option value="Hutang Bank" <?php if($jenis_transaksi=='Hutang Bank') echo 'selected';?>>Hutang Bank</option>
                          <option value="Hutang Lainnya" <?php if($jenis_transaksi=='Hutang Lainnya') echo 'selected';?>>Hutang Lainnya</option>
                          <option value="Hibah" <?php if($jenis_transaksi=='Hibah') echo 'selected';?>>Hibah</option>
                          <option value="Penjualan Asset" <?php if($jenis_transaksi=='Penjualan Asset') echo 'selected';?>>Penjualan Asset</option>
                          <option value="Piutang Lainnya" <?php if($jenis_transaksi=='Piutang Lainnya') echo 'selected';?>>Piutang Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_transaksi" class="form-controls" placeholder="Nama Transaksi" value="<?php echo $nama_transaksi;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker" placeholder="Tanggal Transaksi" value="<?php echo $tanggal_transaksi;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nilai Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="nilai_transaksi" class="form-controls" id="nilai_transaksi" placeholder="Nilai Transaksi" value="<?php echo $nilai_transaksi;?>" required>
                        <input type="text" id="nl_tr" value="Rp. <?php echo $nilai_transaksi2;?>" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Upload Bukti</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Pembayaran</label>
                    <div class="col-sm-10">
                        <select name="jenis_pembayaran" class="form-controls-select" onchange="show_value(this.value)" required>
                          <option value="">Pilih</option>
                          <option value="Cash" <?php if($jenis_pembayaran=='Cash') echo 'selected';?>>Cash</option>
                          <option value="Kredit" <?php if($jenis_pembayaran=='Kredit') echo 'selected';?>>Kredit</option>
                          <option value="Cash dan Kredit" <?php if($jenis_pembayaran=='Cash dan Kredit') echo 'selected';?>>Cash dan Kredit</option>
                        </select>
                    </div>
                </div>
                <?php
                    if ($jenis_pembayaran=='Cash dan Kredit') {
                ?>
                <div id="formck">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Cash</label>
                        <div class="col-sm-10">
                            <input type="text" id="cash" name="cash" class="form-controls" placeholder="Cash" value="<?php echo $cash;?>">
                            <input type="text" id="csh" value="Rp. <?php echo $cash2;?>" class="span-block" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Kredit</label>
                        <div class="col-sm-10">
                            <input readonly type="text" id="sisa_kredit" class="form-controls" placeholder="Kredit" value="Rp. <?php echo $kredit2;?>">
                            <input type="hidden" id="ss_krdt" name="sisa_kredit" value="<?php echo $kredit;?>" class="span-block" readonly>
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
                      <a href="<?php echo base_url();?>adjustment/pemasukan" class="btn btn-default">Kembali</a>
                      <button type="submit" class="btn btn-akumm">Simpan</button>
                    </div>
                </div>
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script type ="text/javascript">
                  $(".autoSum").keyup(function(){
                    var total = parseInt($("#nilai_transaksi").val());
                    var cash = parseInt($("#cash").val());

                    var nl_tr = formatRupiah($("#nilai_transaksi").val());
                    $("#nl_tr").attr("value","Rp. "+nl_tr);

                    var csh = formatRupiah($("#cash").val());
                    $("#csh").attr("value","Rp. "+csh);

                    var kredit = total - cash;
                    $("#ss_krdt").attr("value",kredit);

                    $("#sisa_kredit").attr("value","Rp. "+formatRupiah($("#ss_krdt").val() ));
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