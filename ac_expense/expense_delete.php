
<?php include "../resources/db_aags_n.php" ;

 if(mysqli_query($link, "DELETE FROM ac_expense_dtl WHERE ace_id = '".$_POST["ace_id"]."'")){
     echo 'Data Deleted';  
     }  
 ?>