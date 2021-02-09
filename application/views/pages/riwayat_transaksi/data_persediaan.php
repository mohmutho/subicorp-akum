<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Data Persediaan
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Data Persediaan</li>
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">Barang Dagang</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Barang Lainnya</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <table class="table table-striped table-bordered" id="example1">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Jenis Persediaan</th>
                          <th>Nama Persediaan</th>
                          <th>Jumlah</th>
                          <th>Total Nilai Persediaan</th>
                          <th>Harga Rata-Rata</th>
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
                              <td><?php echo $obj->jenis_barang;?></td>
                              <td><?php echo $obj->nama_barang;?></td>
                              <td><?php echo number_format($obj->jumlah_barang,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_satuan * $obj->jumlah_barang,0, '', '.');?></td>
                              <td><?php echo number_format(($obj->harga_satuan * $obj->jumlah_barang) / $obj->jumlah_barang,0, '', '.');?></td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <table class="table table-striped table-bordered" id="example2">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Jenis Persediaan</th>
                          <th>Nama Persediaan</th>
                          <th>Jumlah</th>
                          <th>Total Nilai Persediaan</th>
                          <th>Harga Rata-Rata</th>
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
                              <td>LAINNYA</td>
                              <td><?php echo $obj->nama_barang;?></td>
                              <td><?php echo number_format($obj->jumlah_barang,0, '', '.');?></td>
                              <td><?php echo number_format($obj->harga_satuan * $obj->jumlah_barang,0, '', '.');?></td>
                              <td><?php echo number_format(($obj->harga_satuan * $obj->jumlah_barang) / $obj->jumlah_barang,0, '', '.');?></td>
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