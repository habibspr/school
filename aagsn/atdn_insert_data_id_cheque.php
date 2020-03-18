<?php
if(isset($_POST['studentid'])){
    // Fetching variables of the form which travels in URL
    
    $code = $_POST['studentid'];
    
    //searching student code
    $studentid=0;
    $studentcode=0;
    $studentrfid=0;
    $resultstudentid=mysqli_query($link, "SELECT * FROM student_info WHERE student_info.st_rfid='$code' AND student_info.st_status='0'");
    while($row = mysqli_fetch_array($resultstudentid)){
        $studentid=$row['st_id'];
        $studentrfid=$row['st_rfid'];
        $studentcode=$row['st_code'];
    }
    
    //searching student code
    $teacherid=0;
    $teachercode=0;
    $teacherrfid=0;
    $resultstudentid=mysqli_query($link, "SELECT * FROM teacher_info WHERE teacher_info.t_rfid='$code' AND teacher_info.t_status='0'");
    while($row = mysqli_fetch_array($resultstudentid)){
        $teacherid=$row['t_id'];           
        $teacherrfid=$row['t_rfid'];
        $teachercode=$row['t_code'];
    }
    
    //if not id
    $result = mysqli_query($link,"SELECT * FROM teacher_info, student_info WHERE (student_info.st_id='$studentid' AND student_info.st_status='0') OR (teacher_info.t_id='$teacherid' AND teacher_info.t_status='0') ");
    if (mysqli_num_rows($result)==0){
?>
<div class="panel-group">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-user"> Attendance Information</span>
        </div>
        <div class="panel-body">
            <div class="alert alert-danger fade in">
                <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                <strong>Worning!</strong> Invalied Id.
            </div>
        </div>
    </div>
</div>
<?php
                }else{
                    //if calander is off day
                    $result = mysqli_query($link, "SELECT atc_date, atc_status FROM at_calendar WHERE at_calendar.atc_date=CURRENT_DATE() and at_calendar.atc_status='Off Day'");
                    if (mysqli_num_rows($result)!=0){
?>
<div class="panel-group">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-warning-sign"> Notice!</span>
        </div>
        <div class="panel-body">
            <div class="alert alert-info fade in">
                <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                ! Off Day for <br><hr>
                <?php 
                        $query = mysqli_query($link,  "SELECT atc_des FROM at_calendar WHERE at_calendar.atc_date=CURRENT_DATE() and at_calendar.atc_status='Off Day'");
                        while ($row = mysqli_fetch_array($query)){
                            echo "{$row['atc_des']}";} 
                ?>
            </div>
        </div>
    </div>
</div>
<?php
                    }else{
                        if($code!=''){
                            if ($code=="$teacherrfid"){
                                $queryteacher = mysqli_query($link, "SELECT * FROM teacher_info WHERE teacher_info.t_id='$teacherid'");
                                while ($row = mysqli_fetch_array($queryteacher)){?>
<div class="panel-group">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-user">Attendance Information</span>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td rowspan="6" class="text-center">
                            <img src="../images/teachers/<?php echo "$teachercode";?>.jpg" class="img-thumbnail" alt="No Photo" width="100" height="100"><br><?php echo "$teachercode"; ?>
                        </td>
                    </tr>                    
                    <tr>
                        <th class="text-right">Name</th>
                        <th>:</th>
                        <td><?php echo $row['t_name']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Des.</th>
                        <th>:</th>
                        <td><?php echo $row['t_des']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Subject</th>
                        <th>:</th>
                        <td><?php echo $row['t_subject']; ?></td>
                    </tr>
                    <tr> 
                        
                        <th class="text-right">Date</th>
                        <th>:</th>
                        <td><?php echo date('d-m-Y'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Time</th>
                        <th>:</th>
                        <td><?php echo date('h:i:s A.'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } 
                                $result = mysqli_query($link,"SELECT * FROM teach_attendance WHERE teach_attendance.ta_teach_id='$teacherid' AND teach_attendance.ta_date=CURRENT_DATE()");
                            if( mysqli_num_rows($result) > 0){
                                // update for attendance
                                //mysqli_query($link,"UPDATE teach_attendance SET teach_attendance.ta_outtime = CURRENT_TIME(), teach_attendance.ta_status = '1'  WHERE teach_attendance.ta_teach_id ='$teacherid' AND teach_attendance.ta_date=CURRENT_DATE()");?>
<div class="alert alert-info fade in">
    <a href="index.php" class="close" data-dismiss="alert">&times;</a>
    <strong>Thanks!</strong> Thank You for staying wih us.
</div>
<?php
                            }else{
                                //mysqli_query($link, "INSERT INTO teach_attendance (teach_attendance.ta_teach_id, teach_attendance.ta_year, teach_attendance.ta_date, teach_attendance.ta_intime, teach_attendance.ta_status) VALUES('$teacherid', CURRENT_DATE(), CURRENT_DATE(), CURRENT_TIME(), '0')");//insert for attendance 
?>
<div class="alert alert-success fade in">
    <a href="index.php" class="close" data-dismiss="alert">&times;</a>
    <strong>Welcome!</strong> You are Wecome to our School.
</div>
<?php }
                            }else{
                                
                                $querystudent = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class WHERE  student_info.st_id=st_session.ss_id AND st_session.ss_class_id=st_class.sc_id AND student_info.st_id=$studentid");
                                while ($row = mysqli_fetch_array($querystudent)){
?>
<div class="panel-group">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-user"> Attendance Information</span>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td rowspan="6" class="text-center">
                            <img src="../images/students/<?php echo "$studentcode";?>.jpg" 
                                 class="img-thumbnail" alt="No Photo" width="100" height="100"><br><?php echo "$studentcode"; ?>
                        </td>
                    </tr>                    
                    <tr>
                        <th class="text-right">Name</th>
                        <th>:</th>
                        <td><?php echo $row['st_name']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Class</th>
                        <th>:</th>
                        <td><?php echo $row['sc_name']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Roll</th>
                        <th>:</th>
                        <td><?php echo $row['ss_roll']; ?></td>
                    </tr>
                    <tr>                         
                        <th class="text-right">Date</th>
                        <th>:</th>
                        <td><?php echo date('d-m-Y'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Time</th>
                        <th>:</th>
                        <td><?php echo date('h:i:s A.'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php  } 
                            }
                            } 
                    }
    }
}

    
?>
