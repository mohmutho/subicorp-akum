<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Data Hutang
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Data Hutang</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <!-- <div class="box-header"></div> -->
            <div class="box-body">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Usaha</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Non Usaha</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Bank</a></li>
                  <li><a href="#tab_4" data-toggle="tab">Riwayat Hutang Transaksi Pokok</a></li>
                  <li><a href="#tab_5" data-toggle="tab">Riwayat Hutang Transaksi Lainnya</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active table-responsive" id="tab_1">
                    <table class="table table-striped table-bordered" id="example1">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Hutang</th>
                            <th>Nilai Hutang</th>
                            <th>Tanggal Transaksi</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Keterangan</th>
                            <th>Bukti Transaksi</th>
                            <th>Status</th>
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
                              <td><?php echo $obj->nama_hutang;?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_hutang,0,'','.');?></td>
                              <td><?php echo $obj->tgl_transaksi;?></td>
                              <td><?php echo $obj->tgl_jatuh_tempo;?></td>
                              <td><?php echo $obj->keterangan;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".hutang<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                                </a>
                              </td>
                              <td><?php echo $obj->status;?></td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_2">
                    <table class="table table-striped table-bordered" id="example2">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Hutang</th>
                            <th>Nilai Hutang</th>
                            <th>Tanggal Transaksi</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Keterangan</th>
                            <th>Bukti Transaksi</th>
                            <th>Status</th>
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
                              <td><?php echo $obj->nama_hutang;?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_hutang,0,'','.');?></td>
                              <td><?php echo $obj->tgl_transaksi;?></td>
                              <td><?php echo $obj->tgl_jatuh_tempo;?></td>
                              <td><?php echo $obj->keterangan;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".hutang2<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                                </a>
                              </td>
                              <td><?php echo $obj->status;?></td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_3">
                    <table class="table table-striped table-bordered" id="example3">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Hutang</th>
                            <th>Nilai Hutang</th>
                            <th>Tanggal Transaksi</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Keterangan</th>
                            <th>Bukti Transaksi</th>
                            <th>Status</th>
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
                              <td><?php echo $obj->nama_hutang;?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_hutang,0,'','.');?></td>
                              <td><?php echo $obj->tgl_transaksi;?></td>
                              <td><?php echo $obj->tgl_jatuh_tempo;?></td>
                              <td><?php echo $obj->keterangan;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".hutang3<?php echo $obj->id;?>">
                                  <i class='fa fa-eye'></i> View Image
                                </a>
                              </td>
                              <td><?php echo $obj->status;?></td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_4">
                    <table class="table table-striped table-bordered" id="example4">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Hutang</th>
                            <th>Nilai Hutang</th>
                            <th>Nilai Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Keterangan</th>
                            <th>Bukti Transaksi</th>
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
                              <td><?php echo $obj->nama_hutang;?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_hutang,0,'','.');?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_bayar,0,'','.');?></td>
                              <td><?php echo $obj->tanggal;?></td>
                              <td><?php echo $obj->ket;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".hutang4<?php echo $obj->id;?>">
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
                  <div class="tab-pane table-responsive" id="tab_5">
                    <table class="table table-striped table-bordered" id="example5">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Hutang</th>
                            <th>Nilai Hutang</th>
                            <th>Nilai Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Keterangan</th>
                            <th>Bukti Transaksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $no=0;
                            foreach ($main['sql5']->result() as $obj)
                            {
                                $no++;
                        ?>
                          <tr>
                              <td><?php echo $no;?></td>
                              <td><?php echo $obj->nama_hutang;?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_hutang,0,'','.');?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_bayar,0,'','.');?></td>
                              <td><?php echo $obj->tanggal;?></td>
                              <td><?php echo $obj->ket;?></td>
                              <td>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".hutang5<?php echo $obj->id;?>">
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
<div class="modal fade hutang<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_transaksi==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Hutang/$obj->bukti_transaksi");?>" width="100%">
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
<div class="modal fade hutang2<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_transaksi==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Hutang/$obj->bukti_transaksi");?>" width="100%">
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
<div class="modal fade hutang3<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->bukti_transaksi==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Hutang/$obj->bukti_transaksi");?>" width="100%">
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
<div class="modal fade hutang4<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->foto_bukti==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Bayar_Hutang/$obj->foto_bukti");?>" width="100%">
      </div>
    </div>
  </div>
</div>
<?php
}
?>

<?php
  foreach ($main['sql5']->result() as $obj)
  {
    $id = $obj->id;
?>
<div class="modal fade hutang5<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img src="<?php if($obj->foto_bukti==NULL) echo site_url('assets/images/dummy.png'); else echo site_url("Foto/Bayar_Hutang/$obj->foto_bukti");?>" width="100%">
      </div>
    </div>
  </div>
</div>
<?php
}
?>