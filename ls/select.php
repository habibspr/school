<?php  
 $connect = mysqli_connect("localhost", "root", "", "aags_n");  
 $output = '';  
 $sql = "SELECT * FROM student_info ORDER BY st_id ASC";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="10%" style="background-color:black; color:white;">Id</th>  
                     <th width="40%">Name</th>  
                     <th width="40%">Class</th>  
                     <th width="10%">Delete</th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td>'.$row["st_id"].'</td>  
                     <td class="first_name" data-id1="'.$row["st_id"].'" contenteditable>'.$row["st_code"].'</td>  
                     <td class="last_name" data-id2="'.$row["st_id"].'" contenteditable>'.$row["st_name"].'</td>  
                     <td><button type="button" name="delete_btn" data-id3="'.$row["st_id"].'" class="btn btn-lg btn-danger btn_delete">Delete</button></td>  
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="first_name" contenteditable></td>  
                <td id="last_name" contenteditable></td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-lg btn-success">Add</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>