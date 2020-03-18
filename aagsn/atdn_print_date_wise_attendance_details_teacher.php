<!-- attendance report by students -->
<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <?php
    if(isset($_POST['session'])){ // Fetching variables of the form which travels in URL
        $session = $_POST['session']; 
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $teacherid = $_POST['teacher'];
        
       // Teacher id search
        $teachersearch = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_id='$teacherid'");
         if(mysqli_num_rows($teachersearch) > 0){
             while($row = mysqli_fetch_array($teachersearch)){
                 $teachercode=$row['t_code'];
                 $teachername=$row['t_name'];
             }
         }
        // Late Count
        $resultlate = mysqli_query($link, "SELECT * FROM teach_attendance WHERE teach_attendance.ta_date BETWEEN '$startdate' AND  '$enddate' AND teach_attendance.ta_year='$session' AND ta_teach_id='$teacherid' AND ta_intime>'09:00:59'");
        $latecount = mysqli_num_rows($resultlate);
        
        //Attendance
        $resultattend = mysqli_query($link, "SELECT * FROM teach_attendance WHERE teach_attendance.ta_date BETWEEN '$startdate' AND  '$enddate' AND teach_attendance.ta_year='$session' AND ta_teach_id='$teacherid'");
        $attendancecount = mysqli_num_rows($resultattend);
        
        //Working Days
        $resultworkingdays = mysqli_query($link, "SELECT at_calendar.atc_date FROM at_calendar WHERE at_calendar.atc_date BETWEEN '$startdate' AND  '$enddate' AND at_calendar.atc_year='$session' AND at_calendar.atc_status='1'");
        $workingdays = mysqli_num_rows($resultworkingdays);
        
        $i=1;
            if($result = mysqli_query($link, "SELECT * FROM teach_attendance WHERE teach_attendance.ta_date BETWEEN '$startdate' AND  '$enddate' AND teach_attendance.ta_year='$session' AND ta_teach_id='$teacherid'")){
                if(mysqli_num_rows($result) > 0){?>
<h1 align="center">Attendance Report </h1>
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                    Personal Info: 
                </div>
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            
                            <tr>
                                <th class="text-center" style="vertical-align:middle;">Code</th>
                                <th class="text-center" style="vertical-align:middle;">Name</th>
                                <th class="text-center" style="vertical-align:middle;">Date Between</th>
                                <th class="text-center" style="vertical-align:middle;">Working Days</th>
                                <th class="text-center" style="vertical-align:middle;">Attend Days</th>
                                <th class="text-center" style="vertical-align:middle;">Late Days</th>
                            </tr>
                            
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $teachercode;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $teachername;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $startdate." To ".$enddate;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $workingdays;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $attendancecount;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $latecount;?></td>
                            </tr>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                    Details:
                </div>
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                            <th class="text-center" style="vertical-align:middle;">No.</th>
                            <th class="text-center" style="vertical-align:middle;">Date</th>
                            <th class="text-center" style="vertical-align:middle;">Day</th>
                            <th class="text-center" style="vertical-align:middle;">In Time</th>
                            <th class="text-center" style="vertical-align:middle;">Out Time</th>
                        </tr>
                        <?php  
                        $i=1;
                        if($result = mysqli_query($link, "SELECT * FROM teach_attendance WHERE ta_date BETWEEN '$startdate' AND '$enddate' AND ta_teach_id='$teacherid' AND ta_year='$session'")){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){ ?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $date=$row['ta_date']; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php $datei = strtotime($date);$day = date("l", $datei); echo $day;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['ta_intime'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['ta_outtime'];}?></td>
                            </tr>
                            <?php }}}?>
							<div class="alert alert-success fade in">
								<strong>Notice ! </strong> No data found
							</div>
							<?php }}?>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end Container -->
<?php include 'footer.php';?>
