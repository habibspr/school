//depandent_selection_data.php

// Data Connection
<?php include "../resources/db_aags_n.php" ;?>

// selection Session and Exam
<?php 
if(!empty($_POST["Session_id"])){
    //Fetch all state data
    $query = $link->query("SELECT * FROM exm_mst WHERE exm_lock='0' AND exm_year = ".$_POST['Session_id']." ORDER BY exm_id DESC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select exam </option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['exm_id'].'">'.$row['exm_id']. "-" .$row['exm_name']."-".$row['exm_year'].'</option>';
        }
    }else{
        echo '<option value="">Exam not available</option>';
    }
}else

// Subject selection
if(!empty($_POST["Class_id"])){
    //Fetch all state data
    $query = $link->query("SELECT * FROM exm_subject_mst WHERE EXISTS (SELECT distinct ess_sub_id, ess_class_id, ess_session FROM exm_sub_set WHERE exm_sub_id=ess_sub_id AND ess_class_id = ".$_POST['Class_id']." ) ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select subject </option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['exm_sub_id'].'">'.$row['exm_sub_code']."-".$row['exm_sub_name'].'</option>';
        }
    }else{
        echo '<option value="">Subject not available</option>';
    }
}
?>