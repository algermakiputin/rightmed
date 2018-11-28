<!DOCTYPE html>
<html>

<head>
	<title>R. E. D.</title>

	<link rel='stylesheet' href='<?php echo base_url() ?>includes/css/bootstrap.min.css'>
	<link rel='stylesheet' href='<?php echo base_url() ?>includes/font/font-awesome/css/font-awesome.css'>

    <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/default.css'>
    
    <script src='<?php echo base_url() ?>includes/js/jquery-3.3.1.min.js'></script>
    <script src='<?php echo base_url() ?>includes/js/jquery-ui.min.js'></script>
    <script src='<?php echo base_url() ?>includes/js/popper.js'></script>
    <script src='<?php echo base_url() ?>includes/js/bootstrap.min.js'></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>includes/others/css/core-style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>includes/others/style.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>includes/others/css/responsive.css">
    <meta name="base_url" content="<?php echo base_url() ?>">
    </style>
</head>

<body>
<!-- Preloader -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area">
         
        <!-- Main Header Area -->
        <div class="main-header-area" id="stickyHeader">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 h-100">
                        <div class="main-menu h-100">
                            <nav class="navbar h-100 navbar-expand-lg">
                                <!-- Logo Area  -->
                                <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>includes/others/img/core-img/logo.png" alt="Logo" style="height: 80px; padding: 0 20px;"></a>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#medicaMenu" aria-controls="medicaMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i> Menu</button>

                                <div class="collapse navbar-collapse" id="medicaMenu">
                                    <!-- Menu Area -->
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item <?php echo $home ?>">
                                            <a class="nav-link" href="#home">Home</a>
                                        </li>
                                        <li class="nav-item <?php echo $login ?>">
                                            <a class="nav-link" href="#contact-us">Contact Us</a>
                                        </li>
                                        <li class="nav-item <?php echo $register ?>">
                                            <a class="nav-link" href="#services">Services</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
