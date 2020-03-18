<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;?>

<script>
    // Current Date n Time
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString();
    document.getElementById("date").innerHTML = d.toLocaleDateString();    
</script>


<div class="col-sm-6">
<?php
if($_REQUEST["studentid"] ){
    $code = $_REQUEST['studentid'];
    
    //searching student code
    $studentid=0;
    $studentrfid=0;
    $studentcode=0;
    date_default_timezone_set("Asia/Dhaka"); // for time zone
    $Session = date('Y');
    $resultstudentid=mysqli_query($link, "SELECT * FROM student_info WHERE student_info.st_rfid='$code' AND student_info.st_status='0'");
    while($row = mysqli_fetch_array($resultstudentid)){
        $studentid=$row['st_id'];
        $studentrfid=$row['st_rfid'];
        $studentcode=$row['st_code'];
    }
    
    //searching teacher code
    $teacherid=0;
    $teacherrfid=0;
    $teachercode=0;
    $resultstudentid=mysqli_query($link, "SELECT * FROM teacher_info WHERE teacher_info.t_rfid='$code' AND teacher_info.t_status='0'");
    while($row = mysqli_fetch_array($resultstudentid)){
        $teacherid=$row['t_id'];           
        $teacherrfid=$row['t_rfid'];
        $teachercode=$row['t_code'];
    }
    
    //if not id
    $result = mysqli_query($link,"SELECT * FROM teacher_info, student_info WHERE (student_info.st_id='$studentid' AND student_info.st_status='0') OR (teacher_info.t_id='$teacherid' AND teacher_info.t_status='0') ");
    //checking if id is present in teacher or student table
    if (mysqli_num_rows($result)==0){
?>
<div class="alert alert-danger fade in">
                <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                <strong>Worning!</strong> Invalied Id.
            </div>
<?php
                }else{
                    //if calander is off day
                    $result = mysqli_query($link, "SELECT atc_date, atc_status FROM at_calendar WHERE at_calendar.atc_date=CURRENT_DATE() and at_calendar.atc_status='0'");
                    if (mysqli_num_rows($result)!=0){
?>

<div class="alert alert-info fade in">
                <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                ! Off Day for <br><hr>
                <?php 
                        $query = mysqli_query($link,  "SELECT atc_des FROM at_calendar WHERE at_calendar.atc_date=CURRENT_DATE() and at_calendar.atc_status='0'");
                        while ($row = mysqli_fetch_array($query)){
                            echo "{$row['atc_des']}";} 
                ?>
            </div>
<?php
                    }else{
                        if($code !=''){
                            if ($code=="$teacherrfid"){
                                $t_phone = "";
                                $queryteacher = mysqli_query($link, "SELECT * FROM teacher_info WHERE teacher_info.t_id='$teacherid'");
                                while ($row = mysqli_fetch_array($queryteacher)){
                                    //getting teacher phn number and name
                                    $t_phone = $row["t_phone"];
                                    $t_name = $row["t_name"];
                                    $t_des = $row["t_des"];
                                    $msg2 = "LOGIN - Name: ".$t_name.", Des: ".$t_des.", IN Time: ".date("H:m:s");
                                    $msg = "LOGOUT - Name: ".$t_name.", Des: ".$t_des.", Out Time: ".date("H:m:s");
                                    ?>
                                    <h3 style="color:green;">Teacher & Staff</h3>
<div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td rowspan="6" class="text-center">
                            <?php 
																		 //checking extention of image

                                         $test_img_name = "../images/teachers/".$row['t_id'];

                                         if(file_exists($test_img_name.".jpg")){
                                            $img_name= $test_img_name.".jpg";
                                         }
                                         elseif(file_exists($test_img_name.".jpeg")){
                                            $img_name= $test_img_name.".jpeg";
                                         }
                                         elseif(file_exists($test_img_name.".JPG")){
                                            $img_name= $test_img_name.".JPG";
                                         }
                                         elseif(file_exists($test_img_name.".JPEG")){
                                            $img_name= $test_img_name.".JPEG";
                                         }
                                         elseif(file_exists($test_img_name.".PNG")){
                                            $img_name= $test_img_name.".PNG";
                                         } else{
                                            $img_name= $test_img_name.".png";
                                         }
																		 ?>
                            <img src="<?php echo $img_name;?>" class="img-thumbnail" alt="No Photo" width="auto" height="150">
                        </td>
                    </tr>                    
                    <tr>
                        <th style="vertical-align:middle;">Name</th>
                        <td style="vertical-align:middle;"><?php echo $row['t_name']; ?></td>
                    </tr>
                    <tr>
                        <th style="vertical-align:middle;">Des.</th>
                        <td style="vertical-align:middle;"><?php echo $row['t_des']; ?></td>
                    </tr>
                    <tr>
                        <th style="vertical-align:middle;">Subject</th>
                        <td style="vertical-align:middle;"><?php echo $row['t_subject']; ?></td>
                    </tr>
                    <tr>                         
                        <th style="vertical-align:middle;">Date</th>
                        <td style="vertical-align:middle;"><?php echo date('F d, Y'); ?></td>
                    </tr>
                    <tr>
                        <th style="vertical-align:middle;">Time</th>
                        <td style="vertical-align:middle;"><?php echo date('h:i:s a'); ?></td>
                    </tr>
                </table>
            </div>
<?php } 
                                $result = mysqli_query($link,"SELECT * FROM teach_attendance WHERE teach_attendance.ta_teach_id='$teacherid' AND teach_attendance.ta_date=CURRENT_DATE() AND ta_status = 0");

                                $result2 = mysqli_query($link,"SELECT * FROM teach_attendance WHERE teach_attendance.ta_teach_id = '$teacherid' AND teach_attendance.ta_date = CURRENT_DATE()");
                            if( mysqli_num_rows($result) > 0){

                                $in_time = mysqli_fetch_assoc($result)["ta_intime"];
                                $in_time_hour = strtotime($in_time);

                                $current_time_hour = time();

                                $diff = $current_time_hour - $in_time_hour;
                                
                                if($diff < 7200){
                                
?>
<div class="alert alert-danger fade in">
    <strong>Sorry!</strong> It is not right time to go out. Try again later.
</div>
<?php
                            } else {
                                // update for attendance if already IN
                                mysqli_query($link,"UPDATE teach_attendance SET teach_attendance.ta_outtime = CURRENT_TIME(), teach_attendance.ta_status = '1'  WHERE teach_attendance.ta_teach_id =$teacherid AND teach_attendance.ta_date=CURRENT_DATE()");

                                    //sms code start

                                    //api config
                                    include("../sms_api_config.php");

                                    file_get_contents('http://sms.dewanict.com/smsapi', false, stream_context_create([
                                        'http' => [
                                            'method' => 'POST',
                                            'header'  => "Content-type: application/x-www-form-urlencoded",
                                            'content' => http_build_query([
                                                'api_key' => $api_key,
                                                'type' => $type,
                                                'contacts' => $hm_number,
                                                'senderid' => $senderid,
                                                'msg' => $msg
                                            ])
                                        ]
                                    ]));
                                    //sms code end
                                    
                                ?>
                                <div class="alert alert-info fade in">
                                    <strong>Thanks!</strong> Thank You for staying wih us.
                                </div>
                            <?php } }elseif(mysqli_num_rows($result2) == 0){
                                //// insert attendance
                                mysqli_query($link, "INSERT INTO teach_attendance (teach_attendance.ta_teach_id, teach_attendance.ta_year, teach_attendance.ta_date, teach_attendance.ta_intime, teach_attendance.ta_status) VALUES('$teacherid', CURRENT_DATE(), CURRENT_DATE(), CURRENT_TIME(), '0')"); //insert for attendance 
                                
                                    //getting data to send sms

                                    //api config
                                    include("../sms_api_config.php");

                                    file_get_contents('http://sms.dewanict.com/smsapi', false, stream_context_create([
                                        'http' => [
                                            'method' => 'POST',
                                            'header'  => "Content-type: application/x-www-form-urlencoded",
                                            'content' => http_build_query([
                                                'api_key' => $api_key,
                                                'type' => $type,
                                                'contacts' => $hm_number,
                                                'senderid' => $senderid,
                                                'msg' => $msg2
                                            ])
                                        ]
                                    ]));
                                
?>
<div class="alert alert-success fade in">
    <strong>Welcome!</strong> You are Wecome to our School.
</div>
<?php }
    else {?>
        <div class="alert alert-danger fade in">
            <strong>Sorry!</strong> You are already logged out!.
        </div>
    <?php }
                            }else{
                                
                                $querystudent = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class WHERE  student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=st_class.sc_id AND student_info.st_id='$studentid' AND ss_year='$Session' ");
                                while ($row = mysqli_fetch_array($querystudent)){ 

                                    //getting st phn number and name
                                    $st_mobile = $row["st_mobile"];
                                    $st_name = $row["st_name"];
                                    $sc_name = $row['sc_name'];
                                    $msg2 = "Hafez Abdur Rashid School & College - LOGIN - Name: ".$st_name.", Class: ".$sc_name.", IN Time: ".date("H:m:s");
                                    $msg = "Hafez Abdur Rashid School & College - LOGOUT - Name: ".$st_name.", Class: ".$sc_name.", Out Time: ".date("H:m:s");


                                    ?>
                                    <h3 style="color:green;">Student info</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
                
                <td rowspan="6" class="text-center">
                    <?php 
    															 //checking extention of image
    
                                 $test_img_name = "../images/students/".$row['st_id'];
    
                                 if(file_exists($test_img_name.".jpg")){
                                    $img_name= $test_img_name.".jpg";
                                 }
                                 elseif(file_exists($test_img_name.".jpeg")){
                                    $img_name= $test_img_name.".jpeg";
                                 }
                                 elseif(file_exists($test_img_name.".JPG")){
                                    $img_name= $test_img_name.".JPG";
                                 }
                                 elseif(file_exists($test_img_name.".JPEG")){
                                    $img_name= $test_img_name.".JPEG";
                                 }
                                 elseif(file_exists($test_img_name.".PNG")){
                                    $img_name= $test_img_name.".PNG";
                                 } else{
                                    $img_name= $test_img_name.".png";
                                 }
    															 ?>
                    <img src="<?php echo $img_name;?>" 
                         class="img-thumbnail" alt="No Photo" width="auto" height="150">
                    
                </td>                        
            </tr>
            <tr>
                <th style="vertical-align:middle;">Name </th>
                <td style="vertical-align:middle;"><?php echo $row['st_name']; ?></td>
            </tr>
            <tr>
                <th style="vertical-align:middle;">Class</th>
                <td style="vertical-align:middle;"><?php echo $row['sc_name']; ?></td>
            </tr>
            <tr>
                <th style="vertical-align:middle;">Roll</th>
                <td style="vertical-align:middle;"><?php echo $row['ss_roll']; ?></td>
            </tr>
            <tr>                         
                <th style="vertical-align:middle;">Date</th>
                <td style="vertical-align:middle;"><?php echo date('F d, Y'); ?></td>
            </tr>
            <tr>
                <th style="vertical-align:middle;">Time</th>
                <td style="vertical-align:middle;"><?php echo date('h:i:s a'); ?></td>
            </tr>
        </table>
    </div>
<?php  } 
                            $result = mysqli_query($link,"SELECT * FROM st_attendance WHERE st_attendance.at_st_id='$studentid' AND st_attendance.at_date=CURRENT_DATE() "); /* add "AND at_status = 0 " to logout once perday */

                            $result2 = mysqli_query($link,"SELECT * FROM st_attendance WHERE st_attendance.at_st_id = '$studentid' AND st_attendance.at_date = CURRENT_DATE()");

                            if( mysqli_num_rows($result) > 0){

                                $in_time = mysqli_fetch_assoc($result)["at_intime"];
                                $in_time_hour = strtotime($in_time);

                                $current_time_hour = time();

                                $diff = $current_time_hour - $in_time_hour;
                                
                                if($diff < 3600){ ?>
                                    <div class="alert alert-danger fade in">
                                        <strong>Sorry!</strong> It is not right time to go out. Try again later.
                                    </div>

                                <?php } else {
                                    // update for attendance
                                    mysqli_query($link,"UPDATE st_attendance SET st_attendance.at_outtime = CURRENT_TIME(), st_attendance.at_status = '1' WHERE st_attendance.at_st_id ='$studentid' AND st_attendance.at_date=CURRENT_DATE()"); 
                                    /**
                                    //sms code start

                                    //api config
                                    include("../sms_api_config.php");

                                    file_get_contents('http://sms.dewanict.com/smsapi', false, stream_context_create([
                                        'http' => [
                                            'method' => 'POST',
                                            'header'  => "Content-type: application/x-www-form-urlencoded",
                                            'content' => http_build_query([
                                                'api_key' => $api_key,
                                                'type' => $type,
                                                'contacts' => $st_mobile,
                                                'senderid' => $senderid,
                                                'msg' => $msg
                                            ])
                                        ]
                                    ]));
                                    //sms code end
                                    
**/
                                    ?>

<div class="alert alert-info fade in">
    <strong>Thanks!</strong> Thank You for staying wih us.
</div>

                                <?php }

                            } elseif(mysqli_num_rows($result2) == 0){
                                mysqli_query($link, "INSERT INTO st_attendance (st_attendance.at_st_id, st_attendance.at_year, st_attendance.at_date, st_attendance.at_intime, st_attendance.at_status) VALUES('$studentid', CURRENT_DATE(), CURRENT_DATE(), CURRENT_TIME(), '0')");//insert for attendance 

                                /**
                                    //sms code start

                                    //api config
                                    include("../sms_api_config.php");

                                    file_get_contents('http://sms.dewanict.com/smsapi', false, stream_context_create([
                                        'http' => [
                                            'method' => 'POST',
                                            'header'  => "Content-type: application/x-www-form-urlencoded",
                                            'content' => http_build_query([
                                                'api_key' => $api_key,
                                                'type' => $type,
                                                'contacts' => $st_mobile,
                                                'senderid' => $senderid,
                                                'msg' => $msg2
                                            ])
                                        ]
                                    ]));
                                    //sms code end
                                    
**/
                                ?>
<div class="alert alert-success fade in">
    <strong>Welcome!</strong> You are Wecome to our School.
</div>
<?php 
                            }else {?>
        <div class="alert alert-danger fade in">
            <strong>Sorry!</strong> You are already logged out!.
        </div>
    <?php }
                                }
                        }
                    }
    }
}

?>
</div>
 <div class="col-sm-6">
      <?php         
      
      if ($code==$teacherrfid){
      // latest list Teacher
    $queryteacher = mysqli_query($link, "SELECT * FROM teacher_info, teach_attendance WHERE t_id=ta_teach_id ORDER BY ta_timestamp DESC LIMIT 5 ");?>
    <h3 style="color:green;">Latest Records</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Des</th>
                <th>Time</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($queryteacher)){  ?>
            <tr>
                <td><?php echo strtoupper($row['t_name']);?></td>
                <td><?php echo strtoupper($row['t_des']);?></td>
                <td><?php echo date('h:i:s a');}?></td>
            </tr>
        </table>
        
        <?php  
        
      }elseif($code==$studentrfid){
        // latest list Student
    $querystudent = mysqli_query($link, "SELECT * FROM st_attendance, student_info, st_session, st_class WHERE st_id=ss_st_id AND st_id=at_st_id AND ss_class_id=sc_id ORDER BY at_date DESC, at_timestamp DESC LIMIT 5 ");?>
    <h3 style="color:green;">Latest Records</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Roll</th>
                <th>Time</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($querystudent)){  ?>
            <tr>
                <td><?php echo strtoupper($row['st_name']);?></td>
                <td><?php echo strtoupper($row['sc_name']);?></td>
                <td><?php echo $row['ss_roll'];?></td>
                <td><?php echo date('h:i:s a');}?></td>
            </tr>
        </table>
        <?php } ?>
    </div>
</div>


