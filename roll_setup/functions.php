<?php
	//start all codes
	include("../resources/db_aags_n.php");
	
	if(isset($_POST["st_id"])){

		$roll = $_POST["roll"];
		$st_id = $_POST["st_id"];
		$ss_year = $_POST["ss_year"];

		$st_id_query = "UPDATE st_session SET ss_roll = '$roll' WHERE ss_st_id = '$st_id' AND ss_year = '$ss_year'";

		if(mysqli_query($link, $st_id_query)){
			echo "Updated!";
		} else{
			echo "Problem!!!";
		}
	} else{
		echo "Form submit problem!";
	}

?>