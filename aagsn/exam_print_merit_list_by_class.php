<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    
    <div class="table responsive">
        <?php 
        if(isset($_POST['exam'])){
            $exam = $_POST['exam'];            
            $class = $_POST['class'];
            $i=1;
            
            $result = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$exam'");
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $ExamLock=$row['exm_lock'];
                        $examName = $row['exm_name'];
                        $Session=$row['exm_year'];
                    }
                }
            }
            
if($ExamLock){?> 
<div class="row text-center">
        <div class="col-sm-12">
            <div class="alert alert-danger fade in">
                <strong>Warning!</strong> Exam Locked!
            </div>
        </div>
    </div>
    
<?php die(); }

                    ?>
                <h4 align = "center">
                    <?php echo "$examName - $Session";?>
                </h4>
        
        <?php
            //Total
            $Total=0;
            $resultTot = mysqli_query($link, "SELECT * FROM student_info, st_session, result_summary WHERE result_summary.rs_exm_id='$exam' AND ss_st_id=st_id AND  student_info.st_id=result_summary.rs_st_id AND st_session.ss_class_id='$class' AND ss_year='$Session' AND student_info.st_status='0' ");
            $Total = mysqli_num_rows($resultTot);
            
            
            // Class Name     
            $querystud="SELECT * FROM student_info, st_session, st_class WHERE ss_st_id=st_id AND ss_year='$Session' AND st_session.ss_class_id=$class AND st_class.sc_id='$class'";
                $resultstud = $link->query($querystud);
                if ($resultstud->num_rows > 0) {
                    while($row = $resultstud->fetch_assoc()) {
                        $classname=$row['sc_name'];
                    }
                }
            
            
            //Total
            $TotPass=0;
            $resultPass = mysqli_query($link, "SELECT * FROM student_info, st_session, result_summary WHERE result_summary.rs_exm_id='$exam' AND ss_year='$Session' AND ss_st_id=st_id AND student_info.st_id=result_summary.rs_st_id AND st_session.ss_class_id='$class' AND student_info.st_status='0' AND result_summary.rs_status='F [0]' ");
            $TotPass = mysqli_num_rows($resultPass);?>
        
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
            </tr>
        </table>
        <table class="table table-bordered table-condensed table-striped table-hover">
            <h4 class="text-center"><u>MERIT LIST</u></h4>
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
            $querystud = "SELECT * FROM student_info, st_session, st_group, result_summary WHERE result_summary.rs_exm_id=$exam AND  student_info.st_id=result_summary.rs_st_id AND ss_st_id=st_id AND ss_group_id=sg_id AND st_session.ss_class_id='$class' AND st_status='0' AND ss_year='$Session' ORDER BY result_summary.rs_status ASC, result_summary.rs_total_marks DESC, result_summary.rs_result DESC,  result_summary.rs_subjects DESC,   ss_roll ASC";
            $resultstud = mysqli_query($link, $querystud);
            if($resultstud = mysqli_query($link, $querystud)){
                if(mysqli_num_rows($resultstud) > 0){
                    while($row = mysqli_fetch_array($resultstud)){
                        $studentid =  $row ['rs_st_id'];
                        ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;"> 
                    <?php 
                        mysqli_query($link, "UPDATE result_summary SET rs_position='$i' WHERE rs_exm_id='$exam' AND rs_st_id=$studentid ");
                        echo $i++;
                    ?>
                </td>
                <td class="text-center" style="vertical-align:middle;"> <?php echo $row['ss_roll']; ?></td>
                <td class="text-left" style="vertical-align:middle;"> <?php echo $row['st_name']; ?></td>               
                <td class="text-left" style="vertical-align:middle;"> <?php echo $row['sg_group']; ?></td>               
                <td class="text-center" style="vertical-align:middle;"> <?php 
                        // count Subject
                        $Subjects=0;
                        $resultSubjects = mysqli_query($link, "SELECT exm_marks.mrk_st_id FROM exm_marks WHERE exm_marks.mrk_exam_id='$exam' AND exm_marks.mrk_st_id=$studentid ");
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
                        $resultFSubjects = mysqli_query($link, "SELECT exm_sub_code FROM exm_marks, exm_subject_mst WHERE exm_subject_mst.exm_sub_id=exm_marks.mrk_subject_id AND exm_marks.mrk_exam_id='$exam' AND exm_marks.mrk_st_id='$studentid' AND mrk_grade='F' ORDER BY exm_sub_id ASC");
                        if(mysqli_num_rows($resultFSubjects) > 0){
                            while($row = mysqli_fetch_array($resultFSubjects)){
                                echo $row['exm_sub_code'].",";
                                
                            }
                            
                            
                        }
                        
                    ?></td>
            </tr>
            <?php }
                }
            }?>
        </table>
    </div>
</div>
<?php include 'footer.php';?>
