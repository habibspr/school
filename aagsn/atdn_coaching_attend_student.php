<?php include "header.php";?>
<?php include "../nav-bar.php";?>

<div class="container">
    <?php
    // Attempt select query execution
    $sql = "SELECT * FROM student_info, st_attendance, st_session, st_class where student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=st_class.sc_id AND st_attendance.at_st_id=student_info.st_id AND st_attendance.at_date=CURRENT_DATE() AND at_year=CURRENT_DATE() AND ss_year=CURRENT_DATE() AND at_outtime>='16:00:00' ORDER BY ss_class_id ASC, ss_roll ASC";
    $result = mysqli_query($link, $sql);?>
    <h2 align="center">Todays Attendance Report <small> All Students</small></h2>
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
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center" style="vertical-align:middle;">Sl. No.</th>
                            <th class="text-center" style="vertical-align:middle;">Student Name</th>
                            <th class="text-center" style="vertical-align:middle;">Class roll</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile No.</th>
                            <th class="text-center" style="vertical-align:middle;">Class</th>
                            <th class="text-center" style="vertical-align:middle;">In Time</th>
                            <th class="text-center" style="vertical-align:middle;">Out Time</th>
                        </tr>
                        <?php  
                        $i=1;
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){?>
                        <tbody>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['st_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ss_roll']); ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['st_mobile']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['sc_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['at_intime'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['at_outtime']);}?></td>
                                <?php 
                                // Close result set
                                mysqli_free_result($result);}else{?>
                                <div class="alert alert-info fade in">
                                    <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Notice!</strong> Not Found.
                                </div>
                                <?php }
                        } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);    
                            // Close connection
                            mysqli_close($link);
                        }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php";?>