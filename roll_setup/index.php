<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>
<?php include "../aagsn/header.php";?>
<?php include "../nav-bar.php";?>

<style type="text/css">
#st_roll_search_form .input-group {
	margin: 10px 0;
}
input[type="text"]{
	padding: 2px 5px;
}
</style>
		<div class="container form-section" style="margin-top: 20px;">
			<p id="toggler" class="text-center" style="cursor: pointer; font-weight: bold;">|||</p>
			<form action="functions.php" id="st_roll_search_form" method="post" enctype="multipart/form-data">
					<div>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Session</span>
					  <select class="form-control" name="st_session" id="session" required>
						<?php
							$query = mysqli_query($link,"SELECT DISTINCT ss_year FROM st_session ORDER BY ss_year DESC");
							while($result = mysqli_fetch_assoc($query)){
						?>
						<option value="<?php echo $result["ss_year"];?>"><?php echo $result["ss_year"];?></option>
							<?php } ?>
					  </select>
					</div>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Class</span>
					  <select class="form-control" name="st_class" id="st_class" required>
						<?php
							$query2 = mysqli_query($link,"SELECT * FROM st_class");
							while($result = mysqli_fetch_assoc($query2)){
						?>
						<option value="<?php echo $result["sc_id"];?>"><?php echo $result["sc_name"];?></option>
							<?php } ?>
					  </select>
					</div>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Group</span>
					  <select class="form-control" name="st_group" id="st_group" required>
						<?php
							$query3 = mysqli_query($link,"SELECT * FROM st_group");
							while($result = mysqli_fetch_assoc($query3)){
						?>
						<option value="<?php echo $result["sg_id"];?>"><?php echo $result["sg_group"];?></option>
							<?php } ?>
					  </select>
					</div>
					<div class="input-group">
						<input type="submit" value="Search" name="search_submit" id="search_submit" class="btn btn-primary">
					</div>
				</div>
			</form>
			<div id="all-data">
				
			</div>
		</div>
	</body>
	<script type="text/javascript" src="../dist/js/jquery.min.js"></script>
	<script type="text/javascript">

			$(document).ready(function(){
				$("#toggler").click(function(){
					$("#st_roll_search_form").slideToggle();
				});
			});

			//working with form submit
			$("#st_roll_search_form").on("submit",function(e){
				e.preventDefault();

				//getting data

				var session = $("#session").val();
				var st_class = $("#st_class").val();
				var st_group = $("#st_group").val();

				$("#all-data").load("all_data.php", {"search_form_submit": true,"st_session": session, "st_class": st_class, "st_group": st_group});
			});
	</script>
</html>