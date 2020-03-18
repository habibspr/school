<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<!DOCTYPE html>
<html lang="en">
    <?php ob_start(); // redirecting header localtion ?> 
    <head>
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
        <script type="text/javascript" src="../../assets/js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="../js/bootstrap-dropdown.js"></script>  <!-- for dropdown-->
        
        <!--select picker -->
        <link rel="stylesheet" href="dist/css/normalize.css">
        <link rel="stylesheet" href="dist/css/bootstrap-select.css">
        <script type="text/javascript" src="dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="dist/js/bootstrap-select.js"></script>
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
        
        
        <!-- date picker -->
        <script src="https://cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
        <script>
            webshims.setOptions('forms-ext', {types: 'date'});
            webshims.polyfill('forms forms-ext');            
        </script>
        
        
       
        
        <style type="text/css" media="print">
            @page
            {
                size: auto; /* auto is the initial value */
                margin: 5mm 0mm 0mm 0mm; /* TOP, RIGHT, BOTTOM, LEFT this affects the margin in the printer settings */
            }
            .page-number:after {             
                counter-increment: pages; 
                content: "Page - "counter(pages)""; 
            }        
            thead
            {
                display: table-header-group;
            }
            tfoot
            {
                display: table-footer-group;
            }
        </style>
        
        <style>
            congratulations {
                color:green;
            }
            sorry {
                color: crimson;
            }
        
            .contentlogin {
                max-width: 30em;
                margin: auto;
                align-content: center;    
            }        
        </style>
        
    </head>
        <style type="text/css">
            .header_area {
                background-color:darkgreen;
                overflow: auto;
                color: white;
                margin-bottom: 0px;
            }
        </style>
        <div class="row">
            <div class="header_area" >
                <?php include '../company_name.php';?>
                 
            </div>
        </div>
		
		 
        <!-- database connection -->
        <?php include "../resources/db_aags_w.php" ;?>
        <?php include "../resources/dbo_aags_w.php" ;?>
        <?php include "../global.php" ;?>
		
        <!-- Bootstrap core JavaScript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../../dist/js/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
        