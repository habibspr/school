<?php include "../resources/db_aags_n.php" ;

if($_REQUEST["techer_id"] ){
    
    $Session = $_REQUEST['Session'];
    $techer_id = $_REQUEST['techer_id'];
    $class_id = $_REQUEST['class_id'];
    $subject_id = $_REQUEST['subject_id'];
    $status_code = $_REQUEST['status_code'];
    
}

// insert 
mysqli_query($link, "INSERT INTO exm_teach_sub_set (etss_teach_id, etss_session, etss_class_id, etss_sub_id, etss_status) VALUES ('$techer_id', '$Session', $class_id, '$subject_id','$status_code') ");
?>
