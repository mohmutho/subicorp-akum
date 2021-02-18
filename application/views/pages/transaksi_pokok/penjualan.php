<!-- Dashboard -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Penjualan
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Penjualan</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header">
                
            </div>
            <div class="box-body form-horizontal">
            <?php echo form_open_multipart('transaksi_pokok/create_transaksi_pokok_penjualan/');?>
            <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_penjualan" class="form-controls" id="datepicker" placeholder="Tanggal Transaksi" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Costumer</label>
                    <div class="col-sm-10">
                        <input type="text" name="penjualanke" class="form-controls" id="inputName" placeholder="Nama Costumer" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <select id="id_barang" name="id_barang" class="form-controls-select" onchange='changeValue(this.value)' required>
                          <option value="">Pilih</option>
                            <?php
                                $jsArray = "var prdName = new Array();\n";
                                foreach($main['sql']->result() as $obj){
                                    $jbarang = $obj->jenis_barang;
                                    $sbarang = $obj->satuan;
                                    $nmbarang = $obj->nama_barang;
                                    $jmbarang = $obj->jumlah_barang;
                                    $harga_satuan = $obj->harga_satuan
                            ?>
                            <option value="<?php echo $obj->id;?>">
                                <?php echo $obj->nama_barang;?>
                            </option>
                            <?php
                                $jsArray .= "prdName['". $obj->id . "'] = {jenis_barang:'" . addslashes($jbarang) . 
                                  "',satuan:'" . addslashes($sbarang) . 
                                  "',nama_barang:'" . addslashes($nmbarang) . 
                                  "',harga_satuan:'" . addslashes($harga_satuan) . 
                                  "',jumlah_barang:'" . addslashes($jmbarang) . "'};\n";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
                    foreach ($main['sql2']->result() as $obj) {
                        $saldo_kas = $obj->saldo_kas;
                ?>
                    <input type="hidden" name="saldo_kas" value="<?php echo $saldo_kas;?>">
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Barang</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="jenis_barang" name="jenis_barang" class="form-controls" id="inputName" placeholder="Jenis Barang" required>
                        <input type="hidden" id="nama_barang" name="nama_barang" class="form-controls" id="inputName" placeholder="Jenis Barang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Stock Barang</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="jumlah" name="jumlah" class="form-controls" placeholder="Stock Barang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jumlah Barang</label>
                    <div class="col-sm-10">
                        <input type="text" id="jumlah_barang" name="jumlah_barang" class="form-controls" placeholder="Jumlah Barang" required>
                        <input type="text" id="jml_brg" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Satuan</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="satuan" name="satuan" class="form-controls" id="inputName" placeholder="Satuan" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Harga Barang Satuan</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="harga_barang_satuan" name="harga_barang_satuan" class="form-controls" id="inputName" placeholder="Satuan" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Harga Penjualan Satuan</label>
                    <div class="col-sm-10">
                        <input type="text" id="hrg_st" name="harga_satuan"  class="form-controls" value="0" id="inputName" placeholder="Harga Satuan Barang" required>
                        <input type="text" id="harga_satuan" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Diskon Pembelian</label>
                    <div class="col-sm-10">
                        <input type="text" id="diskon" name="diskon" class="form-controls" value="0" placeholder="Diskon Pembelian (Isikon 0 (nol) jika tidak ada)" required>
                        <input type="text" id="dsk" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Harga Pokok Penjualan</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="total_nilai_barang" class="form-controls" placeholder="Total Harga Pokok Penjualan" required>
                        <input type="hidden" id="ttl_nl" name="harga_pokok_penjualan" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <input type="text" id="harga_lainnya" name="harga_lainnya" class="form-controls" value="0" placeholder="Harga Lain-lain (Isikon 0 (nol) jika tidak ada)" required>
                        <input type="text" id="hrg_ln" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Keterangan Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <textarea name="notes_harga_lainnya" cols="10" rows="5" placeholder="Keterangan Biaya Lain-lain" class="form-controls"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Bukti Transaksi</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Harga Transaksi</label>
                    <div class="col-sm-10">
                        <input readonly type="text" id="total" class="form-controls" id="inputName" placeholder="Total Harga Transaksi" required>
                        <input type="hidden" id="ttl_hrg" name="total_harga" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Pembayaran</label>
                    <div class="col-sm-10">
                        <select name="jenis_pembayaran" class="form-controls-select" onchange="show_value(this.value)" required>
                          <option value="">Pilih</option>
                          <option value="Cash">Cash</option>
                          <option value="Kredit">Kredit</option>
                          <option value="Cash dan Kredit">Cash dan Kredit</option>
                        </select>
                    </div>
                </div>
                <div id="formck" style="display: none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Cash</label>
                        <div class="col-sm-10">
                            <input type="text" id="cash" name="cash" class="form-controls" placeholder="Cash">
                            <input type="text" id="csh" value="" class="span-block" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Kredit</label>
                        <div class="col-sm-10">
                            <input readonly type="text" id="sisa_kredit" class="form-controls" placeholder="Kredit">
                            <input type="hidden" id="ss_krdt" name="sisa_kredit" value="" class="span-block" readonly>
                        </div>
                    </div>
                </div>
                <div id="formdate" style="display : none;">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal_jatuh_tempo" class="form-controls" id="datepicker2" placeholder="Tanggal Penjualan">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-akumm">Simpan</button>
                    </div>
                </div>
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script type ="text/javascript">
                  $(".autoSum").keyup(function(){
                    var jumlah_barang = parseInt($("#jumlah_barang").val())
                    var harga_satuan = parseInt($("#hrg_st").val())
                    var diskon = parseInt($("#diskon").val())
                    var biaya_lain = parseInt($("#harga_lainnya").val())
                    var cash = parseInt($("#cash").val())
                    var stock = parseInt($("#jumlah").val())

                    if (jumlah_barang>stock) {
                        alert('Stock tidak mencukupi.');
                    }

                    var total_pokok = (jumlah_barang * harga_satuan) - diskon
                    $("#ttl_nl").attr("value",total_pokok);
                    var ttl_nl = formatRupiah($("#ttl_nl").val())
                    $("#total_nilai_barang").attr("value","Rp. "+ttl_nl);

                    var total = ((jumlah_barang * harga_satuan) - diskon) + biaya_lain
                    $("#ttl_hrg").attr("value",total);
                    var ttl_hrg = formatRupiah($("#ttl_hrg").val())
                    $("#total").attr("value","Rp. "+ttl_hrg);

                    if (cash>total) {
                        alert('Nilai Cash tidak boleh melebihi Total Harga Transaksi!');
                    }else{
                        var sisa_kredit = total - cash;
                    }

                    var jml = formatRupiah($("#jumlah_barang").val());
                    var dsk = formatRupiah($("#diskon").val());
                    var hrg_ln = formatRupiah($("#harga_lainnya").val());
                    var csh = formatRupiah($("#cash").val());
                    var hrg_st = formatRupiah($("#hrg_st").val());

                    $("#hrg_ln").attr("value","Rp. "+hrg_ln);
                    $("#dsk").attr("value","Rp. "+dsk);
                    $("#jml_brg").attr("value",jml);
                    $("#csh").attr("value","Rp. "+csh);
                    $("#ss_krdt").attr("value",sisa_kredit);
                    $("#harga_satuan").attr("value","Rp. "+hrg_st);

                    var ss_krdt = formatRupiah($("#ss_krdt").val());
                    $("#sisa_kredit").attr("value","Rp. "+ss_krdt);
                    });
                  var x = document.getElementById("formck");
                  var y = document.getElementById("formdate");
                  function show_value(val){
                    if (val=='Cash dan Kredit') {
                          x.style.display = "block";
                          y.style.display = "block";
                      }else if(val=='Kredit'){
                          x.style.display = "none";
                          y.style.display = "block";
                      }else{
                          x.style.display = "none";
                          y.style.display = "none";
                      }
                  }
                  <?php echo $jsArray; ?>
                    function changeValue(x){
                        document.getElementById('jumlah').value = prdName[x].jumlah_barang;   
                        document.getElementById('jenis_barang').value = prdName[x].jenis_barang;   
                        document.getElementById('satuan').value = prdName[x].satuan;
                        document.getElementById('harga_barang_satuan').value = prdName[x].harga_satuan;
                        document.getElementById('nama_barang').value = prdName[x].nama_barang;
                    };
                  function formatRupiah(angka, prefix)
                    {
                        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa  = split[0].length % 3,
                        rupiah  = split[0].substr(0, sisa),
                        ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
                        
                        if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                        }
                        
                        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                    }
                </script>
            </div>
            <?php echo form_close();?>
            </div>
        </div>
    </section>
  </div>
</div>