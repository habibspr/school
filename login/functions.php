<?php

	include "../resources/db_aags_n.php";
	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	if(isset($_POST["login_submit"])){

		//getting data from POST request
		$t_code = $_POST["t_code"];
		$userPass = md5($_POST["password"]);

		//checking data

		if($t_code != "" && $userPass != ""){
			$result_chk = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_code = '$t_code' AND t_pass = '$userPass'");
			if(mysqli_num_rows($result_chk) > 0){
				$t_result = mysqli_fetch_assoc($result_chk);
            	$t_id = $t_result["t_id"];
            	$t_name = $t_result["t_name"];
            	$t_des = strtolower($t_result["t_des"]);
            	//creating session for storing this user id
            	$_SESSION["login_id"] = $t_id;
            	$_SESSION["login_t_des"] = $t_des;
            	$_SESSION["login_name"] = $t_name;
            	$_SESSION["login_photo"] = $t_id;
            	echo 1;

          	}
          	else {
          		echo 2;
          	}
		}


	}
?>