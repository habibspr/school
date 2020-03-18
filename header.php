

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
        <link rel="icon" href="favicon.ico">
        <title>Static Top Navbar Example for Bootstrap</title>
        <!-- Bootstrap core CSS -->
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
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
            .header_area {
                background-color:darkgreen;
                overflow: hidden;
                color: white;
            }
        </style>
        
    </head>
            <div class="header_area" >
                <?php include 'company_name.php';?>
            </div>
        
        <!-- Bootstrap core JavaScript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="dist/js/jquery.min.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>
        
        