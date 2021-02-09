<!-- Dashboard -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Adjustment Pengeluaran
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Pengeluaran</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header">
              <div class="col-sm-10">
                <a href="#" data-toggle="modal" data-target="#myModalPengeluaran" class="btn btn-akumm"><i class="fa fa-plus"></i> Tambah Pengeluaran</a>
              </div>
              <div class="col-sm-2">
                <div class="align-right">
                  <a href="<?php echo base_url();?>adjustment/pemasukan" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
                  <a href="<?php echo base_url();?>adjustment/activa_tetap" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Transaksi</th>
                    <th>Jenis Transaksi</th>
                    <th>Nilai Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jenis Pembayaran</th>
                    <th>Total Cash</th>
                    <th>Total Kredit</th>
                    <th>Bukti Bayar</th>
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
                        <td><?php echo $obj->nama_transaksi;?></td>
                        <td><?php echo $obj->jenis_transaksi;?></td>
                        <td>Rp. <?php echo number_format($obj->nilai_transaksi,0, '', '.');?></td>
                        <td><?php echo $obj->tanggal_transaksi;?></td>
                        <td><?php echo $obj->jenis_pembayaran;?></td>
                        <td>Rp. <?php echo number_format($obj->cash,0, '', '.');?></td>
                        <td>Rp. <?php echo number_format($obj->kredit,0, '', '.');?></td>
                        <td>
                          <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".pengeluaran<?php echo $obj->id;?>">
                            <i class='fa fa-eye'></i> View Image
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-xs btn-info" href="<?php echo base_url();?>adjustmentpengeluaran/form_pengeluaran_edit/<?php echo $obj->id;?>"><i class='fa fa-edit'></i></a>
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
<div class="modal fade pengeluaran<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_bayar==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Pengeluaran/$obj->bukti_bayar");?>" width="100%">
      </div>
    </div>
  </div>
</div>
<?php
}
?>

<!-- Modal Pengeluaran -->
<div class="modal fade" id="myModalPengeluaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Pengeluaran</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_pembelian_asset.png" width="50%" alt="">
                <h4 align="center">Pembelian Asset</h4><br>
              </div>
              <a href="<?php echo base_url('adjustmentpengeluaran/pembelian_asset');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_biaya.png" width="50%" alt="">
                <h4 align="center">Biaya Biaya</h4><br>
              </div>
              <a href="<?php echo base_url('adjustmentpengeluaran/biaya_pengeluaran');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_pengeluaran.png" width="50%" alt="">
                <h4 align="center">Pengeluaran Lainnya</h4>
              </div>
              <a href="#" data-toggle="modal" data-target="#myModalPengeluaranLainnya" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-akumm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Pengeluaran Lainnya -->
<div class="modal fade" id="myModalPengeluaranLainnya" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Pengeluaran Lainnya</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_modal.png" width="50%" alt="">
                <h4 align="center">Modal/Prive</h4><br>
              </div>
              <a href="<?php echo base_url('adjustmentpengeluaran/modal_pengeluaran');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_dividen.png" width="50%" alt="">
                <h4 align="center">Dividen</h4><br>
              </div>
              <a href="<?php echo base_url('adjustmentpengeluaran/dividen');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_hibah.png" width="50%" alt="">
                <h4 align="center">Hibah</h4>
              </div><br>
              <a href="<?php echo base_url('adjustmentpengeluaran/hibah_pengeluaran');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-akumm" data-dismiss="modal">Close</button>
      </div>
    </div>
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
    <?php echo form_open_multipart('adjustmentpengeluaran/delete_pengeluaran/');?>
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