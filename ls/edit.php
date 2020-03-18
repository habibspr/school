<?php  
 $connect = mysqli_connect("localhost", "root", "", "aags_n");  
 $id = $_POST["id"];  
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE student_info SET ".$column_name."='".$text."' WHERE st_id='".$id."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Updated';  
 }  
 ?>