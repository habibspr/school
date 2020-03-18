
<!-- database connection -->
<?php include "resources/db_aags_w.php" ;?>
<?php include "resources/dbo_aags_w.php" ;?>
<?php include "global.php" ;?>

<?php 
    if (session_status() == PHP_SESSION_NONE) {
		session_start();
		}
		?>


<?php         
$query = "SELECT * FROM company_info";
$result = mysqli_query($link, $query);
if($result = mysqli_query($link, $query)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $co_name=$row['co_name'];
            $co_estd=$row['co_estd'];
            $co_address=$row['co_address'];
            $co_eiin=$row['co_code1'];
            $co_code=$row['co_code2'];
        }
    }
	mysqli_close($link);
}
?>
<style>
@media print {
    a[href]:after {
        display: none;
        visibility: hidden;
        }
        #user_show{
            display:none;
        }
        #c_moto{
            font-size:8px;
        }
        #header_line{
            position: absolute;
            overflow: hidden;
            margin-top:-10px;
            color:darkgreen !important;
            display:block;
            width:100%;
        }
}


button {
  background-color: transparent;
}



</style>
    <div class="col-xs-12 col-sm-2 text-center" style="margin-top:10px;">
        <img src="../images/logo.png" alt="Cinque Terre" height="70px">
        <br><p class= "text-center" id="c_moto">The future begins here.</p>                
    </div>
    <div class="col-xs-12 col-sm-8 text-center">
        <h3><?php echo "$co_name";?></h3>
        <p><strong><?php echo "$co_estd";?></strong></p>
        <p class="small"><?php echo "$co_address";?></p>
    </div>
    <div class="col-xs-12 col-sm-2 text-center" id="user_show" style="margin-top:20px;">
	    <div class="input-group">
            <div class="input-group-btn">
                <button data-toggle="dropdown" class="btn dropdown-toggle" type="button" > 
                    <?php if(isset($_SESSION['login_name'])){?>
                    
                    <img src="<?php echo "../images/teachers/".$_SESSION['login_id'] . '.png';?>" width = "20px" height="auto" style="border-radius:50%;">  
                     
                    <?php echo $_SESSION['login_name'];
                        
                    }else {
                        
                        echo "Guest";
                        
                    }?>
                </button>
                <ul class="dropdown-menu" style="position:relative; width:100%;">
                    
                    <?php if(!$_SESSION['login_name']){?>
                    
                    <li><a href="../login/index.php">Sign in</a></li>
                    
                    <?php }else if($_SESSION['login_name']=='Guest'){ ?>
                    
                    <li><a href="../login/index.php">Sign in</a></li>
                    
                    <?php }else{ ?>
                    
                    <li><a href="../login/logout.php">Sign out</a></li>
                    
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>