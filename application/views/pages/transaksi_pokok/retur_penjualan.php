<!-- Retur Penjualan -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Retur Penjualan
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li>Retur</li>
          <li class="active">Retur Penjualan</li>
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
            <?php echo form_open_multipart('retur/create_retur_penjualan/');?>
                <div class="autoSum">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal" class="form-controls" id="datepicker" placeholder="Tanggal Transaksi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama Transaksi</label>
                        <div class="col-sm-10">
                            <select id="pilih_retur" name="penjualan_id" class="form-controls-select" onchange='changeValue(this.value)' required>
                            <option value="">Pilih</option>
                                <?php
                                    $jsArray = "var prdName = new Array();\n";
                                    foreach($main['sql']->result() as $obj){
                                        $penjualanke = $obj->penjualanke;
                                        $jumlah = $obj->jumlah;
                                        $nama_barang = $obj->nama_barang;
                                        $total_harga = $obj->total_harga;
                                ?>
                                <option value="<?php echo $obj->id;?>">
                                    <?php echo $penjualanke;?>
                                </option>
                                <?php
                                    $jsArray .= "prdName['". $obj->id . "'] = {jumlah:'" . addslashes($jumlah) . "',nama_barang:'" . addslashes($nama_barang) . "',total_harga:'" . addslashes($total_harga) . "',penjualanke:'" . addslashes($penjualanke) . "'};\n";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input readonly type="text" name="nama_barang" id="nama_barang" class="form-controls" placeholder="Nama Barang" required>
                            <input readonly type="hidden" name="total_harga" id="total_harga" class="form-controls" placeholder="Nama Barang" required>
                            <input readonly type="hidden" name="penjualanke" id="penjualanke" class="form-controls" placeholder="Nama Barang" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Jumlah Barang</label>
                        <div class="col-sm-10">
                            <input readonly type="text" id="jumlah" class="form-controls" placeholder="Jumlah Barang" required>
                        </div>
                    </div>
                    <script type="text/javascript">    
                        <?php echo $jsArray; ?>  
                        function changeValue(x){  
                            document.getElementById('nama_barang').value = prdName[x].nama_barang;
                            document.getElementById('jumlah').value = prdName[x].jumlah;
                            document.getElementById('total_harga').value = prdName[x].total_harga;
                            document.getElementById('penjualanke').value = prdName[x].penjualanke;
                        };
                    </script>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Jumlah Barang Diretur</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah_retur" class="form-controls" id="jumlah_retur" placeholder="Jumlah Barang Diretur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Bukti Transaksi</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-controls" name="photo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="" cols="10" rows="5" placeholder="Keterangan Biaya Lain-lain" class="form-controls"></textarea>
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
                            var jumlah_barang = parseInt($("#jumlah").val())
                            var jumlah_retur = parseInt($("#jumlah_retur").val())

                            if(jumlah_retur>jumlah_barang){
                                alert('Jumlah retur melebihi jumlah barang yang dijual.');
                            }
                        });
                    </script>
                </div>
            <?php echo form_close();?>
            </div>
        </div>
    </section>
  </div>
</div>