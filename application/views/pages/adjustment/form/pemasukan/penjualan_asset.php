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
          <li>Adjustment</li>
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
            <?php echo form_open_multipart('adjustmentpemasukan/create_penjualan_asset/');?>
              <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pilih Jenis Asset</label>
                    <div class="col-sm-10">
                        <select name="pilih_jenis_asset" class="form-controls-select" required>
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
                        <!-- <input type="text" name="nama_asset" class="form-controls" placeholder="Nama Asset" required> -->
                        <select name="id_asset" id="id_asset" class="form-controls-select" required>
                          <option value="">Nama Asset</option>
                          <?php 
                            foreach ($main['sql']->result() as $val) {
                          ?>
                          <option value="<?php echo $val->id;?>"><?php echo $val->nama_activa;?></option>
                          <?php
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
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jumlah Unit</label>
                    <div class="col-sm-10">
                        <input type="text" name="jumlah" class="form-controls" id="jumlah" placeholder="Jumlah Unit" required>
                        <input type="text" id="jml" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Harga Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="harga_barang" class="form-controls" id="harga_barang" placeholder="Harga Barang" required>
                        <input type="text" id="hrg_brng" value="Rp. " class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Penjualan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-controls" id="total" placeholder="Total Penjualan" required>
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
                    var harga_barang = parseInt($("#harga_barang").val());
                    var jumlah = parseInt($("#jumlah").val());
                    var cash = parseInt($("#cash").val());

                    var total = harga_barang * jumlah;
                    $("#ttl").attr("value",total);

                    $("#total").attr("value","Rp. "+formatRupiah($("#ttl").val()));

                    var hrg_brng = formatRupiah($("#harga_barang").val());
                    $("#hrg_brng").attr("value","Rp. "+hrg_brng);

                    var jml = formatRupiah($("#jumlah").val());
                    $("#jml").attr("value",jml);

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