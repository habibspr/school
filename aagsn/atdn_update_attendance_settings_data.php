<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include 'header.php';?>
<?php include '../nav-bar.php';?>

<?php
$flag=0;
if(isset($_POST['Submit'])){ 
    $ASM_Session = isset($_POST['ASM_Session']) ? $_POST['ASM_Session'] : '';
    $ASM_Cetegory = isset($_POST['ASM_Cetegory']) ? $_POST['ASM_Cetegory'] : '';
    $ASM_Date_From = isset($_POST['ASM_Date_From']) ? $_POST['ASM_Date_From'] : '';
    $ASM_Intime = isset($_POST['ASM_Intime']) ? $_POST['ASM_Intime'] : '';
    $ASM_Outtime = isset($_POST['ASM_Outtime']) ? $_POST['ASM_Outtime'] : '';
    $ASM_Fine = isset($_POST['ASM_Fine']) ? $_POST['ASM_Fine'] : '';
    
    if(empty($ASM_Session) or $ASM_Session==0 ){
        $flag=1;
        $msg="Session not valied!";
    }else{
        $result_ASM = mysqli_query($link,  "SELECT * FROM attendance_settings_mst WHERE asm_session='$ASM_Session' AND asm_start_date='$ASM_Date_From' ");
        if(mysqli_num_rows($result_ASM)>0){
            mysqli_query($link,  "UPDATE attendance_settings_mst SET asm_category='$ASM_Cetegory', asm_intime='$ASM_Intime', asm_outtime='$ASM_Outtime', asm_fine='$ASM_Fine'  WHERE asm_session='$ASM_Session' ");
            $flag=1;
            $msg="Updated Successfully";
        }else{
            mysqli_query($link,  "INSERT INTO attendance_settings_mst (asm_session, asm_category, asm_start_date, asm_intime, asm_outtime, asm_fine ) VALUES ('$ASM_Session' , '$ASM_Cetegory', '$ASM_Date_From' ,'$ASM_Intime', '$ASM_Outtime', '$ASM_Fine') ");
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
        <button type="button" class="btn btn-primary pull-right" role="button" onclick="location.href = 'atdn_attendance_settings_panel.php';" style="margin: -.5em;"> Back </button>
    </div>
</div>
<?php } ?>
    