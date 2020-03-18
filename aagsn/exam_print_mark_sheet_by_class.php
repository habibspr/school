<?php include "exam_header_for_print.php";?>

<?php 
if(isset($_POST['exam'])){
    $exam = $_POST['exam'];            
    $session = $_POST['Session'];            
    $class = $_POST['class'];
    
    $i=1;
    
    
    //exam catagory
    $exm_catagory = 0 ; $exm_Publish_date = 0 ; $exm_Attendence_Count_from = 0 ; 
    $exmcat = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id=$exam");
    while($row = mysqli_fetch_array($exmcat)){
        $exm_catagory=$row['exm_cat'];            
        $exm_Publish_date=$row['exm_publish_date'];            
        $exm_Attendence_Count_from=$row['exm_attendence_from_date'];   
        $Current_Exam_Percent = $row['exm_current_percent'];
    }
    
    // Heighest Total Marks in Class
    $resulthtmark = mysqli_query($link, "SELECT max(rs_total_marks) FROM result_summary, student_info, st_session WHERE ss_st_id=st_id AND ss_class_id='$class' AND rs_exm_id=$exam AND rs_st_id=st_id AND st_status='0' AND ss_year='$session' ");
    while($rowMax = mysqli_fetch_array($resulthtmark)){
        $Heighest_Mark_Of_This_Class = $rowMax['max(rs_total_marks)'];
    }
    
    
    if($class!=''){
        $Student_Id_Result = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class WHERE ss_st_id=st_id AND st_session.ss_class_id=$class AND st_class.sc_id=$class AND st_session.ss_year='$session' AND  st_status='0' ORDER BY ss_roll ASC");
            while($row = mysqli_fetch_array($Student_Id_Result)){
                $studentid= $row['st_id'];                
            
    //Grand Total
    $Grand_Total_Mark_Achieved = 0;
    $resulttotal = mysqli_query($link, "SELECT rs_total_marks FROM result_summary WHERE rs_st_id=$studentid AND rs_exm_id='$exam' ");
    while($row = mysqli_fetch_array($resulttotal)){
        $Grand_Total_Mark_Achieved = $row['rs_total_marks'];   
    }        
        
    //Attendance Count 
    $ResultAttendenceCount = mysqli_query($link, "SELECT at_date FROM st_attendance WHERE at_date BETWEEN '$exm_Attendence_Count_from' AND '$exm_Publish_date' AND at_st_id=$studentid AND at_year='$session' AND at_intime<='12:00:00'");
    // Rows Count
    $AttendenceCount = mysqli_num_rows($ResultAttendenceCount);
    
    //Working Days
    $resultWorkingDays = mysqli_query($link, "SELECT distinct at_date FROM st_attendance WHERE at_date BETWEEN '$exm_Attendence_Count_from' AND '$exm_Publish_date'");
    // Rows Count
    $WorkingDays = mysqli_num_rows($resultWorkingDays);
    
    
    // Merit Position
    $Merit_Position = 0;    
   $Merit_Position_Result = mysqli_query($link, "SELECT rs_position FROM result_summary WHERE rs_exm_id = '$exam' AND rs_st_id='$studentid' ");
   while($row = mysqli_fetch_array($Merit_Position_Result)){
        $Merit_Position = $row['rs_position'];
    }
    
    // FULL MARK CALCULATION
    $result_mark = mysqli_query($link, "SELECT sum(mrk_creative_full_mark) + sum(mrk_objective_full_mark) + sum(mrk_practical_full_mark) as full_mark FROM exm_marks WHERE mrk_exam_id='$exam' AND mrk_st_id='$studentid' ");
    while($row = mysqli_fetch_array($result_mark)){
        $fullmarks = $row['full_mark'];
    }
?>
<div class="container">
    <div class="col-sm-12 row table-responsive">
    <?php
                $Company = mysqli_query($link, "SELECT * FROM company_info");
                while($row = mysqli_fetch_array($Company)){?>
    
    
        <table class="table table-condensed" >
            <tr>
                <td class="col-sm-2 text-center" style="vertical-align:middle;">
                    <img src="../images/logo.png" alt="Cinque Terre" width="auto" height="60"><br>
                    <?php echo $row['co_estd'];?>
                </td >
                <td class="col-sm-8" style="vertical-align:middle;">
                    <h3 class="text-center"><?php echo $row['co_name'];?></h3><br>
                    <p class="text-center" style="margin-top: -20px;"><?php echo $row['co_address'];?><br>
                    <?php echo $row['co_web'];?>
                    </p>
                </td>
                <td class="col-sm-2" style="vertical-align:middle;">
                    <p class="text-left"><?php echo "<br> EIIN : ".$row['co_code1']."<br> CODE : ".$row['co_code2'];?></p>
                </td>
            
            </tr>
        </table>
    
    
        <table class="table table-bordered table-condensed table-striped table-hover">
                <?php
        $result = mysqli_query($link, "SELECT exm_name, exm_year, st_name, st_dob, ss_roll, st_id, sc_name, sg_group, rs_result  FROM exm_mst, student_info, result_summary, st_session, st_class, st_group WHERE st_id=$studentid AND exm_id='$exam' AND st_id=rs_st_id AND rs_exm_id='$exam' AND ss_st_id=st_id AND ss_class_id=sc_id AND ss_group_id=sg_id AND st_status='0' AND ss_year='$session'");
                while($row = mysqli_fetch_array($result)){ ?>
                <h4 class="text-center" style="margin-top: -20px;">MARK  SHEET</h4>
                <p class="text-center"><?php echo $row['exm_name']." - ".$row['exm_year']." ";?><small><?php echo "  Result Printed: ".date('F d, Y')." ";?></small></p>
                <tbody>
                    <tr>
                        <td class="text-right" style="vertical-align:middle;">Student Name</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></th>
                        <td class="text-right" style="vertical-align:middle;">Date of Birth</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_dob'];?></th>
                        <td class="text-right" style="vertical-align:middle;">Roll</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></th>
                        <td rowspan="5" class="text-center" style="vertical-align:middle;">
                             <?php //checking extention of image

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
			                            <img class="student-image" src="<?php echo $img_name;?>" alt="Image" width="auto" height="125px" style="margin:-25px;" >
			
			            </td>
                    </tr>
                    <tr>
                        <td class="text-right" style="vertical-align:middle;">Class</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $row['sc_name'];?></th>
                        <td class="text-right" style="vertical-align:middle;">Group</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $row['sg_group'];?></th>      
                        <td class="text-right" style="vertical-align:middle;">Marit Position</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $Merit_Position; ?></th>
                    </tr>
                    <tr>
                        <td class="text-right" style="vertical-align:middle;">Attendance</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo "[ " .$AttendenceCount." ]  Days";?></th>
                        <td class="text-right" style="vertical-align:middle;">Working Days</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo "[ " .$WorkingDays." ]  Days";?></th>
                        <td class="text-right" style="vertical-align:middle;">Result</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;">
                            
                            <?php $Final_Grade_Point = $row['rs_result'];
                                                          
                                                          $Fail_Subjects_Result = mysqli_query($link, "SELECT mrk_grade FROM exm_marks WHERE mrk_exam_id = '$exam' AND mrk_st_id='$studentid' AND mrk_grade='F' ");
                                                          $Fail_Subjects = mysqli_num_rows($Fail_Subjects_Result);
                                                          
                                                          if($Fail_Subjects>0){
                                                              
                                                              echo "F [ " .$Fail_Subjects." ]";
                                                          
                                                          }else{
                                                              
                                                              echo number_format((float)$Final_Grade_Point,2,'.','');
                                                          
                                                          } ?>
                        </th>
                    </tr>
                    <tr>
                        <td class="text-right" style="vertical-align:middle;">Full Mark</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo "$fullmarks";?></th>
                        <td class="text-right" style="vertical-align:middle;">Mark Obtain</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $Grand_Total_Mark_Achieved;?></th>                        
                        <td class="text-right" style="vertical-align:middle;">Heighest Mark in class</td>
                        <td class="text-center" style="vertical-align:middle;">:</td>
                        <th class="text-left" style="vertical-align:middle;"><?php echo $Heighest_Mark_Of_This_Class ;?></th>
                    </tr>
                    <?php 
                                                         }
                    ?>
            </tbody>
        </table>
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th colspan="3" rowspan="1" class="text-center" style="vertical-align:middle;">Subjects</th>
                <th colspan="6" rowspan="1" class="text-center" style="vertical-align:middle;">Details</th>
                <th colspan="4" rowspan="1" class="text-center" style="vertical-align:middle;">Result</th>
            </tr>
            <tr> 
                <th class="text-center" style="vertical-align:middle;">No.</th>
                <th class="text-center" style="vertical-align:middle;">Code</th>
                <th class="text-center" style="vertical-align:middle;">Name</th>
                <th class="text-center" style="vertical-align:middle;">Full Mark</th>
                <th class="text-center" style="vertical-align:middle;">Cre</th>
                <th class="text-center" style="vertical-align:middle;">Obj</th>
                <th class="text-center" style="vertical-align:middle;">Pra</th>
                <th class="text-center" style="vertical-align:middle;">Mark Obtained</th>
                <th class="text-center" style="vertical-align:middle;">Heighest Mark</th>
                <?php  if($exm_catagory==1){?>                
                <th class="text-center" style="vertical-align:middle;">Extra Mark</th>
                <th class="text-center" style="vertical-align:middle;">G.Total</th>
                <?php } ?>
                <th class="text-center" style="vertical-align:middle;">Grade</th>
                <th class="text-center" style="vertical-align:middle;">GP</th>                
            </tr>
            <?php 
            $i=1;
            if($result = mysqli_query($link, "SELECT * FROM exm_subject_mst, exm_marks WHERE exm_subject_mst.exm_sub_id=exm_marks.mrk_subject_id AND mrk_exam_id=$exam AND mrk_st_id=$studentid ORDER BY mrk_subject_id ASC")){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                    $Full_Mark = (float)$row['mrk_creative_full_mark'] + (float)$row['mrk_objective_full_mark'] + (float)$row['mrk_practical_full_mark'];
                $Mark_Obtained=((float)$row['mrk_creative']+(float)$row['mrk_objective']+(float)$row['mrk_practical']);
                $Subject_Id=$row['mrk_subject_id'];
                $Extra_Mark_Obtained = $row['mrk_extra'];
                $Grand_Total_Mark_Obtained = (100 / $Full_Mark * $Mark_Obtained * $Current_Exam_Percent / 100 ) + $Extra_Mark_Obtained;
                
                // maxMark
                $resultMax = mysqli_query($link, "SELECT max(mrk_total) FROM exm_marks, student_info, st_class, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND ss_class_id=sc_id AND sc_id='$class'AND ss_year='$session' AND mrk_exam_id=$exam AND mrk_subject_id='$Subject_Id'  AND st_status='0' ");
                while($rowMax = mysqli_fetch_array($resultMax)){
                    $Highest_Mark_of_this_Subject = $rowMax['max(mrk_total)'];
                                                      }
        ?>
        <tr>
            <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_sub_code'];?>
            </td>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['exm_sub_name'];?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo $Full_Mark;?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_creative'];?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_objective'];?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_practical'];?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo $Mark_Obtained;?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo $Highest_Mark_of_this_Subject; ?></td>
            <?php  if($exm_catagory){?>
            <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_extra'];?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo round($Grand_Total_Mark_Obtained, 2 )."";?> 
            </td>
            <?php } ?>
            <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_grade']; ?> </td>
            <td class="text-center" style="vertical-align:middle;"><?php echo  number_format((float)$row['mrk_gp'],2,'.',''); } ?> </td>
            </tr>
            <?php 
                }
            } 
            ?>
        </table>
        <table class="table table-bordered table-condensed">
            <tr>
                <th>
                    Comments :
                </th>
            </tr>
            <tr>
                <td>
                    <br><br><br>
                </td>
            </tr>
        </table>
            <p class="text-left big"> <br> <br> ............................ <br>Exam Controller</p>
    </div>
    <p class="footnotes"></p>
</div>
<?php 
                                                          }
            }
        }
    }
?>
