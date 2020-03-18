<!-- attendance report by students -->
<?php include "header.php";?>
<?php include '../nav-bar.php';?>


<div class="container">
    <?php
    if(isset($_POST['session'])){ // Fetching variables of the form which travels in URL
        $class=$_POST['class']; //sc_id
        $session = $_POST['session'];//Year
        $roll=$_POST['roll'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        
        // Off Days
        $resultOffdays = mysqli_query($link, "SELECT * FROM at_calendar WHERE atc_date BETWEEN '$startdate' AND  '$enddate' and atc_year='$session' and atc_status='0'");
        $OffDays = mysqli_num_rows($resultOffdays);
        
        //Calculateing Working Days --------------------------------------------------//
        $StartDate=date_create("$startdate");
        $EndDate=date_create("$enddate");
        $DateDiff = $EndDate->diff($StartDate)->format("%a");
        $workingDays=$DateDiff-$OffDays;
        //------------------------------------------------------------------//
        
        //searching student code        
        $studentid=0;
        $resultstudentid=mysqli_query($link, "SELECT * FROM student_info, st_session, st_class WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=$class AND st_class.sc_id=st_session.ss_class_id AND st_session.ss_roll='$roll' AND st_session.ss_year='$session' ");
        while($row = mysqli_fetch_array($resultstudentid)){
            $studentid=$row['st_id'];
        }
                
        $i=1;
        if($studentid !=0){
            if($result = mysqli_query($link, "SELECT * FROM st_attendance WHERE at_date BETWEEN '$startdate' AND  '$enddate' and at_st_id='$studentid' AND at_year='$session'")){
                if(mysqli_num_rows($result) > 0){
    ?>
    <div class="page-header">
        <h1>Student Attendance Details</h1>
    </div>
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                    Personal Details: 
                </div>
                <div class="panel-body">
                    <?php
                    $sql ="SELECT * FROM student_info, st_session ,st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=$class AND st_class.sc_id=$class AND st_session.ss_group_id=st_group.sg_id AND st_id='$studentid' AND ss_year=$session";
                    $result =mysqli_query($link, $sql);
                    while($rows = mysqli_fetch_array($result)) {
                            
                            ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            
                            <tr>
                                <th class="text-right" style="vertical-align:middle;">Name</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $rows['st_name'];?></td>
                                <th class="text-right" style="vertical-align:middle;">Class</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $rows['sc_name'];?></td>
                                <th class="text-right" style="vertical-align:middle;">Roll</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $rows['ss_roll'];?></td>
                                <th class="text-right" style="vertical-align:middle;">Group</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $rows['sg_group'];?></td>
                                <th class="text-right" style="vertical-align:middle;">Session</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $rows['ss_year'];}?></td>
                            </tr>
                            <tr>
                                <th class="text-right" style="vertical-align:middle;">Year</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $session;?></td>
                                <th class="text-right" style="vertical-align:middle;">From </th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $startdate ;?></td>
                                <th class="text-right" style="vertical-align:middle;">To</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $enddate ;?></td>
                                <th class="text-right" style="vertical-align:middle;">Working days</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $workingDays;?></td>
                                <th class="text-right" style="vertical-align:middle;">Attendance</th>
                                <th class="text-center" style="vertical-align:middle;">:</th>
                                <td class="text-left" style="vertical-align:middle;"><?php //Attendance Count
                    $resultattendance = mysqli_query($link, "SELECT * FROM st_attendance WHERE at_date BETWEEN '$startdate' AND '$enddate' AND at_st_id='$studentid' and at_year='$session' AND at_intime<='12:00:00'");
                    echo $attendancecount = mysqli_num_rows($resultattendance);?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Row Student Details--> 
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-calendar">
                        Attendance Details:
                        <span class="badge"></span>
                        </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                                <th class="text-center" style="vertical-align:middle;">Sl. No.</th>
                                <th class="text-center" style="vertical-align:middle;">Date</th>
                                <th class="text-center" style="vertical-align:middle;">In Time</th>
                                <th class="text-center" style="vertical-align:middle;">Out Time</th>        
                            </tr>
                            <?php 
                    $result = mysqli_query($link, "SELECT * FROM st_attendance WHERE at_date BETWEEN '$startdate' AND  '$enddate' and at_st_id='$studentid' and at_year='$session' ORDER BY at_date ASC");
                    while($row = mysqli_fetch_array($result)){?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['at_date']; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['at_intime'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['at_outtime'];}?></td>
                                <?php }else{ 
                    // Close result set
                    mysqli_free_result($result);
                                ?>
                                <div class="alert alert-info fade in">
                                    <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Notice!</strong> ............... No Data Found!
                                </div>
                                <?php 
                } 
            }
        }else{ 
                                ?>
                                <div class="alert alert-danger fade in">
                                    <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                                    <strong>Danger!</strong> ............... Blank Id
                                </div>
                                <?php // Close connection
            mysqli_close($link);
        }
    }
                                ?>
                            </tr>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end Container -->
<?php include 'footer.php';?>
