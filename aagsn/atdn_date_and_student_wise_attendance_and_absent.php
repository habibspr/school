<!-- Date and Class wise Attend / Absent Report -->
<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">    

<?php
    if(isset($_POST['class'])){ // Fetching variables of the form which travels in URL
        $class = $_POST['class'];
        $absent_attend = $_POST['absent_attend'];
        $date = $_POST['date'];
        $datei = strtotime($date);
        $day = date("l", $datei);
        $Session=date('Y');
        //Class Searching  //////////////////////////////////////////////////
        $resultclass = mysqli_query($link, "SELECT * FROM st_class WHERE st_class.sc_id='$class' ");
        while ($row = mysqli_fetch_array($resultclass)){
            $classname= $row['sc_name'];
        }
        
        
        $i=1;
        if($class !=''){
            
            if($absent_attend=='Absent'){           
                // Attempt select query execution
                $sql = "SELECT * FROM student_info, st_session, st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_group_id=st_group.sg_id AND st_session.ss_class_id=st_class.sc_id AND st_class.sc_id='$class' AND  student_info.st_status='0' AND ss_year=$Session AND NOT EXISTS (SELECT * FROM st_attendance WHERE st_attendance.at_st_id=student_info.st_id AND st_attendance.at_date='$date' AND at_year=$Session AND at_intime<='12:00:00' ) ORDER by st_session.ss_roll ASC ";
                $result = mysqli_query($link, $sql);?>    
    <h2 align="center">Absent Report : <small><?php  echo $classname;?></small> </h2>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
                <?php echo "Date : " .$day. ",  "  .$date. "" ;?>
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
                            <th>Sl. No.</th>
                            <th>Student Name</th>
                            <th>Roll</th>
                            <th>Session</th>
                            <th>Class</th>
                            <th>Group</th>
                            <th>Section</th>
                            <th>Mobile No</th>
                            <th>Remarks</th>
                        </tr>
                        <?php  
                $i=1;
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                        $Studentid=$row['st_id'];
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo ($row['st_name']);?></td>
                                <td><?php echo ($row['ss_roll']); ?></td>
                                <td><?php echo ($row['ss_year']);?></td>
                                <td><?php echo ($row['sc_name']);?></td>
                                <td><?php echo ($row['sg_group']);?></td>
                                <td><?php if($row['ss_section_id']==1){ echo "A";}else{echo "B";}?></td>
                                <td><?php echo ($row['st_mobile']);}?></td>
                                <td style="color:red;">
                                    <?php 
                                $resultStatus = mysqli_query($link, "SELECT * FROM st_leave WHERE sl_st_id=$Studentid");
                                if(mysqli_num_rows($resultStatus) > 0){
                                while($row = mysqli_fetch_array($resultStatus)){ echo "Leave"; }
                                }else{echo "No data Found";}
                                ?>
                                </td>
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
    <?php   }else{      
                // Attempt select query execution
                $sql = "SELECT * FROM student_info, st_attendance, st_session, st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_group_id=st_group.sg_id AND st_session.ss_class_id='$class' AND st_class.sc_id=st_session.ss_class_id AND  student_info.st_status='0' AND st_attendance.at_st_id=student_info.st_id AND st_attendance.at_date='$date' AND ss_year=$Session AND at_year=$Session AND at_intime<='12:00:00' ORDER BY st_session.ss_roll ASC";
                $result = mysqli_query($link, $sql);?>
    <h2 align="center">Attendance Report : <small><?php echo $classname;?></small> </h2>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
                <?php echo "Date : " .$day. ",  "  .$date. "" ;?>
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
                            <th class="text-center" style="vertical-align:middle;">Roll</th>
                            <th class="text-center" style="vertical-align:middle;">Session</th>
                            <th class="text-center" style="vertical-align:middle;">Class</th>
                            <th class="text-center" style="vertical-align:middle;">Group</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile</th>
                            <th class="text-center" style="vertical-align:middle;">In Time</th>
                            <th class="text-center" style="vertical-align:middle;">Out Time</th>
                        </tr>
                        <?php  
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){?>
                        <tbody>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['st_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ss_roll']); ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ss_year']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['sc_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['sg_group']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['st_mobile']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['at_intime']);?></td>
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
    <?php
            }
        }        
    }
    ?>
</div><!--end Container -->
<?php include 'footer.php';?>
