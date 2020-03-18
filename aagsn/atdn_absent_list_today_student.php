<?php include "header.php"; ?>
<?php include "../nav-bar.php"; ?>

<div class="container">
    <?php
    // Attempt select query execution
    $sql = "SELECT * FROM student_info, st_session, st_group, st_class WHERE st_status='0' AND student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=st_class.sc_id AND st_session.ss_group_id=st_group.sg_id AND ss_year=CURRENT_DATE() AND NOT EXISTS (SELECT * FROM st_attendance WHERE st_attendance.at_st_id=student_info.st_id AND st_attendance.at_date=CURRENT_DATE() AND at_intime<='12:00:00' ) ORDER BY st_session.ss_class_id ASC, st_session.ss_roll ASC ";
    $result = mysqli_query($link, $sql);?>
    
    <h2 align="center">Todays Absent Report <small> All Students</small></h2>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
                <?php echo "".date('l -  d M, Y'). " ";?>
                <span class="badge">
                <?php
                // Rows Count
                $rows = mysqli_num_rows($result);
                echo "" . $rows ." ";
                ?>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered" >
                        <tr>
                            <th class="text-center" style="vertical-align:middle;">SL No.</th>
                            <th class="text-center" style="vertical-align:middle;">Student Name</th>
                            <th class="text-center" style="vertical-align:middle;">Roll</th>
                            <th class="text-center" style="vertical-align:middle;">Sex</th>
                            <th class="text-center" style="vertical-align:middle;">Session</th>
                            <th class="text-center" style="vertical-align:middle;">Class</th>
                            <th class="text-center" style="vertical-align:middle;">Group</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile No</th>
                            <th class="text-center" style="vertical-align:middle;">Status</th>
                        </tr>
                        <?php  
                        $i=1;
                        if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){ 
                                $Studentid=$row['st_id'];
                                ?>
                        <tbody>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['st_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ss_roll']); ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php if($row['st_sex']==1){echo "Female"; }else{ echo "Male";}?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ss_year']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['sc_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['sg_group']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['st_mobile']);?></td>
                                <td class="text-center" style="vertical-align:middle; color:red;">
                                <?php 
                                $resultStatus = mysqli_query($link, "SELECT * FROM st_leave WHERE sl_st_id=$Studentid");
                                if(mysqli_num_rows($resultStatus) > 0){
                                while($row = mysqli_fetch_array($resultStatus)){ echo "Leave"; }
                                }else{echo "No data Found";}
                                ?>
                                </td>
                                <?php 
                                }
                                // Close result set
                                mysqli_free_result($result);
                            }else{?>
                                <div class="alert alert-info fade in">
                                    <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Notice!</strong> Not Found.
                                </div>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php";?>