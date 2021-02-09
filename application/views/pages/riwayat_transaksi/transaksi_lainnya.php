<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Transaksi Lainnya
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Transaksi Lainnya</li>
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">Pemasukan</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Pengeluaran</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active table-responsive" id="tab_1">
                    <table id="example1" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Transaksi</th>
                          <th>Jenis Transaksi</th>
                          <th>Nilai Transaksi</th>
                          <th>Tanggal Transaksi</th>
                          <th>Jenis Pembayaran</th>
                          <th>Bukti Bayar</th>
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
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".pemasukan<?php echo $obj->id;?>">
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
                          <th>Nama Transaksi</th>
                          <th>Jenis Transaksi</th>
                          <th>Nilai Transaksi</th>
                          <th>Tanggal Transaksi</th>
                          <th>Jenis Pembayaran</th>
                          <th>Bukti Bayar</th>
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
                              <td><?php echo $obj->nama_transaksi;?></td>
                              <td><?php echo $obj->jenis_transaksi;?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_transaksi,0, '', '.');?></td>
                              <td><?php echo $obj->tanggal_transaksi;?></td>
                              <td><?php echo $obj->jenis_pembayaran;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".pengeluaran<?php echo $obj->id;?>">
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
<div class="modal fade pemasukan<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_bayar==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Pemasukan/$obj->bukti_bayar");?>" width="100%">
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