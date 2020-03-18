<?php include "../resources/db_aags_n.php" ;

session_start();
$ref_id = $_SESSION["login_id"];

$session = date('Y');
$class_id = $_POST['class_id'];
$roll = $_POST['roll'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$comments = $_POST['comments'];


//searching student code
$resultstudentid=mysqli_query($link, "SELECT * FROM student_info, st_session, st_class WHERE st_id=ss_st_id AND ss_class_id=$class_id AND sc_id=ss_class_id AND ss_roll=$roll AND ss_year=$session ");

while($row = mysqli_fetch_array($resultstudentid)){
    $studentid=$row['st_id'];
    }
    
mysqli_query($link, "INSERT INTO st_leave (sl_st_id, sl_leave_start_date, sl_leave_end_date, sl_user_id, sl_comments) VALUES ('$studentid', '$startdate', '$enddate', '$ref_id', '$comments')");

?>