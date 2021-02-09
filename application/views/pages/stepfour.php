<div class="row">
  <div class="col-sm-12">
    <div class="stepone-page-left">
      <section class="content-header">
        <h1>
          STEP 4
        </h1>
        <p>Masukan Data Persediaan Dagangan Anda saat ini : </p>
      </section>

      <section class="content">
        <?php echo $this->session->flashdata('notif')?>
        <div class="box">
          <div class="box-header">
            <div class="box-title"><a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-akumm"><i class="fa fa-plus"></i> Tambah Persediaan Barang Dagangan</a></div>
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Jenis Persediaan</th>
                  <th>Nama Persediaan</th>
                  <th>Jumlah</th>
                  <th>Total Nilai Persediaan</th>
                  <th>Harga Rata-Rata</th>
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
                      <td><?php echo $obj->jenis_barang;?></td>
                      <td><?php echo $obj->nama_barang;?></td>
                      <td><?php echo number_format($obj->jumlah_barang,0, '', '.');?></td>
                      <td><?php echo number_format($obj->total_nilai_barang,0, '', '.');?></td>
                      <td><?php echo number_format($obj->total_nilai_barang / $obj->jumlah_barang,0, '', '.');?></td>
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
          <a href="<?php echo base_url();?>stepthree" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
          <a href="<?php echo base_url();?>stepfive" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></a>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('stepfour/create/');?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Persediaan Barang Dagangan</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Jenis Barang</label>
            <select name="jenis_barang" class="form-control" required>
              <option value="">Pilihan</option>
              <option value="Barang Baku">Barang Baku</option>
              <option value="Barang Jadi">Barang Jadi</option>
              <option value="Barang Setengah Jadi">Barang Setengah Jadi</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Barang</label>
            <input type="text" placeholder="Nama Barang" name="nama_barang" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Jumlah Barang</label>
            <input type="text" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" required>
            <input type="text" id="jml_brg" value="0" class="span-block" readonly>
          </div>
        </div><br>
        <div class="row">
          <div class="col-sm-12">
            <label>Satuan</label>
            <select name="satuan" class="form-control" required>
              <option value="">Pilihan</option>
              <option value="Kg">Kg</option>
              <option value="Sak">Sak</option>
              <option value="Pcs">Pcs</option>
              <option value="Paket">Paket</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Harga Satuan</label>
            <input type="text" name="harga_satuan" id="harga_satuan" placeholder="Harga Satuan" required>
            <input type="text" id="hrg_st" value="0" class="span-block" readonly>
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
      $nama_barang = $obj2->nama_barang;
      $jenis_barang = $obj2->jenis_barang;
      $jumlah_barang = $obj2->jumlah_barang;
      $satuan = $obj2->satuan;
      $harga_satuan = $obj2->harga_satuan;
?>
<!-- Modal Edit -->
<div class="modal fade" id="myModalEdit<?php echo $obj2->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('stepfour/edit/');?>
    <input type="hidden" name="id" value="<?php echo $obj2->id;?>">
    <input type="hidden" name="iduser" value="<?php echo $obj2->iduser;?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Piutang Lainnya</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Jenis Barang</label>
            <select name="jenis_barang" class="form-control" required>
              <option value="">Pilihan</option>
              <option value="Barang Baku" <?php if($jenis_barang=="Barang Baku") echo 'selected'?>>Barang Baku</option>
              <option value="Barang Jadi" <?php if($jenis_barang=="Barang Jadi") echo 'selected'?>>Barang Jadi</option>
              <option value="Barang Setengah Jadi" <?php if($jenis_barang=="Barang Setengah Jadi") echo 'selected'?>>Barang Setengah Jadi</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Barang</label>
            <input type="text" placeholder="Nama Barang" name="nama_barang" value="<?php echo $nama_barang;?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Jumlah Barang</label>
            <input type="text" name="jumlah_barang" placeholder="Jumlah Barang" id="jumlah_barang<?php echo $obj2->id;?>" value="<?php echo $jumlah_barang;?>" required>
            <input type="text" id="jml_brg<?php echo $obj2->id;?>" value="<?php echo number_format($jumlah_barang,0,'','.');?>" class="span-block" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Satuan</label>
            <select name="satuan" class="form-control" required>
              <option value="">Pilihan</option>
              <option value="Kg" <?php if($satuan=="Kg") echo 'selected'?>>Kg</option>
              <option value="Sak" <?php if($satuan=="Sak") echo 'selected'?>>Sak</option>
              <option value="Pcs" <?php if($satuan=="Pcs") echo 'selected'?>>Pcs</option>
              <option value="Paket" <?php if($satuan=="Paket") echo 'selected'?>>Paket</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Harga Satuan</label>
            <input type="text" name="harga_satuan" placeholder="Harga Satuan" id="harga_satuan<?php echo $obj2->id;?>" value="<?php echo $harga_satuan;?>" required>
            <input type="text" id="hrg_st<?php echo $obj2->id;?>" value="<?php echo number_format($harga_satuan,0,'','.');?>" class="span-block" readonly>
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
<script type="text/javascript">
  var tanpa_rupiah2 = document.getElementById('jumlah_barang<?php echo $obj2->id;?>');
  tanpa_rupiah2.addEventListener('keyup', function(e)
  {
    var jml_brg = formatRupiah(this.value);
    $("#jml_brg<?php echo $obj2->id;?>").attr("value",jml_brg);
  });
  var tanpa_rupiah3 = document.getElementById('harga_satuan<?php echo $obj2->id;?>');
  tanpa_rupiah3.addEventListener('keyup', function(e)
  {
    var hrg_st = formatRupiah(this.value);
    $("#hrg_st<?php echo $obj2->id;?>").attr("value",hrg_st);
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
    <?php echo form_open_multipart('stepfour/delete/');?>
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
  var tanpa_rupiah = document.getElementById('jumlah_barang');
  tanpa_rupiah.addEventListener('keyup', function(e)
  {
    var jml_brg = formatRupiah(this.value);
    $("#jml_brg").attr("value",jml_brg);
  });
  var tanpa_rupiah2 = document.getElementById('harga_satuan');
  tanpa_rupiah2.addEventListener('keyup', function(e)
  {
    var hrg_st = formatRupiah(this.value);
    $("#hrg_st").attr("value",hrg_st);
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