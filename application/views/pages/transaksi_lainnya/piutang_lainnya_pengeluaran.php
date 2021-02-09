<!-- Pengeluaran Piutang Lainnya -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Piutang Lainnya
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Pengeluaran</li>
          <li class="active">Piutang Lainnya</li>
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
              <?php echo form_open_multipart('pengeluaran/create_pengeluaran_piutang_lainnya/');?>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Piutang</label>
                    <div class="col-sm-10">
                        <input type="text" name="jumlah_modal" class="form-controls" id="inputName" placeholder="Nama Piutang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nilai Piutang</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah_modal" class="form-controls" id="inputName" placeholder="Nilai Piutang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Pengeluaran</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_setor" class="form-controls" id="inputName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_setor" class="form-controls" id="inputName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Upload Bukti Piutang</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-akumm">Simpan</button>
                    </div>
                </div>
            <?php echo form_close();?>
            </div>
        </div>
    </section>
  </div>
</div>