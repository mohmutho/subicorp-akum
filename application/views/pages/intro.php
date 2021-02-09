<div class="intro-page">
  <div class="row">
    <div class="col-sm-6">
      <div class="intro-page-left">
        <section class="content-header">
          <h1>
            Selamat Datang, <span class="hidden-xs"><?php echo $this->session->userdata('nama') ?></span>
          </h1>
        </section>

        <section class="content">
          <p>Sebelum melanjutkan menggunakan aplikasi ini, Anda diminta untuk mengisi data <b>Opening Balance</b> terlebih dahulu. <br><br> Apabila Anda sudah siap, mari kita mulai dengan klik tombol <b>Mulai</b>.</p>
          <div align="center">
            <a href="<?php echo base_url();?>stepone" class="btn btn-lg btn-akumm" style="margin-top: 1rem;"><b>Mulai</b></a>
          </div>
        </section>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="intro-page-right">
        <div class="row">
          <div class="col-sm-6">
            <section class="content-header">
              <h1 align="center">
                Pencatatan
              </h1>
            </section>
            <section class="content">
              <img src="<?php echo base_url();?>assets/images/icon_pencatatan.png"><br>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </section>
          </div>
          <div class="col-sm-6">
            <section class="content-header">
              <h1 align="center">
                Pemantauan
              </h1>
            </section>
            <section class="content">
              <img src="<?php echo base_url();?>assets/images/icon_pemantauan.png"><br>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <!-- <div class="align-right">
                <a href="<?php echo base_url();?>stepone" class="btn btn-akumm"><b>Mulai</b></a>
              </div> -->
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>