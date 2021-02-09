<!-- Dashboard -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Adjustment Retur Penjualan
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Retur Penjualan</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header">
              <div class="col-sm-10">
                <a href="<?php echo site_url('adjustment/form_retur_penjualan');?>" class="btn btn-akumm"><i class="fa fa-plus"></i> Tambah Retur Penjualan</a>
              </div>
              <div class="col-sm-2">
                <div class="align-right">
                  <a href="<?php echo base_url();?>adjustment/retur_pembelian" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
                  <a href="<?php echo base_url();?>adjustment/pemasukan" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Retur</th>
                        <th>Keterangan</th>
                        <th>Bukti Retur</th>
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
                            <td><?php echo $obj->nama_barang;?></td>
                            <td><?php echo number_format($obj->jumlah,0, '', '.');?></td>
                            <td><?php echo $obj->tgl_retur;?></td>
                            <td><?php echo $obj->keterangan;?></td>
                            <td>
                              <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".retur_penjualan<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                              </a>
                            </td>
                            <td>
                              <a class="btn btn-xs btn-info" href="<?php echo base_url();?>adjustment/form_retur_penjualan_edit/<?php echo $obj->id;?>"><i class='fa fa-edit'></i></a>
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
<div class="modal fade retur_penjualan<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_pembelian==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Retur_Penjualan/$obj->bukti_pembelian");?>" width="100%">
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
    <?php echo form_open_multipart('adjustment/delete_retur_penjualan/');?>
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