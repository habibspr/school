<h1 class="text-center">All Students</h1>
<table class="table table-bordered">
	<thead>
	  <tr>
	    <th>ID</th>
	    <th>Name</th>
	    <th>Roll</th>
	  </tr>
	</thead>
	<tbody>


<?php

	//start all codes
	include("../resources/db_aags_n.php");

	if(isset($_POST["search_form_submit"])){
		$ss = $_POST["st_session"];
		$class = $_POST["st_class"];
		$group = $_POST["st_group"];
		$st_id_query = mysqli_query($link, "SELECT * FROM st_session, student_info WHERE ss_year = '$ss' AND ss_class_id = '$class' AND ss_group_id = '$group' AND st_id = st_session.ss_st_id");

		//checking if data is present
		if(mysqli_num_rows($st_id_query) == 0){
			echo false;
			die();
		}
		while($st_id_result = mysqli_fetch_assoc($st_id_query)){?>
			      <tr>
			        <td><?php echo $st_id_result["st_code"];?></td>
			        <td><?php echo $st_id_result["st_name"];?></td>
			        <td><input id="<?php echo $st_id_result["st_id"];?>" class="roll_input" type="text" name="roll" value="<?php echo $st_id_result["ss_roll"];?>"></td>
			      </tr>
		<?php }
	}

?>
	</tbody>
</table>
<script type="text/javascript" src="../dist/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.roll_input').keypress(function (e){
			var get_field = $(this);
		  if (e.which == 13) {
		    var roll = get_field.val();
		    var st_id = get_field.attr("id");
		    var ss = <?php echo $ss;?>;

		    //ajax

		    $.ajax({
				url: "functions.php",
				method: "post",
				data: {"roll": roll, "st_id": st_id, "ss_year": ss},
				success: function(data){
					alert(data);
					get_field.parent().parent().css("display","none");
					get_field.parent().parent().next("tr").children("td").children("input").focus();
				}
			});


		  }
		});
	});
</script>