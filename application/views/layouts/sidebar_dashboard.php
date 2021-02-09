<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if($this->uri->segment(1) == 'dashboard') { echo 'active open'; } ?>">
          <a href="<?php echo site_url("dashboard")?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
      <li class="header">TRANSAKSI</li>
        <li class="treeview <?php if($this->uri->segment(1) == 'transaksi_pokok') { echo 'active open'; } ?> <?php if($this->uri->segment(1) == 'retur') { echo 'active open'; } ?>">
          <a href="#">
            <i class="fa fa-credit-card"></i> <span>Transaksi Pokok</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("transaksi_pokok/pembelian")?>"><i class="fa fa-circle-o"></i> Pembelian</a></li>
            <li><a href="<?php echo site_url("transaksi_pokok/penjualan")?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li><a href="<?php echo site_url("transaksi_pokok/pembayaran_hutang")?>"><i class="fa fa-circle-o"></i> Pembayaran Hutang</a></li>
            <li><a href="<?php echo site_url("transaksi_pokok/penerimaan_piutang")?>"><i class="fa fa-circle-o"></i> Penerimaan Piutang</a></li>
            <li class="treeview <?php if($this->uri->segment(1) == 'retur') { echo 'active open'; } ?>">
              <a href="#">
                <i class="fa fa-circle"></i> <span> Retur</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url("retur/retur_pembelian")?>"><i class="fa fa-circle-o"></i> Pembelian</a></li>
                <li><a href="<?php echo site_url("retur/retur_penjualan")?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="treeview <?php if($this->uri->segment(1) == 'transaksi_lainnya') { echo 'active open'; } ?> <?php if($this->uri->segment(1) == 'pemasukan') { echo 'active open'; } ?> <?php if($this->uri->segment(1) == 'pengeluaran') { echo 'active open'; } ?>">
          <a href="#">
            <i class="fa fa-credit-card"></i> <span>Transaksi Lainnya</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?php if($this->uri->segment(1) == 'pemasukan') { echo 'active open'; } ?>">
              <a href="#">
                <i class="fa fa-circle"></i> <span> Pemasukan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url("pemasukan/modal")?>"><i class="fa fa-circle-o"></i> Modal/Prive</a></li>
                <li><a href="<?php echo site_url("pemasukan/hutang_bank")?>"><i class="fa fa-circle-o"></i> Hutang Bank</a></li>
                <li><a href="<?php echo site_url("pemasukan/hutang_lainnya")?>"><i class="fa fa-circle-o"></i> Hutang Lainnya</a></li>
                <li><a href="<?php echo site_url("pemasukan/hibah")?>"><i class="fa fa-circle-o"></i> Hibah</a></li>
                <li><a href="<?php echo site_url("pemasukan/penjualan_asset")?>"><i class="fa fa-circle-o"></i> Penjualan Asset</a></li>
                <li><a href="<?php echo site_url("pemasukan/piutang_lainnya")?>"><i class="fa fa-circle-o"></i> Piutang Lainnya</a></li>
              </ul>
            </li>
            <li class="treeview <?php if($this->uri->segment(1) == 'pengeluaran') { echo 'active open'; } ?>">
              <a href="#">
                <i class="fa fa-circle"></i> <span> Pengeluaran</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url("pengeluaran/pembelian_asset")?>"><i class="fa fa-circle-o"></i> Pembelian Asset</a></li>
                <li><a href="<?php echo site_url("pengeluaran/biaya_pengeluaran")?>"><i class="fa fa-circle-o"></i> Biaya Biaya</a></li>
                <li><a href="<?php echo site_url("pengeluaran/modal_pengeluaran")?>"><i class="fa fa-circle-o"></i> Modal/Prive</a></li>
                <li><a href="<?php echo site_url("pengeluaran/dividen")?>"><i class="fa fa-circle-o"></i> Dividen</a></li>
                <li><a href="<?php echo site_url("pengeluaran/hibah_pengeluaran")?>"><i class="fa fa-circle-o"></i> Hibah</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url("transaksi_lainnya/pembayaran_hutang")?>"><i class="fa fa-circle-o"></i> Pembayaran Hutang</a></li>
            <li><a href="<?php echo site_url("transaksi_lainnya/penerimaan_piutang")?>"><i class="fa fa-circle-o"></i> Penerimaan Piutang</a></li>
          </ul>
        </li>
      <li class="header">RIWAYAT</li>
        <li class="treeview <?php if($this->uri->segment(1) == 'riwayat_transaksi') { echo 'active open'; } ?>">
          <a href="#">
            <i class="fa fa-history"></i> <span>Riwayat Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("riwayat_transaksi/transaksi_pokok")?>"><i class="fa fa-circle-o"></i> Transaksi Pokok</a></li>
            <li ><a href="<?php echo site_url("riwayat_transaksi/transaksi_lainnya")?>"><i class="fa fa-circle-o"></i> Transaksi Lainnya</a></li>
            <li ><a href="<?php echo site_url("riwayat_transaksi/data_persediaan")?>"><i class="fa fa-circle-o"></i> Data Persediaan</a></li>
            <li ><a href="<?php echo site_url("riwayat_transaksi/data_aktiva")?>"><i class="fa fa-circle-o"></i> Data Aktiva</a></li>
            <li ><a href="<?php echo site_url("riwayat_transaksi/data_hutang")?>"><i class="fa fa-circle-o"></i> Data Hutang</a></li>
            <li ><a href="<?php echo site_url("riwayat_transaksi/data_piutang")?>"><i class="fa fa-circle-o"></i> Data Piutang</a></li>
            <li ><a href="<?php echo site_url("riwayat_transaksi/log_aktivitas")?>"><i class="fa fa-circle-o"></i> Log Aktivitas</a></li>
          </ul>
        </li>
      <li class="header">Laporan</li>
        <li class="treeview <?php if($this->uri->segment(1) == 'laporan') { echo 'active open'; } ?>">
          <a href="#">
            <i class="fa fa-file-text"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("laporan/laporan_laba")?>"><i class="fa fa-circle"></i> Laba/Rugi</a></li>
            <li ><a href="<?php echo site_url("laporan/laporan_neraca")?>"><i class="fa fa-circle"></i> Neraca</a></li>
          </ul>
        </li>
        <li class="<?php if($this->uri->segment(1) == 'adjustment') { echo 'active open'; } ?>">
          <a href="<?php echo site_url("adjustment")?>">
            <i class="fa fa-gear"></i>
            <span>Adjustment</span>
          </a>
        </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>