<?php include "header.php";?>
<?php include "../nav-bar.php";?>

<div class="container">
	<div id = "fees_form">
		<h4 class="text-center"><strong>Invoice Receive Summary</strong> </h4>
		<form class="form-horizontal" action="" role="form" method="post">
			<div class="form-group">               
				<div class="input-group input-group-sm">
					<span for="Session" class="input-group-addon" id="sizing-addon1">User </span>
					<select id="User_Id" class="form-control selectpicker" data-mobile="true" name="User_Id">
                                <option value = "All" >All</option>
								<?php 
								$sql="SELECT DISTINCT t_id, t_code, t_name FROM teacher_info, ac_cash_receive_dtl WHERE t_id=ac_crd_ref_id"; 
								foreach ($link->query($sql) as $row){									
                                    echo "<option value = '$row[t_id]'> $row[t_code] . $row[t_name] </option>";
                                } 
								?>                      
                            </select>
				</div>
			</div>
			<div class="form-group">               
				<div class="input-group input-group-sm">
					<span for="Session" class="input-group-addon" id="sizing-addon1">Date from </span>
						<input type = "date" class="form-control" id = "start_Date" value = "<?php echo date('Y-m-01');?>" name = "start_Date"/>
				</div>
			</div>
			<div class="form-group">               
				<div class="input-group input-group-sm">
					<span for="Session" class="input-group-addon" id="sizing-addon1">Date to </span>
					<input type = "date" class="form-control" id = "end_Date" value = "<?php echo date('Y-m-d');?>" name = "end_Date"/>
				</div>
			</div>
			<div class="form-group">
				<button type = "button" class="btn btn-lg btn-block btn-primary" id = "search" aria-describedby="sizing-addon1"> Submit </button>
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
        var User_Id = $("#User_Id").val();
        var start_Date = $("#start_Date").val();
		var end_Date = $("#end_Date").val();
        
        $("#display_payable_fees").load("ac_print_collection.php", {
            "User_Id": User_Id,
            "start_Date": start_Date,
			"end_Date": end_Date
        });
		$("#fees_form").hide();
    });
});

</script>

<?php include 'footer.php';?>