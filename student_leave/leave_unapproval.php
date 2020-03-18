
<?php include "../resources/db_aags_n.php" ;

 if(mysqli_query($link, "UPDATE st_leave SET sl_approval_status = '0' WHERE sl_id = '".$_POST["sl_id"]."'")){
     echo 'Approved. ';  
     }  
 ?>