<?php include "header.php";?>
 <?php 
    if(empty($global_User)){    
        include_once "../authority_login.php";    
    }else{
    ?>
<?php include 'nav-bar.php';?>

<div class="container">
   
    <div class="row">
    
    <hr>
    
    <div class="row">
        <div class="col-md-6">
            <div class = "panel panel-primary">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Notice</h3>
                </div>
                <div class = "panel-body">
                    This is a Notice primary
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class = "panel panel-success">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Panel title</h3>
                </div>
                <div class = "panel-body">
                    This is a Basic success
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class = "panel panel-info">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Panel title</h3>
                </div>
                <div class = "panel-body">
                    This is a Basic info
                </div>
            </div>
        </div>
        <div class="col-md-6">        
            <div class = "panel panel-warning">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Panel title</h3>
                </div>
                <div class = "panel-body">
                    This is a Basic warning
                </div>
            </div>
        </div>
        <div class="col-md-6">        
            <div class = "panel panel-danger">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Panel title</h3>
                </div>
                <div class = "panel-body">
                    This is a Basic danger
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</div>
<?php include "footer.php";?>
