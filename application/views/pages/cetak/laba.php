        <div class="container">
            <h3 class="text-center">
                Laba Rugi
            </h3>
            <h4 class="text-center"><?php echo $this->session->userdata('nama');?></h4>
            <br>
            <table class="table table-bordered">
                <tbody>
                <!-- Pendapatan -->
                  <tr>
                    <td><b>Pendapatan (Revenue)</b></td>
                  </tr>
                  <tr>
                    <td>Penjualan Barang Jasa</td>
                    <?php
                    $barang_jasa=0;
                    foreach($main['barang_jasa']->result() as $obj){
                        $barang_jasa+= $obj->total_harga;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($barang_jasa,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Retur</td>
                    <td class="text-right">Rp. 0</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Penjualan Asset</td>
                    <?php
                    $asset=0;
                    foreach($main['asset']->result() as $obj){
                        $asset+= $obj->nilai_tanah+$obj->nilai_bangunan;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($asset,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <?php
                    $lainnya=0;
                    foreach($main['lainnya']->result() as $obj){
                        $lainnya+= $obj->nilai_transaksi;
                    }
                    ?>
                    <td>Pendapatan Lainnya</td>
                    <td class="text-right">Rp. <?php echo number_format($lainnya,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Total Pendapatan</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($barang_jasa+$asset+$lainnya,0,'','.');?></td>
                  </tr>
                <!-- END Pendapatan -->
                <!-- Harga Pokok Penjualan -->
                  <tr>
                    <td><b>Harga Pokok Penjualan</b></td>
                  </tr>
                  <tr>
                    <td>Harga Pokok Penjualan</td>
                    <?php
                    $harga_pokok=0;
                    foreach($main['barang_jasa']->result() as $obj){
                        $harga_pokok+= $obj->harga_pokok_penjualan;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($harga_pokok,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Laba / Rugi Kotor</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format(($barang_jasa+$asset+$lainnya)-$harga_pokok,0,'','.');?></td>
                  </tr>
                <!-- END Harga Pokok Penjualan -->
                <!-- Biaya - biaya -->
                  <tr>
                    <td><b>Biaya - biaya</b></td>
                  </tr>
                  <?php
                  foreach($main['biaya']->result() as $obj){
                      $nama_biaya = $obj->nama_biaya;
                      $nilai = $obj->nilai;
                  ?>
                  <tr>
                    <td><?php echo $nama_biaya;?></td>
                    <td class="text-right">Rp. <?php echo number_format($nilai,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <?php
                  }
                  ?>
                  <?php
                  $total_biaya=0;
                  foreach($main['biaya']->result() as $obj){
                      $total_biaya+= $obj->nilai;
                  }
                  ?>
                  <tr>
                    <td><b>Total Biaya</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($total_biaya,0,'','.');?></td>
                  </tr>
                  <tr>
                    <td><b>Laba Sebelum Pajak</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya,0,'','.');?></td>
                  </tr>
                  <tr>
                    <td><b>Pajak (0,5%)</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format(((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)*0.5/100,0,'','.');?></td>
                  </tr>
                  <tr>
                    <td><b>Laba Bersih</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format(((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)-(((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)*0.5/100),0,'','.');?></td>
                  </tr>
                <!-- END Pendapatan -->
                </tbody>
            </table>
        </div>

        <script>
        window.print();
        </script>