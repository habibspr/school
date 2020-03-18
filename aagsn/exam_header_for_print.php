<!DOCTYPE html>
<?php ob_start(); // redirecting header localtion ?>  

<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- database connection -->
        <?php include "../resources/db_aags_n.php" ;?>
        <?php include "../resources/dbo_aags_n.php" ;?>
        <?php include "../global.php" ;?>
        <?php date_default_timezone_set("Asia/Dhaka");?>
        <title>LyceumSystems</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>Static Top Navbar Example for Bootstrap</title>
        <!-- Bootstrap core CSS -->
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="navbar-static-top.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script type="text/javascript" src="/bootstrap-dropdown.js"></script>  <!-- for dropdown-->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="print">
        
        <!--select picker -->
        
        <script type="text/javascript" src="/dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/dist/js/bootstrap-select.js"></script>
        <script>
            $(document).ready(function () {
                var mySelect = $('#first-disabled2');
                $('#special').on('click', function () {
                    mySelect.find('option:selected').prop('disabled', true);
                    mySelect.selectpicker('refresh');
                });
                $('#special2').on('click', function () {
                    mySelect.find('option:disabled').prop('disabled', false);
                    mySelect.selectpicker('refresh');
                });
                $('#basic2').selectpicker({
                    liveSearch: true,
                    maxOptions: 1
                });
            });
        </script>
       

<style type="text/css"> <!-- for printing -->
            @page {
                margin: .25 in;
                }
            @media only print{
                .container{
                    width: 100%;
                    }
                    .table-condensed > tbody > tr > td, 
                    .table-condensed > tbody > tr > th, 
                    .table-condensed > tfoot > tr > td, 
                    .table-condensed > tfoot > tr > th, 
                    .table-condensed > thead > tr > td, 
                    .table-condensed > thead > tr > th {
                    padding: 1px;
                    }
                    
                p.footnotes {
                    page-break-after: always;
                    text-align: center;
                    }
                }
        </style>
    </head>
    <body>
       
        
        