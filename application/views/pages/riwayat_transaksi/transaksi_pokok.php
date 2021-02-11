<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Transaksi Pokok
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Transaksi Pokok</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-body">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Pembelian</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Penjualan</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Retur Pembelian</a></li>
                  <li><a href="#tab_4" data-toggle="tab">Retur Penjualan</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active table-responsive" id="tab_1">
                    <table id="example1" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Supplier</th>
                          <th>Nama Barang</th>
                          <th>Jenis Barang</th>
                          <th>Satuan</th>
                          <th>Jumlah</th>
                          <th>Harga Barang</th>
                          <th>Diskon</th>
                          <th>Biaya Lainnya</th>
                          <th>Total Harga</th>
                          <th>Tanggal Pembelian</th>
                          <th>Tipe Pembayaran</th>
                          <th>Bukti Pembelian</th>
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
                              <td><?php echo $obj->pembelian_dari;?></td>
                              <td><?php echo $obj->nama_barang;?></td>
                              <td><?php echo $obj->jenis_barang;?></td>
                              <td><?php echo $obj->satuan;?></td>
                              <td><?php echo number_format($obj->jumlah,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_barang,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_diskon,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_lainnya,0, '', '.');?></td>
                              <td><?php echo number_format($obj->total_harga,0, '', '.');?></td>
                              <td><?php echo $obj->tanggal_pembelian;?></td>
                              <td><?php echo $obj->tipe_pembayaran;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".pembelian<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                                </a>
                              </td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_2">
                    <table id="example2" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Customer</th>
                          <th>Nama Barang</th>
                          <th>Jenis Barang</th>
                          <th>Satuan</th>
                          <th>Jumlah</th>
                          <th>Harga Barang</th>
                          <th>Diskon</th>
                          <th>Biaya Lainnya</th>
                          <th>Total Harga</th>
                          <th>Harga Pokok</th>
                          <th>Tanggal Penjualan</th>
                          <th>Tipe Pembayaran</th>
                          <th>Bukti Penjualan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $no=0;
                            foreach ($main['sql2']->result() as $obj)
                            {
                                $no++;
                        ?>
                          <tr>
                              <td><?php echo $no;?></td>
                              <td><?php echo $obj->penjualanke;?></td>
                              <td><?php echo $obj->nama_barang;?></td>
                              <td><?php echo $obj->jenis_barang;?></td>
                              <td><?php echo $obj->satuan;?></td>
                              <td><?php echo number_format($obj->jumlah,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_barang,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_diskon,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_lainnya,0, '', '.');?></td>
                              <td><?php echo number_format($obj->total_harga,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_pokok_penjualan,0, '', '.');?></td>
                              <td><?php echo $obj->tanggal_penjualan;?></td>
                              <td><?php echo $obj->jenis_pembayaran;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".penjualan<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                                </a>
                              </td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_3">
                    <table id="example3" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Transaksi</th>
                          <th>Jumlah</th>
                          <th>Total Harga Retur</th>
                          <th>Tanggal Retur</th>
                          <th>Keterangan</th>
                          <th>Bukti Retur</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $no=0;
                            foreach ($main['sql3']->result() as $obj)
                            {
                                $no++;
                        ?>
                          <tr>
                              <td><?php echo $no;?></td>
                              <td><?php echo $obj->nama_barang;?></td>
                              <td><?php echo number_format($obj->jumlah,0, '', '.');?></td>
                              <td><?php echo number_format($obj->total_harga,0, '', '.');?></td>
                              <td><?php echo $obj->tgl_retur;?></td>
                              <td><?php echo $obj->keterangan;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".retur_pembelian<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                                </a>
                              </td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_4">
                    <table id="example4" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Transaksi</th>
                          <th>Jumlah</th>
                          <th>Total Harga Retur</th>
                          <th>Tanggal Retur</th>
                          <th>Keterangan</th>
                          <th>Bukti Retur</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $no=0;
                            foreach ($main['sql4']->result() as $obj)
                            {
                                $no++;
                        ?>
                          <tr>
                              <td><?php echo $no;?></td>
                              <td><?php echo $obj->nama_barang;?></td>
                              <td><?php echo number_format($obj->jumlah,0, '', '.');?></td>
                              <td><?php echo number_format($obj->total_harga,0, '', '.');?></td>
                              <td><?php echo $obj->tgl_retur;?></td>
                              <td><?php echo $obj->keterangan;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".retur_penjualan<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                                </a>
                              </td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- nav-tabs-custom -->
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
<div class="modal fade pembelian<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_pembelian==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Pembelian/$obj->bukti_pembelian");?>" width="100%">
      </div>
    </div>
  </div>
</div>
<?php
}
?>

<?php
  foreach ($main['sql2']->result() as $obj)
  {
    $id = $obj->id;
?>
<div class="modal fade penjualan<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_penjualan==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Penjualan/$obj->bukti_penjualan");?>" width="100%">
      </div>
    </div>
  </div>
</div>
<?php
}
?>

<?php
  foreach ($main['sql3']->result() as $obj)
  {
    $id = $obj->id;
?>
<div class="modal fade retur_pembelian<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_pembelian==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Retur_Pembelian/$obj->bukti_pembelian");?>" width="100%">
      </div>
    </div>
  </div>
</div>
<?php
}
?>

<?php
  foreach ($main['sql4']->result() as $obj)
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