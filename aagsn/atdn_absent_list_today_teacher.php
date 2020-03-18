<?php include "header.php"; ?>
<?php include "../nav-bar.php"; ?>

<div class="container">
    <?php
    // Attempt select query execution
    $sql = "SELECT * FROM teacher_info WHERE t_status='0' and NOT EXISTS (SELECT * FROM teach_attendance WHERE teach_attendance.ta_teach_id=t_id and teach_attendance.ta_date=CURRENT_DATE() ) ORDER BY t_id ASC ";
    $result = mysqli_query($link, $sql);?>
    
    <h2 align="center">Todays Absent Report <small> All Teacher</small></h2>
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
                            <th class="text-center" style="vertical-align:middle;"># Serial</th>
                            <th class="text-center" style="vertical-align:middle;">Id</th>
                            <th class="text-center" style="vertical-align:middle;">Name</th>
                            <th class="text-center" style="vertical-align:middle;">Designation</th>
                            <th class="text-center" style="vertical-align:middle;">Subject</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile No.</th>
                        </tr>
                        <?php  
                        $i=1;
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){?>
                        <tbody>
                            <tr>
                                <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['t_code']);?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['t_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['t_des']); ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['t_subject']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['t_phone']);}?></td>
                                <?php 
                                // Close result set
                                mysqli_free_result($result);
                            }else{?>
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