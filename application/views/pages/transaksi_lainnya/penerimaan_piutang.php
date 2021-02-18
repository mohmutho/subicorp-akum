<!-- Penerimaan Piutang -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Penerimaan Piutang
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Penerimaan Piutang</li>
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
            <?php echo form_open_multipart('transaksi_lainnya/create_transaksi_lainnya_penerimaan_piutang/');?>
                <div class="autoSum">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Pilih Piutang</label>
                        <div class="col-sm-10">
                            <select id="pilih_piutang" name="piutang_id" class="form-controls-select" onchange='changeValue(this.value)' required>
                            <option value="">Pilih</option>
                                <?php
                                    $jsArray = "var prdName = new Array();\n";
                                    foreach($main['sql']->result() as $obj){
                                        $npiutang = $obj->nilai_piutang;
                                ?>
                                <option value="<?php echo $obj->id;?>">
                                    <?php echo $obj->nama_piutang;?>
                                </option>
                                <?php
                                    $jsArray .= "prdName['". $obj->id . "'] = {nilai_piutang:'" . addslashes('Rp. '.number_format($npiutang,0, '', '.')) . "',npiutang:'" . addslashes($npiutang) . "'};\n";
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
                        <label for="inputName" class="col-sm-2 control-label">Nilai Piutang</label>
                        <div class="col-sm-10">
                            <input readonly type="text" name="nilai_piutang" id="nilai_piutang" class="form-controls" placeholder="Nilai Piutang" required>
                            <input type="hidden" name="npiutang" id="npiutang" class="form-controls" placeholder="Nilai Piutang" required>
                        </div>
                    </div>
                    <script type="text/javascript">    
                        <?php echo $jsArray; ?>  
                        function changeValue(x){  
                            document.getElementById('nilai_piutang').value = prdName[x].nilai_piutang;   
                            document.getElementById('npiutang').value = prdName[x].npiutang;   
                        };
                    </script>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nilai Yang Diterima</label>
                        <div class="col-sm-10">
                            <input type="text" name="nilai_bayar" id="nilai_bayar" class="form-controls" placeholder="Nilai Yang Diterima" required>
                            <input type="text" id="nl_byr" value="" class="span-block" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Diterima</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal" class="form-controls" id="datepicker" placeholder="Tanggal Diterima" required>
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
                            var saldo_kas = parseInt($("#saldo_kas").val())
                            var nilai_bayar = parseInt($("#nilai_bayar").val())

                            if(nilai_bayar>saldo_kas){
                                alert('Saldo Kas tidak mencukupi.');
                            }

                            var nl_byr = formatRupiah($("#nilai_bayar").val());
                            $("#nl_byr").attr("value","Rp. "+nl_byr);
                        });
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