<?php include "header.php";?>
<?php include "../nav-bar.php";?>

<div class="container">
	<div id = "fees_form">
		<h4 class="text-center"><strong>Prev. School Statistics</strong> </h4>
		<form class="form-horizontal" action="" role="form" method="post">
			<div class="form-group">               
				<div class="input-group input-group-sm">
					<span for="Session_Id" class="input-group-addon" id="sizing-addon1">Session </span>
					<select id="Session_Id" class="form-control selectpicker" data-mobile="true" name="Session_Id">
                                <?php 
								$sql="SELECT * FROM global_session_mst ORDER BY gsm_id DESC"; 
								foreach ($link->query($sql) as $row){									
                                    echo "<option value = '$row[gsm_id]'> $row[gsm_session] </option>";
                                } 
								?>                      
                            </select>
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
        var Session_Id = $("#Session_Id").val();
        var Class_Id = $("#Class_Id").val();
        
        $("#display_payable_fees").load("ac_school_statistics_form_report.php", {
            "Session_Id": Session_Id,
            "Class_Id": Class_Id
        });
		$("#fees_form").hide();
    });
});

</script>

<?php include 'footer.php';?>