<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Data Aktiva
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Data Aktiva</li>
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">Aktiva Tetap</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Aktiva Lainnya</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Pembelian</a></li>
                  <li><a href="#tab_4" data-toggle="tab">Penjualan</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <table class="table table-striped table-bordered" id="example1">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Jenis Aktiva</th>
                          <th>Nama Aktiva</th>
                          <th>Nilai Aktiva</th>
                          <th>Alamat</th>
                          <th>Nilai sisa Bangunan</th>
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
                              <td><?php echo $obj->jenis_activa;?></td>
                              <td><?php echo $obj->nama_activa;?></td>
                              <td>Rp. <?php echo number_format($obj->nilai_tanah+$obj->nilai_bangunan,0, '', '.');?></td>
                              <td><?php echo $obj->alamat;?></td>
                              <td>Rp. <?php echo number_format($obj->harga_sisa,0, '', '.');?></td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="tab_2">
                    <table class="table table-striped table-bordered" id="example2">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Jenis Aktiva</th>
                          <th>Nama Aktiva</th>
                          <th>Nilai Aktiva</th>
                          <th>Jangka Waktu Penyusutan</th>
                          <th>Nilai Penyusutan</th>
                          <th>Jumlah Unit</th>
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
                            <td><?php echo $obj->jenis_activa;?></td>
                            <td><?php echo $obj->nama_activa;?></td>
                            <td>Rp. <?php echo number_format($obj->nilai_activa,0,'','.');?></td>
                            <td><?php echo floor($obj->bulan_terpakai/12);?> Tahun <?php echo $obj->bulan_terpakai%12;?> Bulan</td>
                            <td>Rp. <?php echo number_format($obj->akumulasi_penyusutan,0,'','.');?></td>
                            <td><?= $obj->kuantitas;?></td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="tab_3">
                    <table class="table table-striped table-bordered" id="example3">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Transaksi</th>
                          <th>Nilai Transaksi</th>
                          <th>Tanggal Transaksi</th>
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
                            <td><?php echo $obj->nama_transaksi;?></td>
                            <td>Rp. <?php echo number_format($obj->nilai_transaksi,0,'','.');?></td>
                            <td><?= $obj->tanggal_transaksi;?></td>
                          </tr>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="tab_4">
                    <table class="table table-striped table-bordered" id="example4">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Transaksi</th>
                          <th>Nilai Transaksi</th>
                          <th>Tanggal Transaksi</th>
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
                            <td><?php echo $obj->nama_transaksi;?></td>
                            <td>Rp. <?php echo number_format($obj->nilai_transaksi,0,'','.');?></td>
                            <td><?= $obj->tanggal_transaksi;?></td>
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