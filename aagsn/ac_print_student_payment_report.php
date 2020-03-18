
<?php include "../resources/db_aags_n.php" ;?>

<?php
$start_Date = 0; $end_Date = 0;  
if($_REQUEST["Session_Id"] ){
    $Session_Id = $_REQUEST['Session_Id'];
    $Class_Id = $_REQUEST['Class_Id'];
	}
	
	// user info query
	$S_result=mysqli_query($link, "SELECT * FROM global_session_mst WHERE gsm_id = '$Session_Id' ");
	$S_info = mysqli_fetch_assoc($S_result);
	$Global_Session = $S_info['gsm_session'];

    // Session info Query
	$C_result=mysqli_query($link, "SELECT * FROM st_class WHERE sc_id = '$Class_Id'  ");
	$C_info = mysqli_fetch_assoc($C_result);
    $Class_name= $C_info['sc_name'];
	
	// dues amount 
	$TotalPayable=0;
	$result_Payable=mysqli_query($link, "SELECT SUM(ac_sm_amount) AS TotalPayable FROM ac_session_mst WHERE ac_sm_class_id ='$Class_Id'");
                $rowPayable = mysqli_fetch_assoc($result_Payable); 
                $TotalPayable = (int) $rowPayable['TotalPayable'];
	
	
	
	// Searching Student Info SELECT SUM(Quantity) AS TotalItemsOrdered FROM OrderDetails;
    
	if ($Class_Id == 'All') {
		$result=mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_parents_info, global_session_mst
            WHERE st_id = ss_st_id 
			AND stpi_st_id = st_id
			AND ss_class_id = sc_id
            AND ss_year = gsm_session
			AND EXISTS (SELECT DISTINCT ac_crd_st_id, ac_crd_gsm_id FROM ac_cash_receive_dtl)ORDER BY sc_id ASC, st_id ASC		
			");
		}else{
			$result=mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_parents_info, global_session_mst
            WHERE st_id = ss_st_id
			AND stpi_st_id = st_id
			AND ss_class_id = sc_id
			AND ss_class_id = '$Class_Id'
            AND ss_year = gsm_session 
            AND st_status = '0'
			AND EXISTS (SELECT DISTINCT ac_crd_st_id, ac_crd_gsm_id FROM ac_cash_receive_dtl) ORDER BY st_id, sc_id
			");}
			?>
			
			<div class="col-sm-12 row">
				<h4 class="text-center"><strong>Payment Summary Report</strong></h4>
				<p class="text-center"> 
						<strong> Session </strong> <?php echo $Global_Session;?>
					<?php if ($Class_Id == 'All') {?>
						<strong>All Classes</strong>
					<?php }else { ?>
							<strong> Class </strong> <?php echo $Class_name;?>
					<?php } ?>
			</p>
			
			<?php 
			if(mysqli_num_rows($result) > 0){
				?>
				<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-hover">
				<tr>
					<th class="text-center" style="vertical-align:middle;"># Serial</th>
					<th class="text-center" style="vertical-align:middle;">Id</th>
					<th class="text-center" style="vertical-align:middle;">Name</th>
					<th class="text-center" style="vertical-align:middle;">Father</th>
					<th class="text-center" style="vertical-align:middle;">Class</th>
					<th class="text-center" style="vertical-align:middle;">Roll</th>
					<th class="text-center" style="vertical-align:middle;">Mobile no.</th>
					<th class="text-center" style="vertical-align:middle;">Paid (BDT)</th>
					<th class="text-center" style="vertical-align:middle;">Dues (BDT)</th>
				</tr>        
				
				<?php    
            $Counter=1; $GrandTotalAmount = 0;
            
            while ($S_info = mysqli_fetch_array($result)) {
                $Student_Id= $S_info['st_id'];
                $PaidAmount = 0;
                $result_sum=mysqli_query($link, "SELECT SUM(ac_crd_amount) AS PaidAmount FROM ac_cash_receive_dtl WHERE ac_crd_st_id ='$Student_Id'");
                $rowSum = mysqli_fetch_assoc($result_sum); 
                $PaidAmount = (int) $rowSum['PaidAmount'];
                $TotalAmountSum = $TotalAmountSum + (int)$rowSum['PaidAmount'];
				$DuesAmount = $TotalPayable - $PaidAmount;
				$TotalDuesAmount = $TotalDuesAmount + $DuesAmount;
                 
                ?>         
				
				<tr>
					<td class="text-center" style="vertical-align:middle;"><?php echo $Counter++;?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $S_info['st_code'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $S_info['st_name'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $S_info['stpi_st_father_name'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $S_info['sc_name'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $S_info['ss_roll'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $S_info['st_mobile'];?></td>
					<td class="text-right" style="vertical-align:middle; padding-right: 3%;">
					<?php if (!$PaidAmount){
						echo "<font color='red'>".money_format("%i",$PaidAmount)."</font>"; 
					}else{ 
						echo money_format("%i",$PaidAmount);
			} ?>
					
					</td>
					<td class="text-right" style="vertical-align:middle; padding-right: 3%;"><?php echo money_format("%i",$DuesAmount);}?></td>
				</tr>
				<tr>
					<th class="text-right" colspan = "7" style="vertical-align:middle;">Total</th>
					<th class="text-right" style="vertical-align:middle; padding-right: 3%;"><?php echo money_format("%i",$TotalAmountSum);?></th>
					<th class="text-right" style="vertical-align:middle; padding-right: 3%;"><?php echo money_format("%i",$TotalDuesAmount);?></th>
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
	
	