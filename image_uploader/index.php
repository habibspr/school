<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include("../aagsn/header.php");?>
<?php include "../nav-bar.php";?>
<?php include("../resources/db_aags_n.php");?>
<link rel="stylesheet" href="css/croppie.css" />
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<style type="text/css">
	#st_img_update_form, #t_img_update_form {
		display: none;
	}
	#btn_student, #btn_teacher {
		background: green;
	}
</style>
		<div class="container-fluid form-section">
			<div class="form-container">
				<div class="page-header">
				  <h3 class="text-center">Update Image</h3>
				</div>
				<div class="text-center" style="margin-bottom: 50px;">
					<button id="btn_student" class="btn btn-primary">Student</button>
					<button id="btn_teacher" class="btn btn-primary">Teacher</button>
				</div>
				<form action="functions.php" id="st_img_update_form" method="post" enctype="multipart/form-data">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Session</span>
					  <select class="form-control" name="st_session" required>
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
					  <select class="form-control" name="st_class" required>
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
					  <select class="form-control" name="st_group" required>
						<?php
							$query3 = mysqli_query($link,"SELECT * FROM st_group");
							while($result = mysqli_fetch_assoc($query3)){
						?>
						<option value="<?php echo $result["sg_id"];?>"><?php echo $result["sg_group"];?></option>
							<?php } ?>
					  </select>
					</div>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Roll</span>
					  <input type="text" name=" st_roll" class="form-control" required />
					</div>
					<div class="input-group">
						<input type="submit" value="Update" name="st_img_submit" id="st_img_submit" class="btn btn-primary">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-lg-6">
					<!--Crop option start-->
					<div id="st_crop_option">
					 <div id="st_image_demo" style="width:350px; margin-top:30px"></div>
					</div>
					<!--Crop option end-->
					<div class="input-group">
						<input id="st_img_input" class="blank_after_submit" type="file" name="st_image">
					</div>
				</div>
				</form>
				<!--Teachers Form Start-->
				<form action="functions.php" id="t_img_update_form" method="post" enctype="multipart/form-data">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">Teacher ID</span>
					  <input type="text" name="t_id" class="form-control" required />
					</div>
					<div class="input-group">
						<input type="submit" value="Update" name="t_img_submit" id="t_img_submit" class="btn btn-primary">
					</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
						<!--Crop option start-->
						<div id="crop_option">
						 <div id="image_demo" style="width:350px; margin-top:30px"></div>
						</div>
						<!--Crop option end-->
						<div class="input-group">
							<input id="t_img_input" class="blank_after_submit" type="file" name="t_image">
						</div>
					</div>
				</form>
				<!--Teachers Form End-->
			</div>
		</div>
	</body>
	<script type="text/javascript" src="../dist/js/jquery.min.js"></script>
	<script src="js/croppie.js"></script>
	<script>
		$(document).ready(function(){


			//image croping starting code

			$('#st_crop_option').hide();

			$st_image_crop = $('#st_image_demo').croppie({
		    enableExif: true,
		    viewport: {
		      width:200,
		      height:200,
		      type:'square' //circle
		    },
		    boundary:{
		      width:300,
		      height:300
		    }
		  	});

		  	//for teachers img crop
		  	$('#crop_option').hide();

		  	$image_crop = $('#image_demo').croppie({
		    enableExif: true,
		    viewport: {
		      width:200,
		      height:200,
		      type:'square' //circle
		    },
		    boundary:{
		      width:300,
		      height:300
		    }
		  	});

			//working with st image

			$('#st_img_input').on('change', function(){
			    var reader = new FileReader();
			    reader.onload = function (event) {
			      $st_image_crop.croppie('bind', {
			        url: event.target.result
			      }).then(function(){
			        console.log('jQuery bind complete');
			      });
			    }
			    reader.readAsDataURL(this.files[0]);
			    $('#st_crop_option').show();
			});

			//working with buttons

			//student button
			$("#btn_student").click(function(e){
				e.preventDefault();
				$("#t_img_update_form").hide();
				$("#st_img_update_form").show();
				$("#btn_teacher").css("background", "green");
				$(this).css("background", "black")
			});

			//teachers button
			$("#btn_teacher").click(function(e){
				e.preventDefault();
				$("#st_img_update_form").hide();
				$("#t_img_update_form").show();
				$("#btn_student").css("background", "green");
				$(this).css("background", "black")
			});

			//working with for submit
			$("#st_img_update_form").on("submit",function(e){
				e.preventDefault();
				var data = new FormData(this);


				//image crop

				$st_image_crop.croppie('result', {
			      type: 'canvas',
			      size: 'viewport'
			    }).then(function(response){

					data.append("st_img_submit", true);
					data.append("image", response);
					$.ajax({
						url: "functions.php",
						method: "post",
						data: data,
						contentType: false,
						processData: false,
						success: function(data){
							if(data != false){
								alert("Done...");
								$(".blank_after_submit, input[type='text']").val("");
							} else {
								alert("Please Try Again!");
							}
						}
					});

			    });
			});

			//working with t image

			$('#t_img_input').on('change', function(){
			    var reader = new FileReader();
			    reader.onload = function (event) {
			      $image_crop.croppie('bind', {
			        url: event.target.result
			      }).then(function(){
			        console.log('jQuery bind complete');
			      });
			    }
			    reader.readAsDataURL(this.files[0]);
			    $('#crop_option').show();
			});

			//working with teacher form submit
			$("#t_img_update_form").on("submit",function(e){
				e.preventDefault();

				var data = new FormData(this);

				//image crop

				$image_crop.croppie('result', {
			      type: 'canvas',
			      size: 'viewport'
			    }).then(function(response){

					data.append("t_img_submit", true);
					data.append("image", response);
					$.ajax({
						url: "functions.php",
						method: "post",
						data: data,
						contentType: false,
						processData: false,
						success: function(data){
							if(data != false){
								alert("Done...");
								$(".blank_after_submit, input[type='text']").val("");
							} else {
								alert("Please Try Again!");
							}
						}
					});

			    });
			});
		})
	</script>
</html>