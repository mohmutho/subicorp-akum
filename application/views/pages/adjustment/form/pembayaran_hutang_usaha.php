<?php
$id = "";
$hutang_id = "";
$nilai_bayar = "";
$nilai_bayar2 = "";
$tanggal = "";
$foto_bukti = "";
$keterangan = "";
$nilai_hutang = "";
$nilai_hutang2 = "";
if ($main['op']=='edit') {
    foreach ($main['sql3']->result() as $obj) {
        $op = "edit";
        $id = $obj->id;
        $hutang_id = $obj->hutang_id;
        $nilai_bayar = number_format($obj->nilai_bayar,0,'','.');
        $nilai_bayar2 = $obj->nilai_bayar;
        $tanggal = $obj->tanggal;
        $foto_bukti = $obj->foto_bukti;
        $keterangan = $obj->keterangan;
    }
    $query = $this->db->query("SELECT * FROM hutang where id = '$id'");
    foreach ($query->result() as $val) {
        $nilai_hutang = number_format($val->nilai_hutang,0,'','.');
        $nilai_hutang2 = $val->nilai_hutang;
    }
}
?>
<!-- Form Adjustment Pembayaran Hutang Usaha -->
<div class="row">
  <div class="col-sm-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Pembayaran Hutang Usaha
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url("dashboard")?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Adjustment</li>
          <li class="active">Pembayaran Hutang Usaha</li>
        </ol><br>
        <?php echo $this->session->flashdata('notif')?>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body form-horizontal">
                <?php echo form_open_multipart('adjustment/create_pembayaran_hutang_usaha/');?>
                <input type="hidden" name="op" value="<?php echo $main['op'];?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="autoSum">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Pilih Hutang</label>
                        <div class="col-sm-10">
                            <select id="pilih_hutang" name="hutang_id" class="form-controls-select" onchange='changeValue(this.value)' required>
                            <option value="">Pilih</option>
                                <?php
                                    $jsArray = "var prdName = new Array();\n";
                                    foreach($main['sql']->result() as $obj){
                                        $nhutang = $obj->nilai_hutang;
                                ?>
                                <option value="<?php echo $obj->id;?>" <?php if($hutang_id==$obj->id) echo 'selected';?>>
                                    <?php echo $obj->nama_hutang;?>
                                </option>
                                <?php
                                    $jsArray .= "prdName['". $obj->id . "'] = {nilai_hutang:'" . addslashes('Rp. '.number_format($nhutang,0, '', '.')) . "',nhutang:'" . addslashes($nhutang) . "'};\n";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                        foreach ($main['sql2']->result() as $obj) {
                            $saldo_kas = $obj->saldo_kas;
                    ?>
                        <input type="hidden" name="saldo_kas" id="saldo_kas" value="<?php echo $saldo_kas;?>">
                    <?php
                        }
                    ?>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nilai Hutang</label>
                        <div class="col-sm-10">
                            <input readonly type="text" name="nilai_hutang" id="nilai_hutang" class="form-controls" value="Rp. <?php echo $nilai_hutang;?>" placeholder="Nilai Hutang" required>
                            <input type="hidden" name="nhutang" id="nhutang" class="form-controls" value="<?php echo $nilai_hutang2;?>" placeholder="Nilai Hutang" required>
                        </div>
                    </div>
                    <script type="text/javascript">    
                        <?php echo $jsArray; ?>  
                        function changeValue(x){  
                            document.getElementById('nilai_hutang').value = prdName[x].nilai_hutang;   
                            document.getElementById('nhutang').value = prdName[x].nhutang;   
                        };
                    </script>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nilai Yang Dibayarkan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controls" name="nilai_bayar" id="nilai_bayar" placeholder="Nilai Yang Dibayarkan" value="<?php echo $nilai_bayar2;?>" required>
                            <input type="text" id="nl_byr" class="span-block" value="Rp. <?php echo $nilai_bayar;?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Tanggal Dibayarkan</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal" class="form-controls" id="datepicker" placeholder="Tanggal Dibayarkan" value="<?php echo $tanggal;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Bukti Transaksi</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-controls" name="photo" <?php if($main['op']=='tambah') echo 'required';?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="" cols="10" rows="5" placeholder="Keterangan Biaya Lain-lain" class="form-controls"><?php echo $keterangan;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="<?php echo site_url('adjustment/pembayaran_hutang_usaha');?>" class="btn btn-default">Kembali</a>
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