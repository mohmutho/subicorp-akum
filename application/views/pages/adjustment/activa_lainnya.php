<!-- Dashboard -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Adjustment Activa Lainnya
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Activa Lainnya</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header">
              <div class="col-sm-10">
                <a href="<?php echo site_url('adjustment/form_activa_lainnya');?>" class="btn btn-akumm"><i class="fa fa-plus"></i> Tambah Activa Lainnya</a>
              </div>
              <div class="col-sm-2">
                <div class="align-right">
                  <a href="<?php echo base_url();?>adjustment/activa_tetap" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
                  <a href="<?php echo base_url();?>adjustment/hutang_usaha" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="box-body">
              <table class="table table-striped table-bordered" id="example1">
                <thead>
                  <tr>
                    <th>Jenis Aktiva</th>
                    <th>Nama Aktiva</th>
                    <th>Nilai Aktiva</th>
                    <th>Jangka Waktu Penyusutan</th>
                    <th>Nilai Penyusutan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $no=0;
                      foreach ($main['sql']->result() as $obj)
                      {
                          $no++;
                  ?>
                    <tr>
                        <td><?php echo $obj->jenis_activa;?></td>
                        <td><?php echo $obj->nama_activa;?></td>
                        <td>Rp. <?php echo number_format($obj->nilai_activa,0,'','.');?></td>
                        <td><?php echo floor($obj->bulan_terpakai/12);?> Tahun <?php echo $obj->bulan_terpakai%12;?> Bulan</td>
                        <td>Rp. <?php echo number_format($obj->akumulasi_penyusutan,0,'','.');?></td>
                        <td>
                          <a class="btn btn-xs btn-info" href="<?php echo base_url();?>adjustment/form_activa_lainnya_edit/<?php echo $obj->id;?>"><i class='fa fa-edit'></i></a>
                          <a  class="btn btn-xs btn-danger" href="#" data-toggle="modal" data-target="#myModalDelete<?php echo $obj->id;?>"><i class='fa fa-close'></i></a>
                        </td>
                    </tr>
                  <?php
                      }
                  ?>
                </tbody>
              </table>
            </div>
        </div>
    </section>
  </div>
</div>

<!-- Modal Delete -->
<?php
    $no=0;
    foreach ($main['sql']->result() as $obj3)
    {
?>
<div class="modal fade" id="myModalDelete<?php echo $obj3->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('adjustment/delete_activa_lainnya/');?>
    <input type="hidden" name="id" value="<?php echo $obj3->id;?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-akumm">Iya</button>
      </div>
    <?php echo form_close();?>
    </div>
  </div>
</div>
<?php
  }
?>