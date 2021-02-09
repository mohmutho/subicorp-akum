<html lang="en">
<head>
    <title><?php echo $main['title']; ?></title>
    <?php $this->load->view('layouts/head') ?>
</head>
<body id="top" class="hold-transition sidebar-mini skin-green-light">

<div class="wrapper">

    <!-- header -->
    <?php $this->load->view('layouts/header')?>
    <!-- END header -->

    <!-- sidebar -->
    <?php echo $main['sidebar']; ?>
    <!-- END sidebar -->

    <div class="content-wrapper">
        <!-- pages -->
        <?php echo $main['pages']; ?>
        <!-- END pages -->
    </div>
    
</div>

    <!-- javascript -->
    <?php $this->load->view('layouts/javascript')?>
    <!-- END javascript -->
</body>
</html>