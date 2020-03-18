<?php include 'header.php';?>
<?php include 'nav-bar.php';?>

<?php
$flag=0;
if(isset($_POST['Submit'])){ 
    $Security_Session = isset($_POST['Security_Session']) ? $_POST['Security_Session'] : '';
    $General_Security_Status = isset($_POST['General_Security_Status']) ? $_POST['General_Security_Status'] : '';
    $Mark_Security_Status = isset($_POST['Mark_Security_Status']) ? $_POST['Mark_Security_Status'] : '';
    $Result_Security_Status = isset($_POST['Result_Security_Status']) ? $_POST['Result_Security_Status'] : '';
    $Grand_Security_Status = isset($_POST['Grand_Security_Status']) ? $_POST['Grand_Security_Status'] : '';
    
    if(empty($Security_Session) or $Security_Session==0 ){
        $flag=1;
        $msg="Session not valied!";
    }else{
        $resultSecurity = mysqli_query($link,  "SELECT * FROM adm_security_mst WHERE asec_session='$Security_Session' ");
        if(mysqli_num_rows($resultSecurity)>0){
            
            mysqli_query($link,  "UPDATE adm_security_mst SET asec_general_status='$General_Security_Status', asec_mark_status='$Mark_Security_Status', asec_result_status='$Result_Security_Status', asec_grand_status='$Grand_Security_Status'  WHERE asec_session='$Security_Session' ");
            $flag=1;
            
            $msg="Updated Successfully";
            
            
        }else{
            
            mysqli_query($link,  "INSERT INTO adm_security_mst (asec_session, asec_general_status, asec_mark_status, asec_result_status, asec_grand_status  ) VALUES ('$Security_Session' , '$General_Security_Status', '$Mark_Security_Status', '$Result_Security_Status', '$Grand_Security_Status') ");
            
            $flag=1;
            
            $msg="Inserted Successfully";
            
        }           
    }
}

?>
<?php if ($flag){ ?>
<div class="container">
    <div class="alert alert-success fade in">
        <strong>Notice!</strong> <?php echo "$msg !";?>        
        <button type="button" class="btn btn-primary pull-right" role="button" onclick="location.href = 'adm_security_panel.php';" style="margin: -.5em;"> Back </button>
    </div>
</div>
<?php } ?>
    