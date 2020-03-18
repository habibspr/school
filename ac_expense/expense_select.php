<?php include "../resources/db_aags_n.php" ;

session_start();
$ref_id = $_SESSION["login_id"];

$admin_User=2;

$i=1;
$resultleave = mysqli_query($link, "SELECT * FROM ac_expense_dtl, ac_head_mst, supplier_mst WHERE ace_ach_id=ac_hm_id AND ace_sm_id=sm_id");
?>
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-condensed">  
        <tr class="text-success">
            <th class="text-center" style="vertical-align:middle;"># Serial</th>
            <th class="text-center" style="vertical-align:middle;">Date </th>
            <th class="text-center" style="vertical-align:middle;">MR No. </th>
            <th class="text-center" style="vertical-align:middle;">Supplier</th>
            <th class="text-center" style="vertical-align:middle;">Ac Head </th>
            <th class="text-center" style="vertical-align:middle;">Amount </th>
            <th class="text-center" style="vertical-align:middle;">Description </th>
            <th class="text-center" style="vertical-align:middle;">Creator </th>
            <th class="text-center hidden-print" style="vertical-align:middle;">Action</th> 
        </tr> 
        <?php
        if(mysqli_num_rows($resultleave) > 0){  
            while($row = mysqli_fetch_array($resultleave)){  
  
                                                            $user_id=$row["ace_user_id"];
                                                            $approval_status=$row["ace_approval_status"];
  
                                                            $resultuser = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_id='$user_id'");
                                                 
                                                            while($rowuser = mysqli_fetch_array($resultuser)){
                                                                                                                $userName=$rowuser["t_name"]; 
                                                                                                                } ?>
        <tr>  
             <td style="vertical-align:middle;"><?php echo $i++;?></td>  
             <td style="vertical-align:middle;"><?php echo $row["ace_date"];?></td>  
             <td style="vertical-align:middle;"><?php echo $row["ace_mr_no"];?></td>  
             <td style="vertical-align:middle;"><?php echo $row["sm_name"];?></td>  
             <td style="vertical-align:middle;"><?php echo $row["ac_hm_name"];?></td>  
             <td style="vertical-align:middle;"><?php echo $row["ace_amount"];?></td>
             <td style="vertical-align:middle;"><?php echo $row['ace_comments'];?></td> 
             <td style="vertical-align:middle;"><?php echo $userName;?></td>
             <td class="text-center hidden-print" style="vertical-align:middle;">
            <?php if( ($ref_id==$user_id) && ($approval_status==0) ){ ?>
             <button type="button" name="delete_btn" data-id_delete="<?php echo $row["ace_id"];?>" class="btn btn-xs btn-danger btn_delete"><span class="glyphicon glyphicon-trash"></span></button>
             
             <?php } if(($ref_id==2) && ($approval_status==0)){ ?>                     
             <button type="button" name="btn_approved" data-approved="<?php echo $row["ace_id"];?>" class="btn btn-xs btn-info btn_approved"><span class="glyphicon glyphicon-ok"></span></button>
             
             <?php } if(($ref_id==2) && ($approval_status==1)){ ?>
             <button type="button" name="btn_unapproved" data-unapproved="<?php echo $row["ace_id"];?>" class="btn btn-xs btn-info btn_unapproved"><span class="glyphicon glyphicon-menu-left"></span></button>
             
             </td>
             <?php } 
            }
            }else{ ?>
        </tr>
            
        <tr>  
            <td colspan="4">Data not Found</td>  
        </tr>
        <?php } ?>
        <tr>
            <th class="text-right text-success" colspan="5">Total</th>
            <th class="text-left text-success"><?php $resultTotalAmount = mysqli_query($link, "SELECT SUM(`ace_amount`) AS TotalAmount FROM `ac_expense_dtl`"); while($row = mysqli_fetch_array($resultTotalAmount)){echo $row['TotalAmount'];}?></th>
        </tr>
    <table> 
</div>