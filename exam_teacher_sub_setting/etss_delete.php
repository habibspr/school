<?php include "../resources/db_aags_n.php" ;

if($_REQUEST["etss_id"] ){
    
    echo $etss_id = $_REQUEST['etss_id'];
    
}

  // Delete record
    mysqli_query($link,"DELETE FROM exm_teach_sub_set WHERE etss_id=$etss_id");

echo "deleted".$etss_id;
?>
