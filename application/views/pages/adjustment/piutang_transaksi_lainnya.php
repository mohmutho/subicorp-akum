<!-- Dashboard -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Adjustment Piutang Transaksi Lainnya
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Piutang Transaksi Lainnya</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header">
              <div class="col-sm-10">
                <a href="<?php echo site_url('adjustment/form_piutang_transaksi_lainnya');?>" class="btn btn-akumm"><i class="fa fa-plus"></i> Tambah Piutang Transaksi Lainnya</a>
              </div>
              <div class="col-sm-2">
                <div class="align-right">
                  <a href="<?php echo base_url();?>adjustment/piutang_non_usaha" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
                  <a href="<?php echo base_url();?>adjustment/piutang_usaha" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered" id="example1">
                <thead>
                  <tr>
                      <th>No.</th>
                      <th>Nama Piutang</th>
                      <th>Nilai Piutang</th>
                      <th>Nilai Bayar</th>
                      <th>Tanggal Bayar</th>
                      <th>Keterangan</th>
                      <th>Bukti Transaksi</th>
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
                        <td><?php echo $no;?></td>
                        <td><?php echo $obj->nama_piutang;?></td>
                        <td>Rp. <?php echo number_format($obj->nilai_piutang,0,'','.');?></td>
                        <td>Rp. <?php echo number_format($obj->nilai_bayar,0,'','.');?></td>
                        <td><?php echo $obj->tanggal;?></td>
                        <td><?php echo $obj->ket;?></td>
                        <td>
                          <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".bayar_piutang<?php echo $obj->id;?>">
                            <i class='fa fa-eye'></i> View Image
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-xs btn-info" href="<?php echo base_url();?>adjustment/form_piutang_transaksi_lainnya_edit/<?php echo $obj->id;?>"><i class='fa fa-edit'></i></a>
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

<?php
  foreach ($main['sql']->result() as $obj)
  {
      $id = $obj->id;
?>
<div class="modal fade bayar_piutang<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->foto_bukti==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Bayar_Piutang/$obj->foto_bukti");?>" width="100%">
      </div>
    </div>
  </div>
</div>
<?php
}
?>

<!-- Modal Delete -->
<?php
    $no=0;
    foreach ($main['sql']->result() as $obj3)
    {
?>
<div class="modal fade" id="myModalDelete<?php echo $obj3->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('adjustment/delete_piutang_transaksi_lainnya/');?>
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