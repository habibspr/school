
<?php include "../resources/db_aags_n.php" ;


$exam_id = $_POST['exam_id'];
$class_id = $_POST['class_id'];
$i=1;

$result = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$exam_id'");
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $examName = $row['exm_name'];
        $Session=$row['exm_year'];
        }
    }
?>
<div class="container">
    <h4 class="text-left text-success">
        <?php echo "$examName - $Session";?>
    </h4>
        
    <?php
    //Total
    $Total=0;
    $resultTot = mysqli_query($link, "SELECT * FROM student_info, st_session, result_summary WHERE result_summary.rs_exm_id='$exam_id' AND ss_st_id=st_id AND  student_info.st_id=result_summary.rs_st_id AND st_session.ss_class_id='$class_id' AND ss_year='$Session' AND student_info.st_status='0' ");
    $Total = mysqli_num_rows($resultTot);
    
    
    
    // Class Name     
    $querystud="SELECT * FROM student_info, st_session, st_class WHERE ss_st_id=st_id AND ss_year='$Session' AND st_session.ss_class_id=st_class.sc_id AND st_class.sc_id='$class_id'";
    $resultstud = $link->query($querystud);
    if ($resultstud->num_rows > 0) {
        while($row = $resultstud->fetch_assoc()){
            $classname=$row['sc_name'];
            $studentid=$row['st_id'];
        }
    }
    
    
    //Total
    $TotPass=0;
    $resultPass = mysqli_query($link, "SELECT * FROM student_info, st_session, result_summary WHERE result_summary.rs_exm_id='$exam_id' AND ss_year='$Session' AND ss_st_id=st_id AND student_info.st_id=result_summary.rs_st_id AND st_session.ss_class_id='$class_id' AND student_info.st_status='0' AND result_summary.rs_status='F [0]' ");
    $TotPass = mysqli_num_rows($resultPass);
    
    // FULL MARK CALCULATION
    $result_mark = mysqli_query($link, "SELECT sum(mrk_creative_full_mark) + sum(mrk_objective_full_mark) + sum(mrk_practical_full_mark) as full_mark FROM exm_marks WHERE mrk_exam_id='$exam_id' AND mrk_st_id='$studentid' ");
        while($row = mysqli_fetch_array($result_mark)){
        $fullmarks = $row['full_mark'];
    }
    
    
    // Heighest Total Marks in Class
    $resulthtmark = mysqli_query($link, "SELECT max(rs_total_marks) FROM result_summary, student_info, st_session WHERE ss_st_id=st_id AND ss_class_id='$class_id' AND rs_exm_id='$exam_id' AND rs_st_id=st_id AND st_status='0' AND ss_year='$Session' ");
    while($rowMax = mysqli_fetch_array($resulthtmark)){
        $Heighest_Mark_Of_This_Class = $rowMax['max(rs_total_marks)'];
    }
    
    
    ?>
    <div class="table responsive">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th class="text-right" style="vertical-align:middle;">CLass :</th>
                <td class="text-left" style="vertical-align:middle;"><?php echo $classname; ?></td>
                <th class="text-right" style="vertical-align:middle;">Examinee :</th>
                <td class="text-left" style="vertical-align:middle;"><?php echo $Total; ?></td>
                <th class="text-right" style="vertical-align:middle;">Pass :</th>
                <td class="text-left" style="vertical-align:middle;"><?php echo $TotPass; ?></td>
                <th class="text-right" style="vertical-align:middle;">Fail :</th>
                <td class="text-left" style="vertical-align:middle;"><?php echo $Total-$TotPass; ?></td>
                <th class="text-right" style="vertical-align:middle;">Full Mark :</th>
                <td class="text-left" style="vertical-align:middle;"><?php echo $fullmarks; ?></td>
                <th class="text-right" style="vertical-align:middle;">Heighest Mark :</th>
                <td class="text-left" style="vertical-align:middle;"><?php echo $Heighest_Mark_Of_This_Class; ?></td>
            </tr>
        </table>
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th class="text-center" style="vertical-align:middle;">Position</th>
                <th class="text-center" style="vertical-align:middle;">Roll</th>
                <th class="text-center" style="vertical-align:middle;">Name</th>
                <th class="text-center" style="vertical-align:middle;">Group</th>
                <th class="text-center" style="vertical-align:middle;">Subjects</th>
                <th class="text-center" style="vertical-align:middle;">Total</th>                
                <th class="text-center" style="vertical-align:middle;">Result</th>                
                <th class="text-center" style="vertical-align:middle;">Fail Subjects </th>                
            </tr>
            <?php
            
            $resultstud = mysqli_query($link, "SELECT * FROM student_info, st_session, st_group, result_summary WHERE result_summary.rs_exm_id='$exam_id' AND  student_info.st_id=result_summary.rs_st_id AND ss_st_id=st_id AND ss_group_id=sg_id AND st_session.ss_class_id='$class_id' AND st_status='0' AND ss_year='$Session' ORDER BY result_summary.rs_status ASC, result_summary.rs_total_marks DESC, result_summary.rs_result DESC,  result_summary.rs_subjects DESC,   ss_roll ASC");
            while($row = mysqli_fetch_array($resultstud)){
                $studentid =  $row ['rs_st_id'];
            ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['rs_position'];?></td>
                <td class="text-center" style="vertical-align:middle;"> <?php echo $row['ss_roll']; ?></td>
                <td class="text-left" style="vertical-align:middle;"> <?php echo $row['st_name']; ?></td>               
                <td class="text-left" style="vertical-align:middle;"> <?php echo $row['sg_group']; ?></td>               
                <td class="text-center" style="vertical-align:middle;"> <?php 
                        // count Subject
                        $Subjects=0;
                        $resultSubjects = mysqli_query($link, "SELECT exm_marks.mrk_st_id FROM exm_marks WHERE exm_marks.mrk_exam_id='$exam_id' AND exm_marks.mrk_st_id=$studentid ");
                        $Subjects = mysqli_num_rows($resultSubjects);
                        echo $Subjects;
                    ?></td>                
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['rs_total_marks'];?></td>
                <td class="text-center" style="vertical-align:middle;">
                    <?php
                        $FRE = $row['rs_status'];
                        
                        $FRE = $row['rs_status'];
                        if ($FRE!=0){
                            echo "F".$FRE."";
                        }else{
                            echo number_format((float)$row['rs_result'],2,'.','');
                        }
                    ?>
                </td>
                <td class="text-center" style="vertical-align:middle;"><?php 
                        // count Subject
                        $resultFSubjects = mysqli_query($link, "SELECT exm_sub_code FROM exm_marks, exm_subject_mst WHERE exm_subject_mst.exm_sub_id=exm_marks.mrk_subject_id AND exm_marks.mrk_exam_id='$exam_id' AND exm_marks.mrk_st_id='$studentid' AND mrk_grade='F' ORDER BY exm_sub_id ASC");
                        if(mysqli_num_rows($resultFSubjects) > 0){
                            while($row = mysqli_fetch_array($resultFSubjects)){
                                echo $row['exm_sub_code'].",";
                            }
                        }
            }
                    ?></td>
            </tr>
        </table>
    </div>
</div>
