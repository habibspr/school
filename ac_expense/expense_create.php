<?php include "../resources/db_aags_n.php" ;

session_start();
$ref_id = $_SESSION["login_id"];

$session = date('Y');
$ex_date = $_POST['ex_date'];
$ac_supplier_id = $_POST['ac_supplier_id'];
$ac_head_id = $_POST['ac_head_id'];
$ex_amount = $_POST['ex_amount'];
$ex_comments = $_POST['ex_comments'];

		// For MR NUMBER START
		$mr_no=1;
        $result_max = mysqli_query($link, "SELECT MAX(ace_id) AS max_id FROM `ac_expense_dtl`");
        while($row = mysqli_fetch_array($result_max)){
             $mr_no=$row['max_id'];
         }
        $mr_no=$mr_no+1;
        $ac_crd_mr_no = date('Ymd').str_pad($mr_no,6,"0",STR_PAD_LEFT);// for session add and last id
		//MR NUMBER END

//searching student code
mysqli_query($link, "INSERT INTO ac_expense_dtl (ace_mr_no, ace_date, ace_sm_id, ace_ach_id, ace_amount, ace_user_id, ace_comments) VALUES ('$ac_crd_mr_no', '$ex_date', '$ac_supplier_id', '$ac_head_id', '$ex_amount', '$ref_id', '$ex_comments')");

?>