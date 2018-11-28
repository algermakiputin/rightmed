<!DOCTYPE html>
<html>
    <head>
        <title><?php echo ucfirst($this->session->usertype) . ' - ' ?>Project</title>
        
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/bootstrap.min.css'>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/font/font-awesome/css/font-awesome.css'>
        <meta name="base_url" content="<?php echo base_url() ?>">
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/default.css'>
 
        <?php
            if (isset($style))
                echo "<link rel='stylesheet' href='" . base_url() . "includes/css/$style.css'>";
        ?>

        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/theme/cs-skin-elastic.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/theme/flag-icon.min.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/theme/normalize.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/theme/style.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/theme/themify-icons.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/theme/open_sans.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/others/style.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/vendor/bootstrap-slider/slider.css'>
        <script src='<?php echo base_url() ?>includes/js/jquery-3.3.1.min.js'></script>
        <script src='<?php echo base_url() ?>includes/js/jquery-ui.min.js'></script>
        <script src='<?php echo base_url() ?>includes/js/popper.min.js'></script>
        <script src='<?php echo base_url() ?>includes/js/bootstrap.min.js'></script>
        
        <script src='<?php echo base_url() ?>includes/js/theme/main.js'></script>
        <script src='<?php echo base_url() ?>includes/js/theme/plugins.js'></script>

   
    </head>

    <body>
