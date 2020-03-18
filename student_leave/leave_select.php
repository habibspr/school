
<?php include "../resources/db_aags_n.php" ;

session_start();
$ref_id = $_SESSION["login_id"];


$i=1;

$resultleave = mysqli_query($link, "SELECT * FROM student_info, st_leave, st_class, st_session WHERE sl_st_id=st_id AND student_info.st_id=st_session.ss_st_id AND st_class.sc_id=st_session.ss_class_id AND st_session.ss_year=CURRENT_DATE() ORDER BY sl_id DESC");
                ?>
      <div class="table-responsive">  
           <table class="table table-bordered table-hover table-striped table-condensed">  
                <tr>
                    <th class="text-center" style="vertical-align:middle;">Sl. No.</th>
                    <th class="text-center" style="vertical-align:middle;">Name </th>
                    <th class="text-center" style="vertical-align:middle;">Class </th>
                    <th class="text-center" style="vertical-align:middle;">Roll </th>
                    <th class="text-center" style="vertical-align:middle;">From </th>
                    <th class="text-center" style="vertical-align:middle;">To </th>
                    <th class="text-center" style="vertical-align:middle;">Comments</th>   
                    <th class="text-center" style="vertical-align:middle;">Creator</th>   
                    <th class="text-center hidden-print" style="vertical-align:middle;">Action</th> 
                </tr> 
                <?php
                if(mysqli_num_rows($resultleave) > 0){  
                    while($row = mysqli_fetch_array($resultleave)){  
          
                                                                    $user_id=$row["sl_user_id"];
                                                                    $approval_status=$row["sl_approval_status"];
          
                                                                    $resultuser = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_id='$user_id'");
                                                         
                                                                    while($rowuser = mysqli_fetch_array($resultuser)){
                                                                                                                        $userName=$rowuser["t_name"]; 
                                                                                                                        } ?>
                <tr>  
                     <td style="vertical-align:middle;"><?php echo $i++;?></td>  
                     <td style="vertical-align:middle;"><?php echo $row["st_name"];?></td>  
                     <td style="vertical-align:middle;"><?php echo $row["sc_name"];?></td>  
                     <td style="vertical-align:middle;"><?php echo $row["ss_roll"];?></td>
                     <td style="vertical-align:middle;"><?php echo $row["sl_leave_start_date"];?></td> 
                     <td style="vertical-align:middle;"><?php echo $row['sl_leave_end_date'];?></td> 
                     <td style="vertical-align:middle;"><?php echo $row['sl_comments'];?></td> 
                     <td style="vertical-align:middle;"><?php echo $userName;?></td>
                     <td class="text-center hidden-print" style="vertical-align:middle;">
                    <?php if( ($ref_id==$user_id) && ($approval_status==0) ){ ?>
                     <button type="button" name="delete_btn" data-id_delete="<?php echo $row["sl_id"];?>" class="btn btn-xs btn-danger btn_delete"><span class="glyphicon glyphicon-trash"></span></button>
                     
                     <?php } if(($ref_id==2) && ($approval_status==0)){ ?>                     
                     <button type="button" name="btn_approved" data-approved="<?php echo $row["sl_id"];?>" class="btn btn-xs btn-info btn_approved"><span class="glyphicon glyphicon-ok"></span></button>
                     
                     <?php } if(($ref_id==2) && ($approval_status==1)){ ?>
                     <button type="button" name="btn_unapproved" data-unapproved="<?php echo $row["sl_id"];?>" class="btn btn-xs btn-info btn_unapproved"><span class="glyphicon glyphicon-menu-left"></span></button>
                     
                     </td>
                     <?php      }
                            }
                        }else{ 
                    ?>
                </tr>
                
                <tr>  
                    <td colspan="4">Data not Found</td>  
                </tr>
                <?php } ?>
            <table> 
      </div>