<?php 
include "../resources/db_aags_n.php";
//getting logged user CODE as ref_id
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ref_id = $_SESSION["login_id"];

	if(isset($_POST["t_insert_info"])){

		//global variables

		$status = 0;
		$Session = date("Y");

		//variable for all submitted data
		$name = $_POST["name"];
		$gender = $_POST["gender"];
		$designation = $_POST["designation"];
		$join_date = $_POST["join_date"];
		$sub = $_POST["subject"];
		$blood = $_POST["blood"];
		$phn = $_POST["phone"];
		// Default Password for teachers
		$t_pass = md5("123456");

		// Form No
        $t_id=1;
        $resultmax = mysqli_query($link, "SELECT * FROM teacher_info");
        $row = mysqli_fetch_array($resultmax);       
        $t_id_num = (int)mysqli_num_rows($resultmax);
        $t_id=$t_id_num+1;
        
        $t_code_no= $Session . str_pad($t_id,6,"0",STR_PAD_LEFT);// for session add and last id

		// start database coding

		$sqli = "INSERT INTO teacher_info (t_code, t_name, t_sex, t_des, t_joindate , t_subject, t_bgroup, t_phone, t_pass, t_ref_id) VALUES ('$t_code_no', '$name','$gender','$designation', '$join_date', '$sub', '$blood', '$phn', '$t_pass', '$ref_id')";

			if(mysqli_query($link, $sqli)){

				echo $status = 1;
			}
			else {
				echo $status = 2;
			}
	}

	//update teacher

	if(isset($_POST["t_update_info"])){

		//global variables
        $t_class_id = 0;
		$status = 0;
		$Session = date("Y");

		//variable for all submitted data
		$name = $_POST["name"];
		$gender = $_POST["gender"];
		$designation = $_POST["designation"];
		$join_date = $_POST["join_date"];
		$sub = $_POST["subject"];
		$blood = $_POST["blood"];
		$phn = $_POST["phone"];
		$t_pass = md5($_POST["t_pass"]);
		$t_code = $_POST["t_code"];
		$t_status = $_POST["teacherstatus"];
		$t_class_id = $_POST["t_class_id"];

        //database coding

		$sqli = "UPDATE teacher_info SET t_name = '$name', t_sex = '$gender', t_des = '$designation', t_joindate = '$join_date', t_subject = '$sub', t_bgroup = '$blood', t_phone = '$phn', t_pass = '$t_pass', t_ref_id = '$ref_id', t_status = '$t_status', t_class_id = '$t_class_id' WHERE t_code = '$t_code'";

			if(mysqli_query($link, $sqli)){

				echo $status = 1;
			}
			else {
				echo $status = 2;
			}
	}
?>