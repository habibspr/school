<?php include("../resources/db_aags_n.php");?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ID CARD</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="print">
	<style>@page { size: 54mm 86mm }</style>
</head>
<body>
	<!--student info code with loop-->

	<?php
	
	$result_institute = mysqli_query($link, "SELECT * FROM company_info");
	while ($row_institute = mysqli_fetch_assoc($result_institute)) {
	    $institute_name = $row_institute['co_name'];
	    $institute_web = $row_institute['co_web'];
	    
	}

		if(isset($_POST["id_card"])){

		$class = $_POST["class"];
		$session = $_POST["session"];
		$result_st = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group 
	                    WHERE student_info.st_id = st_session.ss_st_id
	                    AND st_session.ss_class_id = st_class.sc_id
	                    AND st_session.ss_group_id = st_group.sg_id
	                    AND st_session.ss_year = '$session'
	                    AND st_session.ss_class_id = '$class'
	                    AND student_info.st_status='0'
	                    ORDER BY ss_roll
                    " );
		while ($row_st = mysqli_fetch_assoc($result_st)) {

	?>
	<section class="card">
		<div class="header text-center">
			<img src="../images/logo.png" alt="Image">
			<h5><?php echo $institute_name;?></h5>
		</div>
		<div class="main-content text-center">
			<h6 class="identity">IDENTITY CARD</h6>
            <?php //checking extention of image

                                         $test_img_name = "../images/students/".$row_st['st_id'];

                                         if(file_exists($test_img_name.".jpg")){
                                            $img_name= $test_img_name.".jpg";
                                         }
                                         elseif(file_exists($test_img_name.".jpeg")){
                                            $img_name= $test_img_name.".jpeg";
                                         }
                                         elseif(file_exists($test_img_name.".JPG")){
                                            $img_name= $test_img_name.".JPG";
                                         }
                                         elseif(file_exists($test_img_name.".JPEG")){
                                            $img_name= $test_img_name.".JPEG";
                                         }
                                         elseif(file_exists($test_img_name.".PNG")){
                                            $img_name= $test_img_name.".PNG";
                                         } else{
                                            $img_name= $test_img_name.".png";
                                         }
            ?>
			<img class="student-image" src="<?php echo $img_name;?>" alt="Image">
			<p class="name"><?php echo $row_st["st_name"];?></p>
			<p class="info">Class: <?php echo $row_st["sc_name"];?> &nbsp;&nbsp;&nbsp;&nbsp; Roll: <?php echo $row_st["ss_roll"];?></p>
			<p class="group">Group: <?php echo strtoupper( $row_st["sg_group"]);?></p>
			<img class="signature" src="signature.png">
			<p class="head">Headmaster Signature</p>
		</div>
		<div class="footer text-center">
			<div class="website"><?php echo $institute_web;?></div>
			<p class="id">%%%%%/////--\\\\\| <?php echo $row_st["st_code"];?> |/////--\\\\\%%%%%</p>
		</div>
	</section>
<?php } } ?>
</body>
</html>