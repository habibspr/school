<?php include "header.php";?>
<?php include "../nav-bar.php";?>

<div class="container">
    <?php
    // Attempt select query execution
    $sql = "SELECT * FROM teach_attendance WHERE ta_date=CURRENT_DATE()";
    $result = mysqli_query($link, $sql);?>
    <h2 align="center">Todays Attendance Report <small> All Teacher</small></h2>
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
                            <th class="text-center" style="vertical-align:middle;">Photo</th>
                            <th class="text-center" style="vertical-align:middle;">Name</th>
                            <th class="text-center" style="vertical-align:middle;">Designation</th>
                            <th class="text-center" style="vertical-align:middle;">Subject</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile No.</th>
                            <th class="text-center" style="vertical-align:middle;">In Time</th>
                            <th class="text-center" style="vertical-align:middle;">Out Time</th>
                        </tr>
                        <?php  
                        $i=1;
                        $result = mysqli_query($link, "SELECT * FROM teacher_info, teach_attendance WHERE ta_teach_id=t_id AND ta_date=CURRENT_DATE() ORDER BY ta_intime DESC");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){?>
                        <tbody>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><img src="../images/teachers/<?php echo ($row['t_id']);?>.jpg" class="img-thumbnail" alt="No Photo" width="50" height="50"></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['t_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['t_des']); ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['t_subject']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['t_phone']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ta_intime']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ta_outtime']);}?></td>
                                <?php 
                                // Close result set
                                mysqli_free_result($result);}else{?>
                                <div class="alert alert-info fade in">
                                    <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Notice!</strong> Not Found.
                                </div>
                                <?php }
                        
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