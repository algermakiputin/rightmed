<!DOCTYPE html>
<html>
    <head>
        <title><?php echo ucfirst($this->session->usertype) . ' - ' ?>Project</title>
        
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/css/bootstrap.min.css'>
        <link rel='stylesheet' href='<?php echo base_url() ?>includes/font/font-awesome/css/font-awesome.css'>
        
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
        
        <script src='<?php echo base_url() ?>includes/js/jquery-3.3.1.min.js'></script>
        <script src='<?php echo base_url() ?>includes/js/jquery-ui.min.js'></script>
        <script src='<?php echo base_url() ?>includes/js/popper.min.js'></script>
        <script src='<?php echo base_url() ?>includes/js/bootstrap.min.js'></script>
        
        <script src='<?php echo base_url() ?>includes/js/theme/main.js'></script>
        <script src='<?php echo base_url() ?>includes/js/theme/plugins.js'></script>

        <style type="text/css" media="print">

            table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }

            @media print {
                .myDivToPrint {
                    background-color: white;
                    height: 100%;
                    width: 100%;
                    position: fixed;
                    top: 0;
                    left: 0;
                    margin: 0;
                    padding: 15px;
                    font-size: 14px;
                    line-height: 18px;
                }

                .dontprint {
                    display: none !important;
                }

                .print {
                    display: table-cell !important;
                }
            }

        </style>
    </head>

    <body>
