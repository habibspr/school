<?php 
if(isset($_POST["send_sms"])){
	
	//getting data to send sms
	$msg = $_POST["msg"];
	$phn_number = $_POST["number"];

	//api config
	include("sms_api_config.php");

	echo file_get_contents('http://sms.dewanict.com/smsapi', false, stream_context_create([
	    'http' => [
	        'method' => 'POST',
	        'header'  => "Content-type: application/x-www-form-urlencoded",
	        'content' => http_build_query([
	            'api_key' => $api_key,
				'type' => $type,
				'contacts' => $phn_number,
				'senderid' => $senderid,
				'msg' => $msg
	        ])
	    ]
	]));
}
?>
