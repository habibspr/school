

<!DOCTYPE html>
<html lang="en">
    <?php ob_start(); // redirecting header localtion ?> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
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
        <link href="../../dist/less/datepicker.less" rel="stylesheet">
    </head>
       <style type="text/css">
            .header_area {
                background-color:darkgreen;
                overflow: hidden;
                color: white;
            }
            
            @page {
                margin-left:.5 in;
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
            <div class="header_area" >
                <?php include '../company_name.php';?>
            </div>
        
         <!-- database connection -->
        <?php include "../resources/db_aags_n.php" ;?>
        <?php include "../resources/dbo_aags_n.php" ;?>
        <?php include "../global.php" ;?>
        
        <!-- Bootstrap core JavaScript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../../dist/js/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        