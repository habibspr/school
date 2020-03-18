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
        <script src="https://cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
        <script>
            webshims.setOptions('forms-ext', {types: 'date'});
            webshims.polyfill('forms forms-ext');            
        </script>
        
        
        
        <!-- database connection -->
        <?php include "../resources/db_aags_n.php" ;?>
        <?php include "../resources/dbo_aags_n.php" ;?>
        <?php include "../global.php" ;?>
        
        
    </head>
    <?php         
        $query = "SELECT * FROM company_info";
        $result = mysqli_query($link, $query);
        if($result = mysqli_query($link, $query)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $co_name=$row['co_name'];
                    $co_estd=$row['co_estd'];
                    $co_address=$row['co_address'];
                }
            }
        }
        ?>
    <div class="row">
        <div class="container-fluid" style="background-color:#154360; color:white">
            <div class="col-sm-2 text-center">
                <br><img src="../images/logo.png" alt="No Photo" width="50" height="50">               
            </div>
            <div class="col-sm-8">
                <h3 class="text-center"><strong><?php echo "$co_name";?></strong></h3>
                <h4 class="text-center"><strong><?php echo "$co_estd";?></strong></h4>
                <h6 class="text-center"><?php echo "$co_address";?></h6>
            </div>
            <div class="col-sm-2">
                <div class="clearfix">
                    <h4 class="text-center">
                        <?php 
                        if (empty($global_User)){
                            // do nothing
                        }else{
                        ?>
                        <span class="glyphicon glyphicon-user">
                            <?php echo $global_User;?>
                        </span>
                        <?php 
                        }
                        ?>
                    </h4>                        
                </div> 
            </div> 
        </div>
    </div>
        <!-- Bootstrap core JavaScript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../../dist/js/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
        