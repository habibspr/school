<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include("../aagsn/header.php");?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ID CARD</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
</head>
<body style="width: 100% !important;">
	<?php

	if(!isset($_POST["id_card"])){?>
		<!--Showing Form Here-->
		<h2 style="font-size: 40px !important; margin-top: 50px;" class="text-center">ID CARD</h2>
		<form action="cards.php" method="POST" style="width: 60% !important; margin: 0 auto !important;">
			<select name="class">
				<?php
					$result_class = mysqli_query($link, "SELECT *
                    FROM st_class" );
                    while ($row_class = mysqli_fetch_assoc($result_class)) {
				?>
				<option value="<?php echo $row_class["sc_id"]?>"><?php echo $row_class["sc_name"]?></option>
			<?php } ?>
			</select>
			<select name="session">
				<?php
					$result_student_details = mysqli_query($link, "SELECT DISTINCT ss_year
                    FROM st_session ORDER BY ss_year DESC" );
                    while ($row_class = mysqli_fetch_assoc($result_student_details)) {
				?>
				<option value="<?php echo $row_class["ss_year"]?>"><?php echo $row_class["ss_year"]?></option>
			<?php } ?>
			</select>
			<input type="submit" name="id_card" value="Submit">
		</form>
	<?php die(); } ?>
</body>
</html>