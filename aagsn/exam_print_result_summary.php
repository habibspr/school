<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container small">
    
    <div class="table responsive">
        <?php 
        if(isset($_POST['exam'])){
            $exam = $_POST['exam'];            
            $i=1;
            
            if($resultexam = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$exam'")){
                if(mysqli_num_rows($resultexam) > 0){
                    while($row = mysqli_fetch_array($resultexam)){?>    
    <h3 class="text-center"><?php echo $row['exm_name']." - ".$row['exm_year'];} } }?></h3>
        <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th class="text-center" style="vertical-align:middle;">Sl No.</th>
                <th class="text-center" style="vertical-align:middle;">Class</th>
                <th class="text-center" style="vertical-align:middle;">Examinee</th>
                <th class="text-center" style="vertical-align:middle;">Attendance</th>
                <th class="text-center" style="vertical-align:middle;">Absent</th>
                <th class="text-center" style="vertical-align:middle;">Pass</th>
                <th class="text-center" style="vertical-align:middle;">Pass %</th>
                <th class="text-center" style="vertical-align:middle;">Fail</th>
                <th class="text-center" style="vertical-align:middle;">Subjects</th>
            </tr>
            <?php
                if($result = mysqli_query($link, "SELECT sc_id FROM st_class ORDER BY sc_id ASC")){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $class=$row['sc_id'];
                            
                            // Maximum Subjects
                            $resultmaxsubject = mysqli_query($link, "SELECT max(rs_subjects) FROM result_summary, student_info, st_session WHERE rs_exm_id='$exam' AND rs_status='0' AND st_id=ss_st_id AND rs_st_id=st_id AND ss_class_id=$class ");
                            while($row=mysqli_fetch_array($resultmaxsubject)){
                                $maxsubject=$row['max(rs_subjects)'];
                            }
                                  
                            // Total Examinee
							$TotalExaminee=0;
                            $QTotEx = mysqli_query($link, "SELECT * FROM student_info, st_class, st_session WHERE ss_st_id=st_id AND ss_class_id='$class' AND sc_id='$class' AND st_status='0'");
                            $TotalExaminee = mysqli_num_rows($QTotEx);
                            
                            // Total Attend
							$TotalExamineeAt=0;
                            $QTotExAt = mysqli_query($link,  "SELECT distinct st_id FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$exam' AND ss_class_id='$class' AND st_status='0'");
                            $TotalExamineeAt = mysqli_num_rows($QTotExAt);
                            
                            // Total Pass
							$TotalExamineePass=0;
                            $QTotExPass = mysqli_query($link,  "SELECT distinct st_id FROM student_info, st_session, result_summary WHERE ss_st_id=st_id AND st_id=rs_st_id AND ss_class_id='$class' AND st_status='0' AND rs_exm_id='$exam' AND rs_status='0' ");
                            $TotalExamineePass = mysqli_num_rows($QTotExPass);
                            
                            // Total A+
                            $QTotExAP = mysqli_query($link,  "SELECT distinct st_id FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$exam' AND ss_class_id='$class' AND mrk_gp=5.00 AND st_status='0'");
                            $TotalAplus = mysqli_num_rows($QTotExAP);
                            
                            // Total A
                            $QTotExA = mysqli_query($link,  "SELECT distinct st_id FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$exam' AND ss_class_id='$class' AND mrk_gp=4.00 AND st_status='0'");
                            $TotalA = mysqli_num_rows($QTotExA);
                            
                            // Total A-
                            $QTotExAM = mysqli_query($link,  "SELECT distinct st_id FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$exam' AND ss_class_id='$class' AND mrk_gp=3.50 AND st_status='0'");
                            $TotalAM = mysqli_num_rows($QTotExAM);
                            
                            // Total B
                            $QTotExB = mysqli_query($link,  "SELECT distinct st_id FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$exam' AND ss_class_id='$class' AND mrk_gp=3.00 AND st_status='0'");
                            $TotalB = mysqli_num_rows($QTotExB);
                            
                            // Total C
                            $QTotExC = mysqli_query($link,  "SELECT distinct st_id FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$exam' AND ss_class_id='$class' AND mrk_gp=2.00 AND st_status='0'");
                            $TotalC = mysqli_num_rows($QTotExC);
                            
                            // Total D
                            $QTotExD = mysqli_query($link,  "SELECT distinct st_id FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$exam' AND ss_class_id='$class'  AND mrk_gp=1.00 AND st_status='0'");
                            $TotalD = mysqli_num_rows($QTotExD);
            ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?></td>
                <td class="text-center" style="vertical-align:middle;"><?php
                            $resultclass = mysqli_query($link, "SELECT * FROM st_class WHERE sc_id=$class");
                            while($row = mysqli_fetch_array($resultclass)){
                                    echo $row['sc_name'];}?></td>
                <td class="text-center" style="vertical-align:middle;"><?php if($TotalExamineeAt!=0){echo $TotalExaminee;}else{echo "None";}?></td>
                <td class="text-center" style="vertical-align:middle;"><?php if($TotalExamineeAt!=0){echo $TotalExamineeAt;}else{echo "None";}?></td>
                <td class="text-center" style="vertical-align:middle;"><?php if($TotalExamineeAt!=0){echo $TotalExaminee-$TotalExamineeAt;}else{echo "None";}?></td>
                <td class="text-center" style="vertical-align:middle;"><?php if($TotalExamineeAt!=0){echo $TotalExamineePass;}else{echo "None";}?></td>
                <td class="text-center" style="vertical-align:middle;"><?php if($TotalExamineeAt!=0){echo round ($TotalExamineePass/$TotalExamineeAt*100,2);}else{ echo "None";}?></td>
                <td class="text-center" style="vertical-align:middle;"><?php if($TotalExamineeAt!=0){echo $TotalExamineeAt-$TotalExamineePass;}else{echo "None";}?></td>
                <td class="text-center" style="vertical-align:middle;"><?php if($TotalExamineeAt!=0){echo $maxsubject;}else{echo "None";} }?></td>
            </tr>
            
            <?php  } } ?>
        </table>
        </div>
    </div>
    <?php }?>
</div>
<?php include 'footer.php';?>
