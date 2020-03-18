<?php include "header.php";?>
<?php include '../nav-bar.php';?>
<div class="container small">    
    <div class="page-header">
			<h4>
				Attendance Summary<small> <?php echo date(' l , M d, Y' );?></small>
			</h4>
		</div>
		
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-hover">
                            <tr class="success">
                                <th class="text-center" style="vertical-align:middle;"># Serial</th>
                                <th class="text-center" style="vertical-align:middle;">Class</th>
                                <th class="text-center" style="vertical-align:middle;">Total Student</th>
                                <th class="text-center" style="vertical-align:middle;">Attend</th>
                                <th class="text-center" style="vertical-align:middle;">Absent</th>
                                <th class="text-center" style="vertical-align:middle;">Leave</th>
                                <th class="text-center" style="vertical-align:middle;">Attend(Extra-Class)</th>
                            </tr>
                            <?php
                            $Session=date('Y');
                            $i=1;
                            $resultclass= mysqli_query($link, "SELECT * FROM st_class ORDER BY sc_id ASC");
                            while ($row = mysqli_fetch_array($resultclass)){
                                $classid=$row['sc_id'];                                    
                                $classname=$row['sc_name'];
                                
                                $studentcount = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND ss_class_id='$classid' AND ss_year='$Session' AND st_status='0'");
                                $totalstudent = mysqli_num_rows($studentcount); 
                                
                                $studentsum = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND ss_year='$Session' AND st_status=0");
                                $totalstudents = mysqli_num_rows($studentsum);
                                
                                $attendancecount = mysqli_query($link, "SELECT * FROM st_session, st_attendance WHERE ss_st_id=at_st_id AND at_date=CURRENT_DATE() AND at_intime<='12:00:00' AND ss_class_id=$classid AND ss_year='$Session'");
                                $totalattendance = mysqli_num_rows($attendancecount);
                                
                                $attendancecounts = mysqli_query($link, "SELECT * FROM st_session, st_attendance WHERE ss_st_id=at_st_id AND at_date=CURRENT_DATE() AND at_intime<='12:00:00' AND ss_year='$Session'");
                                $totalattendances = mysqli_num_rows($attendancecounts);
                                
                                $attendancecountextraclass = mysqli_query($link, "SELECT * FROM st_session, st_attendance WHERE ss_st_id=at_st_id AND at_date=CURRENT_DATE() AND at_outtime>='14:00:00' AND ss_class_id='$classid' AND ss_year='$Session'");
                                $totalattendanceextraclass = mysqli_num_rows($attendancecountextraclass);
                                
                                $attendancecountextraclasss = mysqli_query($link, "SELECT * FROM st_session, st_attendance WHERE ss_st_id=at_st_id AND at_date=CURRENT_DATE() AND at_outtime>='14:00:00' AND ss_year='$Session'");
                                $totalattendanceextraclasss = mysqli_num_rows($attendancecountextraclasss);
                                
                                $absentCount = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND st_status='0' AND ss_class_id='$classid' AND ss_year='$Session' AND NOT EXISTS (SELECT * FROM st_leave WHERE sl_st_id = ss_st_id) AND NOT EXISTS (SELECT ss_st_id FROM st_attendance WHERE ss_st_id=at_st_id AND at_date=CURRENT_DATE() AND at_intime<='12:00:00')");
                                $totalabsentCount = mysqli_num_rows($absentCount);
                                
                                $absentCountS = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND st_status='0'AND ss_year='$Session' AND NOT EXISTS (SELECT * FROM st_leave WHERE sl_st_id = ss_st_id) AND NOT EXISTS (SELECT ss_st_id FROM st_attendance WHERE ss_st_id=at_st_id AND at_date=CURRENT_DATE() AND at_intime<='12:00:00')");
                                $totalabsentCountS = mysqli_num_rows($absentCountS);
                                
                                
                                $leaveCount = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND st_status='0'AND ss_class_id='$classid' AND ss_year='$Session' AND EXISTS (SELECT * FROM st_leave WHERE sl_st_id = ss_st_id AND sl_leave_start_date <= CURRENT_DATE() AND sl_leave_end_date>=CURRENT_DATE() )");
                                $totalleaveCount = mysqli_num_rows($leaveCount);
                                
                                $leaveCountS = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND st_status='0'AND ss_year='$Session' AND EXISTS (SELECT * FROM st_leave WHERE sl_st_id = ss_st_id AND sl_leave_start_date <= CURRENT_DATE() AND sl_leave_end_date>=CURRENT_DATE() )");
                                $totalleaveCountS = mysqli_num_rows($leaveCountS);
                                    
                            ?>
                            <tr >
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $classname;?></td>                                
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalstudent;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalattendance;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalabsentCount;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalleaveCount;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalattendanceextraclass;}?></td>
                            </tr>
                            <tr class="success">
                                <th class="text-right" colspan="2" style="vertical-align:middle;">Toal</th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalstudents; ?></th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalattendances;?></th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalabsentCountS;?></th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalleaveCountS;?></th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalattendanceextraclasss;?></th>
                                
                            </tr>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-hover">
                            <tr class="info">
                                <th class="text-center" style="vertical-align:middle;"># Serial.</th>
                                <th class="text-center" style="vertical-align:middle;">Type</th>
                                <th class="text-center" style="vertical-align:middle;">Total Teacher/Stuff</th>
                                <th class="text-center" style="vertical-align:middle;">Attend</th>
                                <th class="text-center" style="vertical-align:middle;">Absent</th>
                            </tr>
                            <?php
                            $i=1;
                            $Session=date('Y');
                            $resultType= mysqli_query($link, "SELECT DISTINCT t_des FROM teacher_info ORDER BY t_des ASC");
                            while ($row = mysqli_fetch_array($resultType)){
                                $Designation=$row['t_des'];  
                                                        
                            $Teachercount = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_des='$Designation' AND t_status = '0'");
                            $totalTeacher = mysqli_num_rows($Teachercount);
                            
                            $Teachercounts = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_status = '0'");
                            $totalTeachers = mysqli_num_rows($Teachercounts);
                            
                            $attendancecount = mysqli_query($link, "SELECT * FROM teacher_info, teach_attendance WHERE t_des='$Designation' AND t_id=ta_teach_id AND ta_year=$Session AND ta_date=CURRENT_DATE() AND t_status = '0' ");
                            $totalattendance = mysqli_num_rows($attendancecount);
                            
                             $attendancecounts = mysqli_query($link, "SELECT * FROM teacher_info, teach_attendance WHERE t_des='$Designation' AND t_id=ta_teach_id AND ta_year=$Session AND ta_date=CURRENT_DATE() AND t_status = '0'");
                            $totalattendances = mysqli_num_rows($attendancecounts);
                                
                            $totalAbsent=$totalTeacher-$totalattendance;
                            $totalAbsents=$totalTeachers-$totalattendances;
                            
                            ?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $Designation;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalTeacher;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalattendance;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $totalAbsent;}?></td>
                            </tr>
                            <tr class="info">
                                <th class="text-right" colspan="2" style="vertical-align:middle;">Toal</th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalTeachers;?></th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalattendances;?></th>
                                <th class="text-center" style="vertical-align:middle;"><?php echo $totalAbsents;?></th>
                            </tr>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                    
</div>
<?php include 'footer.php';?>