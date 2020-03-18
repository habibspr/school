
<?php include "../resources/db_aags_n.php" ;?>

<?php
$start_Date = 0; $end_Date = 0;  
if($_REQUEST["Session_Id"] ){
    $Session_Id = $_REQUEST['Session_Id'];
	}
	
	// user info query
	$S_result=mysqli_query($link, "SELECT * FROM global_session_mst WHERE gsm_id = '$Session_Id' ");
	$S_info = mysqli_fetch_assoc($S_result);
	$Global_Session = $S_info['gsm_session'];

	// Searching Student Info SELECT SUM(Quantity) AS TotalItemsOrdered FROM OrderDetails;
    
	
		$result=mysqli_query($link, "SELECT DISTINCT stpai_school_name FROM st_previous_academic_info ORDER BY stpai_school_name ASC");
		
			?>
			
			<div class="col-sm-12 row">
				<h4 class="text-center"><strong>Prev. School Statistics</strong></h4>
				<p class="text-center"> <strong> Session </strong> <?php echo $Global_Session;?></p>
			
			<?php 
			if(mysqli_num_rows($result) > 0){
				?>
				<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-hover">
				<tr>
					<th class="text-center" style="vertical-align:middle;"># Serial</th>
					<th class="text-center" style="vertical-align:middle;">School Name</th>
					<th class="text-center" style="vertical-align:middle;">Qty.</th>
				</tr>        
				
				<?php    
            $Counter=1; 
            
            while ($S_info = mysqli_fetch_array($result)) {
				$School_Name =  $S_info['stpai_school_name'];
				$StudentCount = 0 ; 
				$resultStudentCount=mysqli_query($link, "SELECT count(stpai_st_id) AS StudentCount FROM st_previous_academic_info WHERE stpai_school_name = '$School_Name' ");
				$rowCount = mysqli_fetch_assoc($resultStudentCount); 
                $StudentCount = (int)$rowCount['StudentCount'];			
                $TotalStudentCount = $TotalStudentCount + (int)$rowCount['StudentCount'];;			
                 
                ?>         
				
				<tr>
					<td class="text-center" style="vertical-align:middle;"><?php echo $Counter++;?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $S_info['stpai_school_name'];?></td>
					<td class="text-right" style="vertical-align:middle; padding-right: 3%;"><?php echo $StudentCount;}?></td>
				</tr>
				<tr>
					<th class="text-right" colspan = "2" style="vertical-align:middle;">Total</th>
					<th class="text-right" style="vertical-align:middle; padding-right: 3%;"><?php echo $TotalStudentCount;?></th>
				</tr>
			</table>
		</div>
		<?php    }else{  ?>
		<div class="alert alert-success fade in">
		<strong>Warning !</strong> No data found ......
		</div>
		<?php die(); }                
		?>
	</div>	
	
	