<!-- Pengeluaran Modal -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Modal/Prive (Tarik)
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Pengeluaran</li>
          <li class="active">Modal/Prive</li>
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
              <?php echo form_open_multipart('pengeluaran/create_pengeluaran_modal/');?>
              <div class="autoSum">
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Jumlah Modal</label>
                      <div class="col-sm-10">
                          <input type="text" name="jumlah_modal" id="jumlah_modal" class="form-controls" placeholder="Jumlah Modal" required>
                          <input type="text" id="jml_mdl" value="Rp. " class="span-block" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Tanggal Tarik</label>
                      <div class="col-sm-10">
                          <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker" placeholder="Tanggal Tarik" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Upload Bukti Tarik</label>
                      <div class="col-sm-10">
                          <input type="file" class="form-controls" name="photo" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-akumm">Simpan</button>
                      </div>
                  </div>
                  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                  <script type ="text/javascript">
                      $(".autoSum").keyup(function(){
                        var jml_mdl = formatRupiah($("#jumlah_modal").val());
                        $("#jml_mdl").attr("value","Rp. "+jml_mdl);
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