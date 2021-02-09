<!-- Pengeluaran Dividen -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Dividen
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Adjustment</li>
          <li class="active">Dividen</li>
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
              <?php echo form_open_multipart('adjustmentpengeluaran/create_pengeluaran_dividen/');?>
                <div class="autoSum">
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Nama Dividen</label>
                      <div class="col-sm-10">
                          <input type="text" name="nama_dividen" class="form-controls" id="inputName" placeholder="Nama Dividen" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Nilai Dividen</label>
                      <div class="col-sm-10">
                          <input type="text" name="nilai_dividen" class="form-controls" id="nilai_dividen" placeholder="Nilai Dividen" required>
                          <input type="text" id="nl_dv" value="Rp. " class="span-block" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Tanggal Dividen</label>
                      <div class="col-sm-10">
                          <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker" placeholder="Tanggal Dividen" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Upload Bukti</label>
                      <div class="col-sm-10">
                          <input type="file" class="form-controls" name="photo" required>
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
                        var nl_dv = formatRupiah($("#nilai_dividen").val());
                        $("#nl_dv").attr("value","Rp. "+nl_dv);
                      });
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