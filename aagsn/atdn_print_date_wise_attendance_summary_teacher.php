<!-- attendance report by students -->
<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container small">
    <?php
    if(isset($_POST['session'])){ // Fetching variables of the form which travels in URL
        $session = $_POST['session']; 
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        
        //Working Days
        $resultworkingdays = mysqli_query($link, "SELECT distinct ta_date FROM teach_attendance WHERE teach_attendance.ta_date BETWEEN '$startdate' AND  '$enddate' AND teach_attendance.ta_year='$session' ");
        $workingdays = mysqli_num_rows($resultworkingdays);
              
        $i=1;
            if($result = mysqli_query($link, "SELECT * FROM teach_attendance WHERE teach_attendance.ta_date BETWEEN '$startdate' AND  '$enddate' AND teach_attendance.ta_year='$session'")){
                if(mysqli_num_rows($result) > 0){
    ?>
<h1 align="center">Attendance Report </h1>
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                    General Info: 
                </div>
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                                <th class="text-center" style="vertical-align:middle;">Year</th>
                                <th class="text-center" style="vertical-align:middle;">Date Between</th>
                                <th class="text-center" style="vertical-align:middle;">Working Days</th>
                            </tr>
                            
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $session;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $startdate." To ".$enddate;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $workingdays;?></td>
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
                            <th class="text-center" style="vertical-align:middle;">Code</th>
                            <th class="text-center" style="vertical-align:middle;">Name</th>
                            <th class="text-center" style="vertical-align:middle;">Designation</th>
                            <th class="text-center" style="vertical-align:middle;">Sex</th>
                            <th class="text-center" style="vertical-align:middle;">Subject</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile.</th>
                            <th class="text-center" style="vertical-align:middle;">Attend Days</th>
                            <th class="text-center" style="vertical-align:middle;">Late Days</th>
                        </tr>
                        <?php  
                        $i=1;
                        if($result = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_status='0' ORDER BY t_id ASC ")){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $teacherid=$row['t_id'];
                                    //Attendance Count 
                                    $resultattendance = mysqli_query($link, "SELECT * FROM teach_attendance WHERE ta_date BETWEEN '$startdate' AND '$enddate' AND ta_teach_id='$teacherid' AND ta_year='$session'");
                                    $attendancecount = mysqli_num_rows($resultattendance); 
                                     // Late Count
                                    $resultlate = mysqli_query($link, "SELECT * FROM teach_attendance WHERE teach_attendance.ta_date BETWEEN '$startdate' AND  '$enddate' AND teach_attendance.ta_year='$session' AND ta_teach_id='$teacherid' AND ta_intime>'09:00:59'");
                                    $latecount = mysqli_num_rows($resultlate);
                            ?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_code']; ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $row['t_name'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_des'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php $Teacher_Sex=$row['t_sex']; if ($Teacher_Sex==1) {echo "Female";} else {echo "Male"; }?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_subject'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_phone'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $attendancecount;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $latecount;}?></td>
                            </tr>
                            <?php }}}}}?>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end Container -->
<?php include 'footer.php';?>
