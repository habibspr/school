<?php 
if(isset($_POST['user_id'])){ // Fetching variables of the form which travels in URL 
    
    $User_Id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $Password = isset($_POST['password']) ? $_POST['password'] : '';
    
    //User id searching //
    if($resultlogin = mysqli_query($link,  "SELECT * FROM user_info WHERE user_name ='$User_Id' AND user_password = '$Password' ")){
        if(mysqli_num_rows($resultlogin) > 0){
            while($row = mysqli_fetch_array($resultlogin)){
                $global_User=$row['user_name'];
            }
        }
    }
}else if(isset($_POST['others_id'])){
   
    $others_Id = isset($_POST['others_id']) ? $_POST['others_id'] : '';
    $others_password = isset($_POST['others_password']) ? $_POST['others_password'] : '';
    $others_dob = isset($_POST['others_dob']) ? $_POST['others_dob'] : '';
    
    //User id searching //
    if($resultlogin = mysqli_query($link,  "SELECT * FROM adm_user_info WHERE aui_form_no ='$others_Id'")){
        if(mysqli_num_rows($resultlogin) > 0){
            while($row = mysqli_fetch_array($resultlogin)){
                $Others_User=$row['aui_name'];
            }
        }
    }
    
}else{
    $student_code = isset($_POST['student_code']) ? $_POST['student_code'] : '';
    
    
    //User id searching //
    if($resultlogin = mysqli_query($link, "SELECT * FROM student_info WHERE st_code='$student_code' ")){
        if(mysqli_num_rows($resultlogin) > 0){
            while($row = mysqli_fetch_array($resultlogin)){
                $student_code=$row['st_code'];
            }
        }
    }    
}


$currenturl=$_SERVER['REQUEST_URI'];

?>