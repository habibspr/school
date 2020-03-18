<?php  
 $connect = mysqli_connect("localhost", "root", "", "aags_n");  
 $sql = "DELETE FROM student_info WHERE st_id = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>