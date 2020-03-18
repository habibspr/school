<?php
include "../resources/db_aags_n.php" ;
include "../global.php" ;

//getting logged user CODE as ref_id
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ref_id = $_SESSION["login_id"];

$result_ss = mysqli_query($link, "SELECT gsm_id, gsm_session FROM global_session_mst ORDER BY gsm_id DESC");
$ss_row = mysqli_fetch_assoc($result_ss);
$current_session_id = $ss_row["gsm_id"];
$current_session = $ss_row["gsm_session"];

$mr_date = date("Ymd");

$status = 0;
	
    //payment status
    
    if(isset($_POST["status_form_submit"])){
        $mr_no = $_POST["mr_id"];
        $status_update = "UPDATE ac_cash_receive_dtl SET ac_crd_status = 1 WHERE ac_crd_mr_no = '$mr_no'";
        if(mysqli_query($link, $status_update)){
            echo 1;
        } else {
            echo 0;
        }
    }
    
    
	//adding payments data
	if(isset($_POST["pay_form_submit"]) && $_POST["payment_st_id"] != -1){
		
		$st_id = $_POST["payment_st_id"];
		$total_items = $_POST["total_items"];


		// For MR NUMBER START
        $mr_no=1;
        $mr_max = mysqli_query($link, "SELECT ac_crd_mr_no FROM ac_cash_receive_dtl ORDER BY ac_crd_mr_no DESC LIMIT 1");
        $mr_row = mysqli_fetch_array($mr_max);
        $int_mr = (int)$mr_row['ac_crd_mr_no'];
        $sub_mr = substr($int_mr, 8);  
        $mr_no= $sub_mr+1;
        
        $ac_crd_mr_no= $mr_date . str_pad($mr_no,6,"0",STR_PAD_LEFT);// for session add and last id
		//MR NUMBER END


		for($i = 0; $i < $total_items; $i++){
			$p_type = $_POST["ac_crd_ahm_id"][$i];
			$qty = $_POST["qty"][$i];
			$amount = $_POST["amount"][$i];

			$sqli = "INSERT INTO ac_cash_receive_dtl (ac_crd_gsm_id, ac_crd_mr_no, ac_crd_date, ac_crd_time, ac_crd_st_id , ac_crd_ahm_id, ac_crd_qty, ac_crd_amount, ac_crd_ref_id) VALUES ('$current_session_id', '$ac_crd_mr_no',CURRENT_DATE(),CURRENT_TIME(),'$st_id', '$p_type', '$qty', '$amount', '$ref_id')";

			if(mysqli_query($link, $sqli)){
				$result_phn = mysqli_query($link, "SELECT st_mobile, st_code, st_name FROM student_info WHERE st_id = '$st_id'");
				$phn_row = mysqli_fetch_assoc($result_phn);
				$phn = $phn_row["st_mobile"];
				$name = $phn_row["st_name"];
				$code = $phn_row["st_code"];

				$status = 1;
			}
			else {
				$status = 2;
			}

		}
		if($status == 1){
			$result_transaction_details = mysqli_query($link, "SELECT * FROM ac_cash_receive_dtl INNER JOIN ac_head_mst ON ac_crd_ahm_id = ac_hm_id WHERE ac_crd_mr_no = '$ac_crd_mr_no' AND ac_crd_gsm_id = '$current_session_id'");
			if(mysqli_num_rows($result_transaction_details) > 0){
                    $i = 1;
                    $total_amount_of_transaction = 0;
                    while ($row_transaction_details = mysqli_fetch_assoc($result_transaction_details)) {
                        $total_amount_of_transaction += $row_transaction_details["ac_crd_amount"];}}
                        $status = $phn."-".$name."-".$code."-".$total_amount_of_transaction;
                        echo $status;
		}

		else {
			echo $status;
		}

	}

	/*updating payments data*/

	if(isset($_POST["pay_form_submit_update"]) && $_POST["payment_st_id"] != -1){
		
		$st_id = $_POST["payment_st_id"];
		$total_items = $_POST["total_items"];


		for($i = 0; $i < $total_items; $i++){
			$p_type = $_POST["ac_crd_ahm_id"][$i];
			$qty = $_POST["qty"][$i];
			$amount = $_POST["amount"][$i];
			$ac_crd_id = $_POST["ac_crd_id"][$i];

			$sqli = "UPDATE ac_cash_receive_dtl SET ac_crd_gsm_id = '$current_session_id', ac_crd_date = CURRENT_DATE(), ac_crd_time = CURRENT_TIME(), ac_crd_ahm_id = '$p_type', ac_crd_qty = '$qty', ac_crd_amount = '$amount', ac_crd_ref_id = '$ref_id' WHERE ac_crd_st_id = '$st_id' AND ac_crd_id = '$ac_crd_id'";

			if(mysqli_query($link, $sqli)){
				$result_phn = mysqli_query($link, "SELECT st_mobile, st_code, st_name FROM student_info WHERE st_id = '$st_id'");
				$phn_row = mysqli_fetch_assoc($result_phn);
				$phn = $phn_row["st_mobile"];
				$name = $phn_row["st_name"];
				$code = $phn_row["st_code"];

				$status = 1;
			}
			else {
				$status = 2;
			}

		}
		echo $status;

	}

	/*Auto Complete Form*/

	if(isset($_POST["autoComplete"])){
		$opt = $_POST["option_type"];
		$qty = $_POST['qty'];
		$sc = $_POST['sc'];

		$amount_result = mysqli_query($link, "SELECT ac_sm_amount FROM ac_session_mst WHERE ac_sm_ahm_id = '$opt' AND ac_sm_gsm_id = '$current_session_id' AND ac_sm_class_id = '$sc'");
		$amount = mysqli_fetch_assoc($amount_result)["ac_sm_amount"];
		$total = (int)$amount * (int)$qty;
		echo $total;
	}

	if(isset($_POST["get_options"])){
		$result_op = mysqli_query($link, "SELECT * FROM ac_head_mst");
		if(mysqli_num_rows($result_op) > 0){
				$all = "";
              while($options = mysqli_fetch_assoc($result_op)){
              	$all = $all."|".$options["ac_hm_id"]."---".$options["ac_hm_name"];
              }
              echo $all;
        }
	}

	//adding account head data

	if(isset($_POST["ac_hm_submit"])){
		
		$ac_hm_name = strtoupper($_POST["ac_hm_name"]);
		$ac_hm_category = strtoupper($_POST["ac_hm_category"]);

		$sqli_ahm = "INSERT INTO ac_head_mst (ac_hm_name, ac_hm_category) VALUES ('$ac_hm_name', '$ac_hm_category')";

		if(mysqli_query($link, $sqli_ahm)){
			echo 1;
		}
		else {
			echo 2;
		}

	}

	//adding global session data

	if(isset($_POST["ss_form_submit"])){
		
		$ss_name = $_POST["ss_name"];
		$ss_start = date_create($_POST["ss_start"]);
		$ss_end = date_create($_POST["ss_end"]);

		//format date

		$start_date_format = date_format($ss_start, "Y-m-d");
		$end_date_format = date_format($ss_end, "Y-m-d");

		$sqli_ss = "INSERT INTO global_session_mst (gsm_session, gsm_session_start, gsm_session_end) VALUES ('$ss_name', '$start_date_format', '$end_date_format')";

		if(mysqli_query($link, $sqli_ss)){
			echo 1;
		}
		else {
			echo 2;
		}

	}

	//adding session master data

	if(isset($_POST["sm_form_submit"])){
		
		$sm_session = $_POST["sm_session"];
		$sm_class = $_POST["sm_class"];
		$sm_head = $_POST["sm_head"];
		$sm_amount = $_POST["sm_amount"];

		//check if data present
		$sqli_sm_check = mysqli_query($link, "SELECT * FROM ac_session_mst WHERE ac_sm_gsm_id = '$sm_session' AND ac_sm_class_id = '$sm_class' AND ac_sm_ahm_id = '$sm_head'");
		if(mysqli_num_rows($sqli_sm_check) > 0){
			echo 3;
			die();
		}


		$sqli_sm = "INSERT INTO ac_session_mst (ac_sm_gsm_id, ac_sm_class_id, ac_sm_ahm_id, ac_sm_amount) VALUES ('$sm_session', '$sm_class', '$sm_head', '$sm_amount')";

		if(mysqli_query($link, $sqli_sm)){
			echo 1;
		}
		else {
			echo 2;
		}

	}
?>