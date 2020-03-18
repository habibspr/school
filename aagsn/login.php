<?php include "../resources/db_aags.php" ;?>
<?php include "../resources/dbo_aags.php" ;?>

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
            
        <!-- Bootstrap core CSS -->
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
        <link href="style.css" rel="stylesheet" media="screen">
        
        <!-- Custom styles for this template -->
        <link href="navbar-static-top.css" rel="stylesheet">
        
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script type="text/javascript" src="/bootstrap-dropdown.js">  <!-- for dropdown-->
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
        
<div class="container">
    <form name="form_login" method="get" action="login.php" role="form">
        <h2 align="center">Please Sign In</h2>
        <hr>
        <div class="col-sm-4"> </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="user_id" class="col-md-4 control-label">User Name: </label>
                    <div class="col-md-8">
                        <input class="form-control" id="user_id" type="text" name="user_id" value="" >
                    </div>
                </div>
            </div>
        </div>
        <div>
            <hr>
        </div>
        <div class="col-sm-4"> </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="password" class="col-md-4 control-label">Password: </label>
                    <div class="col-md-8">
                        <input class="form-control" id="password" type="password" name="password" value="" >
                    </div>
                </div>
            </div>
        </div>
        <div>
            <hr>
        </div>
        <div class="col-sm-6"> </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <div class="col-md-8">
                        <button type="submit" name="Submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Submit</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
                        
<?php
    if (isset($_REQUEST['Submit'])){        
        if($_REQUEST['user_id']=='' || $_REQUEST['password']==''){
?>
<div class="col-sm-4">
    <div class="alert alert-warning fade in">
        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
        <strong>Thanks!</strong> Field Must Filled .....
    </div>
</div>
        <?php }else{
            $result=mysqli_query($link,"SELECT * FROM user_info WHERE user_name= '".$_REQUEST['user_id']."' AND  user_password ='".$_REQUEST['password']."'");
            $num_rows=mysqli_num_rows($result);
            if($num_rows>0) {
                
                header ("location: atdn_attednance_report_today.php");
?>
    <?php }else{ ?>
    <div class="alert alert-danger fade in">
        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
        <strong>Thanks!</strong> Username or Password Incorrect .....
    </div>
            <?php }
        }
    }
?>
        
        
        
         <!-- Bootstrap core JavaScript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../../dist/js/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
<?php include "footer.php";?>