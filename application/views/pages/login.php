<?php 
  if($message = $this->session->flashdata('msgError')){
    echo "<script>swal('Oooppsss....','".$message."','error');</script>";
  }else if($message = $this->session->flashdata('msgSuccess')){
    echo "<script>swal('Success','".$message."','success');</script>";
  }
?>
<div class="login-page">
  <div class="login-page-left">
    <div class="container">
      <img src="<?php echo base_url();?>assets/images/logo_akum.png" alt="No Image!!!">
      <h3>USER LOGIN</h3>
    <?php echo form_open('main/check_login')?>
      <div class="row">
        <div class="col-sm-5">
          <?php echo $this->session->flashdata('notif')?>
          <input type="text" placeholder="USERNAME" name="username" required>
        </div>
        <div class="col-sm-7"></div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <input type="password" placeholder="PASSWORD" name="password" required>
        </div>
        <div class="col-sm-7"></div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <h4 align="right">LUPA PASSWORD?</h4>
        </div>
        <div class="col-sm-7"></div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <button type="submit" name="login" class="btn btn-akum">LOGIN</button>
        </div>
        <div class="col-sm-7"></div>
      </div>
      <div class="create-akun">
        <div class="row">
          <div class="col-sm-5">
            <a href="#" data-toggle="modal" data-target="#myModal">
              <h4 align="center" class="black-text">CREATE AKUN</h4>
            </a>
          </div>
          <div class="col-sm-3"></div>
          <div class="col-sm-4">
            <p align="center" class="white-text"><strong>UMKM GO DIGITAL</strong></p>
          </div>
        </div>
      </div>
    <?php echo form_close()?>
    </div>
  </div>
  <div class="login-page-right"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open_multipart('main/create/');?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel" align="center">Register User</h4>
      </div>
      <div class="modal-body">
        <h4>Data Pribadi</h4>
        <div class="row">
          <div class="col-sm-12">
            <input type="text" placeholder="Nama Lengkap" name="nama" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <input type="email" placeholder="Email" name="email" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <input type="text" placeholder="Username" name="username" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <input type="password" placeholder="Password" name="password" required>
          </div>
        </div>
        <h4>Data Usaha</h4>
        <div class="row">
          <div class="col-sm-12">
            <input type="text" placeholder="Nama Usaha" name="nama_usaha" required>
          </div>
        </div>
        <h4>Jenis Usaha</h4>
        <label class="radio-inline">
          <input type="radio" name="jenis_usaha" id="inlineRadio1" value="PERDAGANGAN"> Perdagangan
        </label>
        <label class="radio-inline">
          <input type="radio" name="jenis_usaha" id="inlineRadio2" value="JASA"> Jasa
        </label>
        <label class="radio-inline">
          <input type="radio" name="jenis_usaha" id="inlineRadio3" value="MANUFAKTUR"> Manufaktur
        </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-akumm">Daftar</button>
      </div>
    </div>
  </div>
</div>