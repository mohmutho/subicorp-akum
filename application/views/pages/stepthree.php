<div class="row">
  <div class="col-sm-12">
    <div class="stepone-page-left">
      <section class="content-header">
        <h1>
          STEP 3
        </h1>
        <p>Masukan Data Piutang Lainnya Anda saat ini : </p>
      </section>

      <section class="content">
        <?php echo $this->session->flashdata('notif')?>
        <div class="box">
          <div class="box-header">
            <div class="box-title"><a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-akumm"><i class="fa fa-plus"></i> Tambah Piutang Lainnya</a></div>
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                    <th>Jenis Piutang</th>
                    <th>Nama Piutang</th>
                    <th>Nilai Piutang</th>
                    <th>Tanggal Transaksi</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
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
                      <td><?php echo $obj->jenis_piutang;?></td>
                      <td><?php echo $obj->nama_piutang;?></td>
                      <td>Rp. <?php echo number_format($obj->nilai_piutang,0, '', '.');?></td>
                      <td><?php echo date('d M Y', strtotime($obj->tanggal_transaksi));?></td>
                      <td><?php echo date('d M Y', strtotime($obj->tanggal_jatuh_tempo));?></td>
                      <td><?php echo $obj->keterangan;?></td>
                      <td><?php echo $obj->status;?></td>
                      <td>
                        <a class="btn btn-xs btn-info" href="#" data-toggle="modal" data-target="#myModalEdit<?php echo $obj->id;?>"><i class='fa fa-edit'></i></a>
                        <a  class="btn btn-xs btn-danger" href="#" data-toggle="modal" data-target="#myModalDelete<?php echo $obj->id;?>"><i class='fa fa-close'></i></a>
                      </td>
                  </tr>
                <?php
                    }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="align-right">
          <a href="<?php echo base_url();?>steptwo" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
          <a href="<?php echo base_url();?>stepfour" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></a>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('stepthree/create/');?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Piutang Lainnya</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Piutang Lainnya</label>
            <input type="text" placeholder="Nama PT/CV/Toko dan lainnya" name="nama_piutang" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Nilai Piutang</label>
            <input type="text" placeholder="Nilai Piutang" name="nilai_piutang" id="nilai_piutang" required>
            <input type="text" id="nl_piutang" value="Rp 0" class="span-block" readonly>
          </div>
        </div><br>
        <div class="row">
          <div class="col-sm-12">
            <label>Tanggal Transaksi</label>
            <input type="text" name="tanggal_transaksi" id="datepicker" placeholder="Tanggal Transaksi" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Tanggal Jatuh Tempo</label>
            <input type="text" name="tanggal_jatuh_tempo" id="datepicker2" placeholder="Tanggal Jatuh Tempo" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Bukti Transaksi</label>
            <input type="file" name="bukti_transaksi" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Keterangan</label>
            <textarea name="keterangan" cols="20" rows="5" placeholder="Keterangan"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-akumm">Simpan</button>
      </div>
    <?php echo form_close();?>
    </div>
  </div>
</div>

<?php
    $no=0;
    foreach ($main['sql']->result() as $obj2)
    {
      $nama_piutang = $obj2->nama_piutang;
      $nilai_piutang = $obj2->nilai_piutang;
      $tanggal_transaksi = $obj2->tanggal_transaksi;
      $tanggal = date('Y-m-d', strtotime($tanggal_transaksi));
      $tanggal_jatuh_tempo = $obj2->tanggal_jatuh_tempo;
      $tanggal2 = date('Y-m-d', strtotime($tanggal_jatuh_tempo));
      $bukti_transaksi = $obj2->bukti_transaksi;
      $keterangan = $obj2->keterangan;
?>
<!-- Modal Edit -->
<div class="modal fade" id="myModalEdit<?php echo $obj2->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('stepthree/edit/');?>
    <input type="hidden" name="id" value="<?php echo $obj2->id;?>">
    <input type="hidden" name="iduser" value="<?php echo $obj2->iduser;?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Piutang Lainnya</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Piutang Lainnya</label>
            <input type="text" placeholder="Nama PT/CV/Toko dan lainnya" name="nama_piutang" value="<?php echo $nama_piutang;?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Nilai Piutang</label>
            <input type="text" placeholder="Rp" name="nilai_piutang" id="nilai_piutang2<?php echo $obj2->id;?>" value="<?php echo $nilai_piutang;?>" required>
            <input type="text" id="nl_piutang_edit<?php echo $obj2->id;?>" value="Rp. <?php echo number_format($nilai_piutang,0,'','.');?>" class="span-block" readonly>
          </div>
        </div><br>
        <div class="row">
          <div class="col-sm-12">
            <label>Tanggal Transaksi</label>
            <input type="text" name="tanggal_transaksi" id="datepicker3<?php echo $obj2->id;?>" value="<?php echo $tanggal;?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Tanggal Jatuh Tempo</label>
            <input type="text" name="tanggal_jatuh_tempo" id="datepicker4<?php echo $obj2->id;?>" value="<?php echo $tanggal2;?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Bukti Transaksi</label>
            <input type="file" name="bukti_transaksi">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Keterangan</label>
            <textarea name="keterangan" cols="20" rows="5" placeholder="Keterangan"><?php echo $keterangan;?></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-akumm">Ubah</button>
      </div>
    <?php echo form_close();?>
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $('#datepicker3<?php echo $obj2->id;?>').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
  });
  $('#datepicker4<?php echo $obj2->id;?>').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true
  });

  var tanpa_rupiah2 = document.getElementById('nilai_piutang2<?php echo $obj2->id;?>');
  tanpa_rupiah2.addEventListener('keyup', function(e)
  {
    var nl_piutang_edit = formatRupiah(this.value);
    $("#nl_piutang_edit<?php echo $obj2->id;?>").attr("value","Rp. "+nl_piutang_edit);
  });
</script>
<?php
  }
?>

<!-- Modal Delete -->
<?php
    $no=0;
    foreach ($main['sql']->result() as $obj3)
    {
?>
<div class="modal fade" id="myModalDelete<?php echo $obj3->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('stepthree/delete/');?>
    <input type="hidden" name="id" value="<?php echo $obj3->id;?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-akumm">Iya</button>
      </div>
    <?php echo form_close();?>
    </div>
  </div>
</div>
<?php
  }
?>

<script type="text/javascript">

  /* Tanpa Rupiah */
  var tanpa_rupiah = document.getElementById('nilai_piutang');
  tanpa_rupiah.addEventListener('keyup', function(e)
  {
    var nl_piutang = formatRupiah(this.value);
    $("#nl_piutang").attr("value","Rp. "+nl_piutang);
  });
  
  /* Fungsi */
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