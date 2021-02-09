<!-- Pengeluaran Biaya -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Biaya
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Adjustment</li>
          <li class="active">Biaya</li>
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
              <?php echo form_open_multipart('adjustmentpengeluaran/create_pengeluaran_biaya/');?>
                <div class="autoSum">
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Nama Biaya</label>
                      <div class="col-sm-10">
                          <input type="text" name="nama_biaya" class="form-controls" id="inputName" placeholder="Nama Biaya" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Tanggal Dikeluarkan</label>
                      <div class="col-sm-10">
                          <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker" placeholder="Tanggal Dikeluarkan" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Total Biaya</label>
                      <div class="col-sm-10">
                          <input type="text" name="total" class="form-controls" id="total" placeholder="Total Biaya" required>
                          <input type="text" id="ttl" value="Rp. 0" class="span-block" readonly>
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
                        <a href="<?php echo base_url();?>adjustment/pengeluaran" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-akumm">Simpan</button>
                      </div>
                  </div>
                  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                  <script type ="text/javascript">
                    $(".autoSum").keyup(function(){
                      var total = parseInt($("#total").val());
                      var cash = parseInt($("#cash").val());

                      $("#ttl").attr("value","Rp. "+formatRupiah($("#total").val()));

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