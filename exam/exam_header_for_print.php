<!DOCTYPE html>
<?php ob_start(); // redirecting header localtion ?>  

<html lang="en">
    <head>
        <!-- database connection -->
        <?php include "../resources/db_aags_n.php" ;?>
        <?php include "../resources/dbo_aags_n.php" ;?>
        <?php include "../global.php" ;?>
        
        <meta charset="UTF-8">
        <?php date_default_timezone_set("Asia/Dhaka");?>
        <title>LyceumSystems</title>
        <meta charset="utf-8">
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
        <script type="text/javascript" src="/bootstrap-dropdown.js" />  <!-- for dropdown-->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="print">
        
        
        <!--select picker -->
        <link rel="stylesheet" href="/dist/css/normalize.css">
        <link rel="stylesheet" href="/dist/css/bootstrap-select.css">
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
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body>
        <!-- Bootstrap core JavaScript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../../dist/js/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>