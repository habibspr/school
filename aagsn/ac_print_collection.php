
<?php include "../resources/db_aags_n.php" ;?>

<?php
$start_Date = 0; $end_Date = 0;  
if($_REQUEST["User_Id"] ){
    $User_Id = $_REQUEST['User_Id'];
    $start_Date = $_REQUEST['start_Date'];
    $end_Date = $_REQUEST['end_Date'];
	}
	
	// user info query
	$u_result=mysqli_query($link, "SELECT * FROM teacher_info WHERE t_id = '$User_Id'  ");
	$user_info = mysqli_fetch_assoc($u_result);
	$user_code = $user_info['t_code'];
	$user_name = $user_info['t_name'];
	
	
	if ($User_Id == 'All') {
		$result=mysqli_query($link, "SELECT * FROM ac_cash_receive_dtl, student_info WHERE DATE(ac_crd_date) >= '$start_Date' AND DATE(ac_crd_date) <= '$end_Date' AND st_id=ac_crd_st_id ORDER BY ac_crd_mr_no DESC ");
		}else{
			$result=mysqli_query($link, "SELECT * FROM ac_cash_receive_dtl, student_info WHERE ac_crd_ref_id = '$User_Id' AND DATE(ac_crd_date) >= '$start_Date' AND DATE(ac_crd_date) <= '$end_Date' AND st_id=ac_crd_st_id ORDER BY ac_crd_mr_no DESC ");
			}
			?>
    
    <div class="col-sm-12 row">
	<h4 class="text-center"><strong>Invoice Summary Report</strong> </h4>
	
		<p class="text-center"> 
		 
		<?php if ($User_Id == 'All') {?>
		<strong>All </strong>Users
		<?php }else { ?>
		<strong> User </strong> <?php echo $user_code;?> <strong> - </strong> <?php echo $user_name;?>
		<?php } ?>
		<strong> From </strong> <?php echo "$start_Date";?> <strong> to </strong> <?php echo "$end_Date"; ?>
		</p>
		
		<?php if(mysqli_num_rows($result) > 0){ ?>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-hover">
				<tr>
					<th class="text-center" style="vertical-align:middle;"># Serial</th>
					<th class="text-center" style="vertical-align:middle;">Date</th>
					<th class="text-center" style="vertical-align:middle;">Mr. No.</th>
					<th class="text-center" style="vertical-align:middle;">Student Id</th>
					<th class="text-center" style="vertical-align:middle;">Student Name</th>
					<th class="text-center" style="vertical-align:middle;">Amount (BDT)</th>
				</tr>        
				
				<?php    
				$Counter=1; $Total_Amount = 0;
				
						while($row = mysqli_fetch_array($result)){ 
						$Total_Amount = $Total_Amount + (int)$row['ac_crd_amount'];
						
						?>         
				
				<tr>
					<td class="text-center" style="vertical-align:middle;"><?php echo $Counter++;?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $row['ac_crd_date'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $row['ac_crd_mr_no'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $row['st_code'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></td>
					<td class="text-right" style="vertical-align:middle; padding-right: 5%;"><?php echo money_format("%i",$row['ac_crd_amount']);}?></td>
				</tr>
				<tr>
					<th class="text-right" style="vertical-align:middle;" colspan = "5" >Total</th>
					<th class="text-right" style="vertical-align:middle; padding-right: 5%;"><?php echo money_format("%i", $Total_Amount);?></th>					
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
	
	