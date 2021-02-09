<!-- Dashboard -->
<div class="row">
  <div class="col-sm-12">
    <div class="dashboard-page">
      <section class="content-header">
        <div class="row">
          <div class="col-sm-2">
            <img src="<?php echo base_url();?>assets/images/logo_akum.png" width="100%" alt="">
          </div>
          <div class="col-sm-10">
            <h4 align="center">Pilih Aktivitas</h4>
            <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-2">
                <a href="#" class="text-black" data-toggle="modal" data-target="#myModalTransaksiPokok">
                  <img src="<?php echo base_url();?>assets/images/icon-transaksi-pokok.png" width="75%" class="align-center" alt="">
                  <p align="center"><b>Transaksi Pokok</b></p>
                </a>
              </div>
              <div class="col-sm-2">
                <a href="#" class="text-black" data-toggle="modal" data-target="#myModalTransaksiLainnya">
                  <img src="<?php echo base_url();?>assets/images/icon-transaksi-lainnya.png" width="75%" class="align-center" alt="">
                  <p align="center"><b>Transaksi Lainnya</b></p>
                </a>
              </div>
              <div class="col-sm-2">
                <a href="<?php echo site_url('adjustment');?>" class="text-black">
                  <img src="<?php echo base_url();?>assets/images/icon-adjustment.png" width="75%" class="align-center" alt="">
                  <p align="center"><b>Adjustment</b></p>
                </a>
              </div>
              <div class="col-sm-2">
                <a href="#" class="text-black" data-toggle="modal" data-target="#myModalRiwayat">
                  <img src="<?php echo base_url();?>assets/images/icon-history.png" width="75%" class="align-center" alt="">
                  <p align="center"><b>Riwayat</b></p>
                </a>
              </div>
              <div class="col-sm-2">
                <a href="#" class="text-black" data-toggle="modal" data-target="#myModalLaporan">
                  <img src="<?php echo base_url();?>assets/images/icon-laporan.png" width="75%" class="align-center" alt="">
                  <p align="center"><b>Laporan</b></p>
                </a>
              </div>
              <div class="col-sm-1"></div>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="box box-solid">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
              <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active" style="margin:auto;">
                <img src="<?php echo base_url();?>assets/images/ukm1.jpg" alt="First slide" style="margin:auto;">

                <div class="carousel-caption">
                  <h1><label class="label label-default">UMKM GO DIGITAL</label></h1>
                  <h3><label class="label label-default">UMKM Go Digital Adalah Goal Yang Ingin Dicapai</label></h3>
                </div>
              </div>
              <div class="item">
                <img src="<?php echo base_url();?>assets/images/ukm2.jpg" alt="Second slide">

                <div class="carousel-caption">
                  <h1><label class="label label-default">UMKM GO PUBLIC</label></h1>
                  <h3><label class="label label-default">BI Dorong UMKM Perluas Akses Pasar</label></h3>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <span class="fa fa-angle-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <span class="fa fa-angle-right"></span>
            </a>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- Modal Transaksi Pokok -->
<div class="modal fade" id="myModalTransaksiPokok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Transaksi Pokok</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_pembelian.png" width="50%" alt="">
                <h4 align="center">Pembelian</h4><br>
              </div>
              <a href="<?php echo base_url('transaksi_pokok/pembelian');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_penjualan.png" width="50%" alt="">
                <h4 align="center">Penjualan</h4><br>
              </div>
              <a href="<?php echo base_url('transaksi_pokok/penjualan');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_hutang.png" width="50%" alt="">
                <h4 align="center">Pembayaran Hutang</h4>
              </div>
              <a href="<?php echo base_url('transaksi_pokok/pembayaran_hutang');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_piutang.png" width="50%" alt="">
                <h4 align="center">Penerimaan Piutang</h4>
              </div>
              <a href="<?php echo base_url('transaksi_pokok/penerimaan_piutang');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_retur_pembelian.png" width="50%" alt="">
                <h4 align="center">Retur Pembelian</h4><br>
              </div>
              <a href="<?php echo base_url('retur/retur_pembelian');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_retur_penjualan.png" width="50%" alt="">
                <h4 align="center">Retur Penjualan</h4><br>
              </div>
              <a href="<?php echo base_url('retur/retur_penjualan');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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

<!-- Modal Transaksi Lainnya -->
<div class="modal fade" id="myModalTransaksiLainnya" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Transaksi Lainnya</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_pemasukan.png" width="50%" alt="">
                <h4 align="center">Pemasukan</h4><br>
              </div>
              <a href="#" data-toggle="modal" data-target="#myModalPemasukan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_pengeluaran.png" width="50%" alt="">
                <h4 align="center">Pengeluaran</h4><br>
              </div>
              <a href="#" data-toggle="modal" data-target="#myModalPengeluaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_hutang.png" width="50%" alt="">
                <h4 align="center">Pembayaran Hutang</h4>
              </div>
              <a href="<?php echo base_url('transaksi_lainnya/pembayaran_hutang');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_piutang.png" width="50%" alt="">
                <h4 align="center">Penerimaan Piutang</h4>
              </div>
              <a href="<?php echo base_url('transaksi_lainnya/penerimaan_piutang');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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

<!-- Modal Pemasukan -->
<div class="modal fade" id="myModalPemasukan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Pemasukan</h4>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_modal.png" width="50%" alt="">
                <h4 align="center">Modal/Prive</h4><br>
              </div>
              <a href="<?php echo base_url('pemasukan/modal');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_hutang_bank.png" width="50%" alt="">
                <h4 align="center">Hutang Bank</h4><br>
              </div>
              <a href="<?php echo base_url('pemasukan/hutang_bank');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_hutang.png" width="50%" alt="">
                <h4 align="center">Hutang Lainnya</h4>
              </div><br>
              <a href="<?php echo base_url('pemasukan/hutang_lainnya');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_hibah.png" width="50%" alt="">
                <h4 align="center">Hibah</h4>
              </div><br>
              <a href="<?php echo base_url('pemasukan/hibah');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_jual_asset.png" width="50%" alt="">
                <h4 align="center">Penjualan Asset</h4><br>
              </div>
              <a href="<?php echo base_url('pemasukan/penjualan_asset');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_piutang.png" width="50%" alt="">
                <h4 align="center">Piutang Lainnya</h4><br>
              </div>
              <a href="<?php echo base_url('pemasukan/piutang_lainnya');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
              <a href="<?php echo base_url('pengeluaran/pembelian_asset');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_biaya.png" width="50%" alt="">
                <h4 align="center">Biaya Biaya</h4><br>
              </div>
              <a href="<?php echo base_url('pengeluaran/biaya_pengeluaran');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
              <a href="<?php echo base_url('pengeluaran/modal_pengeluaran');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_dividen.png" width="50%" alt="">
                <h4 align="center">Dividen</h4><br>
              </div>
              <a href="<?php echo base_url('pengeluaran/dividen');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_hibah.png" width="50%" alt="">
                <h4 align="center">Hibah</h4>
              </div><br>
              <a href="<?php echo base_url('pengeluaran/hibah_pengeluaran');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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

<!-- Modal Riwayat -->
<div class="modal fade" id="myModalRiwayat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Riwayat</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h4 align="center">Transaki Pokok</h4>
              </div>
              <a href="<?php echo base_url('riwayat_transaksi/transaksi_pokok');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h4 align="center">Transaksi Lainnya</h4>
              </div>
              <a href="<?php echo base_url('riwayat_transaksi/transaksi_lainnya');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h4 align="center">Data Persediaan</h4>
              </div>
              <a href="<?php echo base_url('riwayat_transaksi/data_persediaan');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h4 align="center">Data Aktiva</h4>
              </div>
              <a href="<?php echo base_url('riwayat_transaksi/data_aktiva');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h4 align="center">Data Hutang</h4>
              </div>
              <a href="<?php echo base_url('riwayat_transaksi/data_hutang');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h4 align="center">Data Piutang</h4>
              </div>
              <a href="<?php echo base_url('riwayat_transaksi/data_piutang');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h4 align="center">Log Aktivitas</h4>
              </div>
              <a href="<?php echo base_url('riwayat_transaksi/log_aktivitas');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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

<!-- Modal Laporan -->
<div class="modal fade" id="myModalLaporan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Laporan</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="small-box bg-aqua">
              <div class="inner">
              <img class="center-block" src="<?php echo base_url();?>assets/images/icon_neraca.png" width="50%" alt="">
                <h4 align="center">Neraca</h4>
              </div>
              <a href="<?php echo base_url('laporan/laporan_neraca');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <img class="center-block" src="<?php echo base_url();?>assets/images/icon_laba_rugi.png" width="50%" alt="">
                <h4 align="center">Laba/Rugi</h4>
              </div>
              <a href="<?php echo base_url('laporan/laporan_laba');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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