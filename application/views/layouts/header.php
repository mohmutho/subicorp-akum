<header class="main-header">

  <!-- Logo -->
  <a href="<?php echo site_url("dashboard")?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
        <b>OP</b>
        <!-- <img src="<?php echo base_url();?>assets/images/logo.png"> -->
    </span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
        <!-- <img src="<?php echo base_url();?>assets/images/logo.png"> -->
        <b>Opening</b> Balance
    </span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a> -->
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
            <i class="fa fa-user"></i>
            <span class="hidden-xs"><?php echo $this->session->userdata('nama') ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <p>
                <?php echo $this->session->userdata('nama') ?>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-right">
                <a href="<?php echo site_url('main/keluar')?>" class="btn btn-akumm">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>

  </nav>
</header>