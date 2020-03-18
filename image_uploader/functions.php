<?php
	//start all codes
	include("../resources/db_aags_n.php");
	
	if(isset($_POST["st_img_submit"])){
		$ss = $_POST["st_session"];
		$class = $_POST["st_class"];
		$group = $_POST["st_group"];
		$roll = $_POST["st_roll"];
		if($_POST["image"] != ""){

			$st_id_query = mysqli_query($link, "SELECT ss_st_id, st_code, st_id FROM st_session, student_info WHERE ss_year = '$ss' AND ss_class_id = '$class' AND ss_group_id = '$group' AND ss_roll = '$roll' AND st_id = st_session.ss_st_id");
			//checking if data is present
			if(mysqli_num_rows($st_id_query) == 0){
				echo false;
				die();
			}
			while($st_id_result = mysqli_fetch_assoc($st_id_query)){
				$st_id = $st_id_result["st_id"]; //use anything that you want to use as the name of image
			}
			if($st_id == ""){
				echo false;
				die();
			}

			//croping image upload
			$data = $_POST["image"];

			$image_array_1 = explode(";", $data);

			$image_array_2 = explode(",", $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);
				// delete all files with this id
				$existingFile = "../images/students/".$st_id;
				foreach (glob("$existingFile.*") as $filename){
					unlink($filename);
				}
				//-------------------------------
			$imageName = "../images/students/".$st_id.'.png';
			
			file_put_contents($imageName, $data);

			echo true;
		} else {
			echo false;
		}
	}
	if(isset($_POST["t_img_submit"])){
		$t_code = $_POST["t_id"]; 
		if($_POST["image"] != ""){
            
            $t_id_query = mysqli_query($link, "SELECT t_id FROM teacher_info WHERE t_code =$t_code ");
			//checking if data is present
			if(mysqli_num_rows($t_id_query) == 0){
				echo false;
				die();
			}
			while($t_id_result = mysqli_fetch_assoc($t_id_query)){
				$t_id = $t_id_result["t_id"]; //use anything that you want to use as the name of image
			}

			//croping image upload
			$data = $_POST["image"];

			$image_array_1 = explode(";", $data);

			$image_array_2 = explode(",", $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);
                
            // delete all files with this id
				$existingFile = "../images/teachers/".$t_id;
				foreach (glob("$existingFile.*") as $filename){
					unlink($filename);
				}
				//-------------------------------
            
			$imageName = "../images/teachers/".$t_id.'.png';

			file_put_contents($imageName, $data);

			echo true;
		} else {
			echo false;
		}
	}
?>