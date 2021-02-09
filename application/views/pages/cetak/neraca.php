<?php
  $barang_jasa=0;
  foreach($main['barang_jasa']->result() as $obj){
      $barang_jasa+= $obj->total_harga;
  }
  $asset=0;
  foreach($main['asset']->result() as $obj){
      $asset+= $obj->nilai_tanah+$obj->nilai_bangunan;
  }
  $lainnya=0;
  foreach($main['lainnya']->result() as $obj){
      $lainnya+= $obj->nilai_transaksi;
  }
  $harga_pokok=0;
  foreach($main['barang_jasa']->result() as $obj){
      $harga_pokok+= $obj->harga_pokok_penjualan;
  }
  $total_biaya=0;
  foreach($main['biaya']->result() as $obj){
      $total_biaya+= $obj->nilai;
  }
?>
        <div class="container">
            <h3 class="text-center">
                Neraca Saldo
              </h3>
              <h4 class="text-center"><?php echo $this->session->userdata('nama');?></h4>
              <br>
            <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center" colspan="3">Aktiva</th>
                  </tr>
                </thead>
                <tbody>
                <!-- Aktiva Lancar -->
                  <tr>
                    <td colspan="3"><b>Aktiva Lancar</b></td>
                  </tr>
                  <tr>
                    <td>Saldo Kas</td>
                    <?php foreach($main['saldo_kas']->result() as $obj){
                        $saldo_kas = $obj->saldo_kas;
                        $saldo_bank = $obj->saldo_bank;
                        $surat_berharga = $obj->surat_berharga;
                      ?>
                      <td class="text-right">Rp. <?php echo number_format($saldo_kas,0,'','.');?></td>
                      <?php
                    } ?>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Saldo Bank</td>
                    <td class="text-right">Rp. <?php echo number_format($saldo_bank,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Piutang Dagang</td>
                    <?php
                    $piutang_dagang=0;
                    foreach($main['piutang_dagang']->result() as $obj){
                        $piutang_dagang+= $obj->nilai_piutang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($piutang_dagang,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Piutang Retur</td>
                    <?php
                    $piutang_retur=0;
                    foreach($main['piutang_retur']->result() as $obj){
                        $piutang_retur+= $obj->nilai_piutang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($piutang_retur,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Piutang Lainnya</td>
                    <?php
                    $piutang_lainnya=0;
                    foreach($main['piutang_lainnya']->result() as $obj){
                        $piutang_lainnya+= $obj->nilai_piutang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($piutang_lainnya,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Persediaan</td>
                    <?php
                    $persediaan=0;
                    foreach($main['persediaan']->result() as $obj){
                        $persediaan+= $obj->total_nilai_barang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($persediaan,0,'','.')?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Persediaan Lainnya</td>
                    <?php
                    $persediaan_lainnya=0;
                    foreach($main['persediaan_lainnya']->result() as $obj){
                        $persediaan_lainnya+= $obj->harga_satuan*$obj->jumlah_barang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($persediaan_lainnya,0,'','.')?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Jumlah Aktiva Lancar</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($saldo_kas+$saldo_bank+$piutang_dagang+$piutang_retur+$piutang_lainnya+$persediaan+$persediaan_lainnya,0,'','.');?></td>
                  </tr>
                <!-- END Aktiva Lancar -->
                <!-- Aktiva Tetap -->
                  <tr>
                    <td colspan="3"><b>Aktiva Tetap</b></td>
                  </tr>
                  <?php
                    foreach($main['activa_tetap']->result() as $obj){
                      $nama_activa = $obj->nama_activa;
                      $jml_activa= $obj->nilai_tanah + $obj->nilai_bangunan;
                  ?>
                  <tr>
                    <td><?php echo $nama_activa;?></td>
                    <td class="text-right">Rp. <?php echo number_format($jml_activa,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <?php
                    }
                  ?>
                  <?php
                    $jml_activa_tetap=0;
                    foreach($main['activa_tetap']->result() as $obj){
                      $jml_activa_tetap+= $obj->nilai_tanah + $obj->nilai_bangunan;
                    }
                  ?>
                  <tr>
                    <td><b>Jumlah Aktiva Tetap</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($jml_activa_tetap,0,'','.');?></td>
                  </tr>
                  <!-- Aktiva Lainnya -->
                <tr>
                    <td colspan="3"><b>Aktiva Lainnya</b></td>
                  </tr>
                  <?php
                    foreach($main['activa_lainnya']->result() as $obj){
                      $nama_activa_lainnya = $obj->nama_activa;
                      $jml_activa_lainnya= $obj->nilai_activa;
                  ?>
                  <tr>
                    <td><?php echo $nama_activa_lainnya;?></td>
                    <td class="text-right">Rp. <?php echo number_format($jml_activa_lainnya,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <?php
                    }
                  ?>
                  <?php
                    $jml_activa_lainnya_total=0;
                    foreach($main['activa_lainnya']->result() as $obj){
                      $jml_activa_lainnya_total+= $obj->nilai_activa;
                    }
                  ?>
                  <tr>
                    <td><b>Jumlah Aktiva Lainnya</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($jml_activa_lainnya_total,0,'','.');?></td>
                  </tr>
                <!-- END Aktiva Lainnya -->
                  <tr>
                    <td><b>Jumlah Aktiva</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($jml_activa_tetap+$jml_activa_lainnya_total+$saldo_kas+$saldo_bank+$piutang_dagang+$piutang_retur+$piutang_lainnya+$persediaan+$persediaan_lainnya,0,'','.');?></td>
                  </tr>
                <!-- END Aktiva Tetap -->
                </tbody>
              </table>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center" colspan="3">Kewajiban</th>
                  </tr>
                </thead>
                <tbody>
                <!-- Kewajiban Lancar -->
                  <tr>
                    <td colspan="3"><b>Kewajiban Lancar</b></td>
                  </tr>
                  <tr>
                    <td>Hutang Dagang</td>
                    <?php
                    $hutang_dagang=0;
                    foreach($main['hutang_dagang']->result() as $obj){
                      $hutang_dagang+= $obj->nilai_hutang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($hutang_dagang,0,'','.')?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Hutang Retur</td>
                    <?php
                    $hutang_retur=0;
                    foreach($main['hutang_retur']->result() as $obj){
                        $hutang_retur+= $obj->nilai_hutang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($hutang_retur,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Sewa Diterima</td>
                    <td class="text-right">Rp. 0</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Hutang Lainnya</td>
                    <?php
                    $hutang_lainnya=0;
                    foreach($main['hutang_lainnya']->result() as $obj){
                      $hutang_lainnya+= $obj->nilai_hutang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($hutang_lainnya,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Hibah</td>
                    <?php
                    $hibah=0;
                    foreach($main['hibah']->result() as $obj){
                      $hibah+= $obj->nilai_barang;
                    }
                    ?>
                    <td class="text-right">Rp. <?php echo number_format($hibah,0,'','.');?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Jumlah Kewajiban Lancar</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($hutang_dagang+$hutang_retur+$hutang_lainnya+$hibah,0,'','.');?></td>
                  </tr>
                <!-- END Kewajiban Lancar -->
                <!-- Kewajiban Jangka Panjang -->
                  <tr>
                    <td><b>Kewajiban Jangka Panjang</b></td>
                  </tr>
                  <tr>
                    <td>Hutang Bank</td>
                    <?php
                    $hutang_bank=0;
                    foreach($main['hutang_bank']->result() as $obj){
                      $hutang_bank+= $obj->nilai_hutang;
                    }
                    ?> 
                    <td class="text-right">Rp. <?php echo number_format($hutang_bank,0,'','.')?></td>
                  </tr>
                  <tr>
                    <td><b>Jumlah Kewajiban Jangka Panjang</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format($hutang_bank,0,'','.');?></td>
                  </tr>
                <!-- END Kewajiban Jangka Panjang -->
                <!-- Equity -->
                  <tr>
                    <td><b>Equity</b></td>
                  </tr>
                  <tr>
                    <td>Surat Berharga</td>
                    <td class="text-right">Rp. <?= number_format($surat_berharga,0,'','.')?></td>
                  </tr>
                  <tr>
                    <td>Modal Pemilik</td>
                    <?php
                    $modal_pemilik=0;
                    foreach($main['saldo_kas']->result() as $obj){
                      $modal_pemilik+= $obj->modal_disetor;
                    }
                    ?> 
                    <td class="text-right">Rp. <?php echo number_format($modal_pemilik,0,'','.')?></td>
                  </tr>
                  <tr>
                    <td>Laba Rugi</td>
                    <td class="text-right">Rp. <?php echo number_format(((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)-(((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)*0.5/100),0,'','.');?></td>
                  </tr>
                  <tr>
                    <td><b>Jumlah Equity</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format(((($surat_berharga+$barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)-(((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)*0.5/100)+$modal_pemilik,0,'','.');?></td>
                  </tr>
                  <tr>
                    <td><b>Jumlah Kewajiban dan Modal</b></td>
                    <td></td>
                    <td class="text-right">Rp. <?php echo number_format((((($surat_berharga+$barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)-(((($barang_jasa+$asset+$lainnya)-$harga_pokok)-$total_biaya)*0.5/100)+$modal_pemilik)+($hutang_dagang+$hutang_retur+$hutang_lainnya+$hibah)+$hutang_bank,0,'','.');?></td>
                  </tr>
                <!-- END Equity -->
                </tbody>
            </table>
        </div>

        <script>
        window.print();
        </script>