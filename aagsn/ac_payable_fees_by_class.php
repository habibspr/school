<?php include "header.php";?>
<?php include "../nav-bar.php";?>

<div class="container">
	<div id = "fees_form">
		<h2>Payable Fees</h2>
		<form class="form-horizontal" action="" role="form" id = "payable_fees_form">
			<div class="col-sm-6 col-lg-4">
				<div class="form-group">
					<label for="session_Id" class="col-md-4 control-label">Session :</label>
					<div class="col-md-8">
						<select id="session_Id" class="form-control selectpicker" data-mobile="true" name="session_Id">
							<?php 
							$sqlyear="SELECT distinct ss_year FROM st_session"; 
							foreach ($link->query($sqlyear) as $row){
								echo "<option value='$row[ss_year]'>$row[ss_year] </option>";
							}
							?>            
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="form-group">
					<label for="Class" class="col-md-4 control-label">Class :</label>
					<div class="col-md-8">
						<select id="class_Id" class="form-control selectpicker" data-mobile="true" name = "class_Id">
							<?php 
							$sql="SELECT * FROM st_class"; 
							foreach ($link->query($sql) as $row){
								echo "<option value = '$row[sc_id]' > $row[sc_name] </option>";
							} ?>            
						</select>
					</div>
				</div>
			</div> 
			<div class="col-sm-6 col-lg-1">
					<div class="form-group">
						<div class="col-md-2">
							<button type="button" id="search" name="search" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Search</span></button>
						</div>
					</div>
				</div>
		</form><!-- End Form-->
	</div> 
	<div id ="display_payable_fees"></div>
</div><!--end Container -->

<script type="text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

// start form here 
$(document).ready(function() {
    $("#search").click(function(event){
		event.preventDefault();
        var session_Id = $("#session_Id").val();
        var class_Id = $("#class_Id").val();
        
        $("#display_payable_fees").load("ac_print_payable_fees.php", {
            "session_Id": session_Id, 
            "class_Id": class_Id
        });
		$("#fees_form").hide();
    });
});

</script>

<?php include 'footer.php';?>