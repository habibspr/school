<?php include 'header.php';?>
<?php include 'nav-bar.php';?>

<?php
session_start();
if(isset($_POST['checkStatus'])){
    if($_POST['checkStatus']=='0'){
    $status = 0; //to save in DB as boolean
    }else if($_POST['checkStatus']=='1'){
    $status = 1;
    }


    $resultSecurity = mysqli_query($link,  "SELECT * FROM permission_master WHERE pm_id='$Module_Id' ");
    if(mysqli_num_rows($resultSecurity)>0){
        
        mysqli_query($link,  "UPDATE permission_master SET pm_permission='$status'  WHERE pm_id='$Module_Id' ");
        $flag=1;
        
        $msg="Updated Successfully";
        
        
    }else{
        
        mysqli_query($link,  "INSERT INTO permission_master ( pm_id, pm_module_name, asec_general_status ) VALUES ('$Module_Id' , '$Permission_Name', '$Permission_Status') ");
        
        $flag=1;
        
        $msg="Inserted Successfully";
        
    }           
}

?>

    