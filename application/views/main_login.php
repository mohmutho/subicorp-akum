<html lang="en">
<head>
    <title><?php echo $main['title']; ?></title>
    <?php $this->load->view('layouts/head') ?>
</head>
<body>

    <!-- pages -->
    <?php echo $main['pages']; ?>
    <!-- END pages -->

    <!-- javascript -->
    <?php $this->load->view('layouts/javascript')?>
    <!-- END javascript -->
</body>
</html>