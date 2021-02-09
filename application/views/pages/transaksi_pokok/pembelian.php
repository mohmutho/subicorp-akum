<!-- Dashboard -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Pembelian
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Pembelian</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>

      <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body form-horizontal">
              <?php echo form_open_multipart('transaksi_pokok/create_transaksi_pokok_pembelian/');?>
              <div class="autoSum">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_pembelian" class="form-controls" id="datepicker" placeholder="Tanggal Transaksi" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" name="pembelian_dari" class="form-controls" id="inputName" placeholder="Nama Supplier" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Barang</label>
                    <div class="col-sm-10">
                        <select name="jenis_barang" class="form-controls-select">
                          <option value="">Pilih</option>
                          <option value="Barang Setengah Jadi">Barang Setengah Jadi</option>
                          <option value="Barang Jadi">Barang Jadi</option>
                          <option value="Barang Baku">Barang Baku</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="idbarang" value="0">
                        <input type="text" class="form-controls" name="nama_barang" id="nama_barang" placeholder="Nama Barang">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jumlah Barang</label>
                    <div class="col-sm-10">
                        <input type="number" id="jumlah_barang" onkeyup="total();" name="jumlah" class="form-controls" placeholder="Jumlah Barang" required>
                        <input type="text" id="jml_brg" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Satuan</label>
                    <div class="col-sm-10">
                        <select name="satuan" class="form-controls-select">
                          <option value="">Pilih</option>
                          <option value="Kg">Kg</option>
                          <option value="Ton">Ton</option>
                          <option value="Sack">Sack</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Harga Satuan</label>
                    <div class="col-sm-10">
                        <input type="number" id="harga_satuan" onkeyup="total();" name="harga_barang" class="form-controls" id="inputName" placeholder="Harga Satuan Barang" required>
                        <input type="text" id="hrg_brg" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Diskon Pembelian</label>
                    <div class="col-sm-10">
                        <input type="number" id="diskon" onkeyup="total();" name="diskon" class="form-controls" id="inputName" placeholder="Diskon Pembelian" value="0" required>
                        <input type="text" id="dsk" value="" class="span-block" readonly>
                    </div>
                </div>
                <form>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <input type="number" id="biaya_lain" onkeyup="total();" name="harga_lainnya" class="form-controls" id="inputName" placeholder="Harga Lain-lain" value="0" required>
                        <input type="text" id="hrg_lain" value="" class="span-block" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Keterangan Biaya Lain-lain</label>
                    <div class="col-sm-10">
                        <textarea name="notes_harga_lainnya" id="" cols="10" rows="5" placeholder="Keterangan Biaya Lain-lain" class="form-controls"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Bukti Transaksi</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-controls" name="photo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Total Nilai Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" id="total" class="form-controls" id="inputName" placeholder="Total Nilai Transaksi" readonly required>
                        <input type="hidden" id="ttl_hrg" name="total_harga" class="span-block" readonly>
                    </div>
                </div>
                </form>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Jenis Pembayaran</label>
                    <div class="col-sm-10">
                        <select name="tipe_pembayaran" class="form-controls-select" onchange="show_value(this.value)" required>
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
                        var harga_satuan = parseInt($("#harga_satuan").val())
                        var diskon = parseInt($("#diskon").val())
                        var biaya_lain = parseInt($("#biaya_lain").val())
                        var cash = parseInt($("#cash").val())
                        
                        var total = ((jumlah_barang * harga_satuan) - diskon) + biaya_lain;
                        $("#ttl_hrg").attr("value",total);

                        var ttl_hrg = formatRupiah($("#ttl_hrg").val())
                        $("#total").attr("value","Rp "+ttl_hrg);

                        if (cash>total) {
                            alert('Nilai Cash tidak boleh melebihi Total Nilai Transaksi!');
                        }else{
                            var sisa_kredit = total - cash;
                        }

                        var jml = formatRupiah($("#jumlah_barang").val());
                        var hrg = formatRupiah($("#harga_satuan").val());
                        var dsk = formatRupiah($("#diskon").val());
                        var hrg_lain = formatRupiah($("#biaya_lain").val());
                        var csh = formatRupiah($("#cash").val());

                        $("#jml_brg").attr("value",jml);
                        $("#hrg_brg").attr("value","Rp "+hrg);
                        $("#dsk").attr("value","Rp. "+dsk);
                        $("#hrg_lain").attr("value","Rp "+hrg_lain);
                        $("#csh").attr("value","Rp. "+csh);
                        $("#ss_krdt").attr("value",sisa_kredit);

                        var ss_krdt = formatRupiah($("#ss_krdt").val());
                        $("#sisa_kredit").attr("value","Rp. "+ss_krdt);

                    });
                    var x = document.getElementById("formck");
                    function show_value(val){
                        if (val=='Cash dan Kredit') {
                            x.style.display = "block";
                        }else{
                            x.style.display = "none";
                        }
                    }
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