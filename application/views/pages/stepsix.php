<script src="<?php echo base_url("assets/js/jquery.min.js"); ?>" type="text/javascript"></script>
<!-- Activa Tetap -->
<div class="row">
  <div class="col-sm-12">
    <div class="stepone-page-left">
      <section class="content-header">
        <h1>
          STEP 6
        </h1>
        <p>Masukan Data Aktiva tetap Anda saat ini : </p>
      </section>

      <section class="content">
        <?php echo $this->session->flashdata('notif')?>
        <div class="box">
          <div class="box-header">
            <div class="box-title"><a href="<?php echo base_url();?>stepsix/form" class="btn btn-akumm"><i class="fa fa-plus"></i> Tambah Aktiva Tetap</a></div>
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Jenis Aktiva</th>
                  <th>Nama Aktiva</th>
                  <th>Nilai Aktiva</th>
                  <th>Alamat</th>
                  <th>Nilai sisa Bangunan</th>
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
                      <td><?php echo $obj->jenis_activa;?></td>
                      <td><?php echo $obj->nama_activa;?></td>
                      <td>Rp. <?php echo number_format($obj->nilai_tanah+$obj->nilai_bangunan,0, '', '.');?></td>
                      <td><?php echo $obj->alamat;?></td>
                      <td>Rp. <?php echo number_format($obj->harga_sisa,0, '', '.');?></td>
                      <td>
                        <a class="btn btn-xs btn-info" href="<?php echo base_url();?>stepsix/form_edit/<?php echo $obj->id;?>"><i class='fa fa-edit'></i></a>
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
          <a href="<?php echo base_url();?>stepfive" class="btn btn-akumm"><i class="fa fa-angle-left"></i> Back</a>
          <a href="<?php echo base_url();?>stepseven" class="btn btn-akumm">Next <i class="fa fa-angle-right"></i></a>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<?php
    $no=0;
    foreach ($main['sql']->result() as $obj3)
    {
?>
<div class="modal fade" id="myModalDelete<?php echo $obj3->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('stepsix/delete/');?>
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