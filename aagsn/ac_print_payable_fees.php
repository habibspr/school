
<?php include "../resources/db_aags_n.php" ;?>

<?php
$Counter=0;
$session_Id = 0; $class_Id=0;  
if($_REQUEST["session_Id"] ){
    $session_Id = $_REQUEST['session_Id'];
    $class_Id = $_REQUEST['class_Id'];
}

$result=mysqli_query($link, "SELECT * FROM global_session_mst, ac_head_mst, ac_session_mst 
            WHERE  gsm_session = '$session_Id'
            AND ac_sm_gsm_id = gsm_id
            AND ac_hm_id = ac_sm_ahm_id            
            AND ac_sm_class_id = $class_Id            
            ");
			
			
			
			$result_Class =mysqli_query($link, "SELECT * FROM st_class WHERE  sc_id = '$class_Id'");
			if(mysqli_num_rows($result_Class) > 0){
                    while($row = mysqli_fetch_array($result_Class)){
						$St_Class_Name = $row['sc_name'];
					}
			}
    ?>
    
    <div class="col-sm-12 row">
		<h4 class="text-center"><strong>Payable Fees</strong></h4>
		<p class="text-center"> Session : <?php echo "$session_Id";?> || Class : <?php echo "$St_Class_Name";?></p>
		<div class="table-responsive small">
			<table class="table table-bordered table-condensed table-striped table-hover">
				  
				<tr>
					<th class="text-center" style="vertical-align:middle;"># Serial</th>
					<th class="text-center" style="vertical-align:middle;">AC Head</th>
					<th class="text-center" style="vertical-align:middle;">Fees</th>
				</tr>        
				
				<?php    
				$i=1;
				if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){ 
						$Total_Amount = $Total_Amount + (int)$row['ac_sm_amount'];
						?>         
				
				<tr>
					<td class="text-center" style="vertical-align:middle;"><?php echo $row['ac_sm_ahm_id'];?></td>
					<td class="text-left" style="vertical-align:middle;"><?php echo $row['ac_hm_name'];?></td>
					<td class="text-right" style="vertical-align:middle; padding-right: 5%;"><?php echo money_format("%i",$row['ac_sm_amount']);}?></td>
				</tr>
				<tr>
					<th class="text-right" colspan = "2" style="vertical-align:middle;">Total</th>
					<th class="text-right" style="vertical-align:middle; padding-right: 5%;"><?php echo money_format("%i",$Total_Amount);?></th>
				</tr>
			</table>
		</div>
    <?php    }                
    ?>
	</div>
	
	