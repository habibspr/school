
<?php include "../resources/db_aags_n.php" ;

 if(mysqli_query($link, "UPDATE ac_expense_dtl SET ace_approval_status = '1' WHERE ace_id = '".$_POST["ace_id"]."'")){
     echo 'Approved. ';  
     }  
 ?>