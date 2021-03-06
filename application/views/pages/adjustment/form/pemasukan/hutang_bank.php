<!-- Pemasukan Hutang Bank -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Hutang Bank
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Adjustment</li>
          <li class="active">Hutang Bank</li>
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
              <?php echo form_open_multipart('adjustmentpemasukan/create_pemasukan_hutang_bank/');?>
                <div class="autoSum">
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Pilih Bank</label>
                      <div class="col-sm-10">
                          <select name="pilih_bank" class="form-controls-select" required>
                            <option value="">Pilih Nama Bank</option>
                            <option value="Bank BNI">Bank BNI</option>
                            <option value="Bank Mandiri">Bank Mandiri</option>
                            <option value="Bank BRI">Bank BRI</option>
                            <option value="Bank BCA">Bank BCA</option>
                            <option value="Bank Simpedes">Bank Simpedes</option>
                            <option value="Bank BJB">Bank BJB</option>
                            <option value="Bank DKI">Bank DKI</option>
                            <option value="Bank BTPN">Bank BTPN</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Nilai Hutang</label>
                      <div class="col-sm-10">
                          <input type="text" name="nilai_hutang" class="form-controls" id="nilai_hutang" placeholder="Nilai Hutang" required>
                          <input type="text" id="nl_htng" value="Rp. " class="span-block" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Tanggal Penerimaan</label>
                      <div class="col-sm-10">
                          <input type="text" name="tanggal_transaksi" class="form-controls" id="datepicker" placeholder="Tanggal Penerimaan" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
                      <div class="col-sm-10">
                          <input type="text" name="tanggal_jatuh_tempo" class="form-controls" id="datepicker2" placeholder="Tanggal Jatuh Tempo" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Upload Bukti Hutang</label>
                      <div class="col-sm-10">
                          <input type="file" class="form-controls" name="photo" required>
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
                      var nl_htng = formatRupiah($("#nilai_hutang").val());
                      $("#nl_htng").attr("value","Rp. "+nl_htng);
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