
<?php include "../resources/db_aags_n.php" ;
 if(mysqli_query($link, "DELETE FROM st_leave WHERE sl_id = '".$_POST["sl_id"]."'")){
     echo 'Data Deleted';  
     }  
 ?>