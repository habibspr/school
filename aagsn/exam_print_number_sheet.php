<?php include "../aagsn/header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <div class="page-header"><h3 class="text-center">Number sheet</h3></div>
    
        <?php 
        if(isset($_POST['exam'])){
            $Exam_id = $_POST['exam'];            
            $Session = $_POST['Session'];            
            $Class_id = $_POST['stClass'];
            $Subject_id = $_POST['Subjects'];
        }
    
    // Exam Name 
    $Exam_Name = '' ;
    $Exam_name_Result = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$Exam_id' AND exm_year = '$Session' ");
    while($row = mysqli_fetch_array($Exam_name_Result)){
       $Exam_Name  =  $row['exm_name'];
    }
    if(!$Exam_Name){?>
    <div class="text-center alert alert-danger fade in">
        <strong>Notice ! </strong> There is no Exam found !
    </div>
    <?php die();}
    
        // Total Examinee
        $QTotEx = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE ss_st_id=st_id AND ss_class_id='$Class_id' AND ss_year='$Session' AND st_status='0'");
        $TotalExaminee = mysqli_num_rows($QTotEx);

        //Total Attend
        $QTotExAt = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND st_status='0'");
        $TotalExamineeAt = mysqli_num_rows($QTotExAt);

        // Total Pass
        $QTotExPass = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND mrk_gp >= '1' AND st_status='0'");
        $TotalExamineePass = mysqli_num_rows($QTotExPass);

        // Total A+
        $QTotExAP = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND mrk_gp=5.00 AND st_status='0'");
        $TotalAplus = mysqli_num_rows($QTotExAP);

        // Total A
        $QTotExA = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND mrk_gp = 4.00 AND st_status='0'");
        $TotalA = mysqli_num_rows($QTotExA);

        // Total A-
        $QTotExAM = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND mrk_gp=3.50 AND st_status='0'");
        $TotalAM = mysqli_num_rows($QTotExAM);

        // Total B
        $QTotExB = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND mrk_gp=3.00 AND st_status='0'");
        $TotalB = mysqli_num_rows($QTotExB);

        // Total C
        $QTotExC = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND mrk_gp=2.00 AND st_status='0'");
        $TotalC = mysqli_num_rows($QTotExC);

        // Total D
        $QTotExD = mysqli_query($link,  "SELECT * FROM student_info, exm_marks, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND mrk_exam_id='$Exam_id' AND ss_class_id='$Class_id' AND ss_year='$Session' AND mrk_subject_id='$Subject_id' AND mrk_gp=1.00 AND st_status='0'");
        $TotalD = mysqli_num_rows($QTotExD);

        $TotalFail=$TotalExamineeAt-$TotalExamineePass;
        $TotalAbsent=$TotalExaminee-$TotalExamineeAt;

        //exam catagory
        $exm_catagory=0;
        $exmcat = mysqli_query($link, "SELECT exm_cat FROM exm_mst WHERE exm_id=$Exam_id");
        while($row = mysqli_fetch_array($exmcat)){
        $exm_catagory=$row['exm_cat'];            
        }

        //Class Name Searching  //////////////////////////////////////////////////
        $resultclass = mysqli_query($link, "SELECT * FROM st_class WHERE st_class.sc_id='$Class_id' ");
        while ($row = mysqli_fetch_array($resultclass)){
        $classname= $row['sc_name'];
        }

        //Group Name Searching  //////////////////////////////////////////////////
        $Group_Name = 0 ;
        $result_Group = mysqli_query($link, "SELECT distinct sg_group FROM st_group, st_session WHERE sg_id = ss_group_id AND  ss_class_id='$Class_id' AND ss_year ='$Session'");
        while ($row = mysqli_fetch_array($result_Group)){
        $Group_Name= $row['sg_group'];
        }

        //Subject Name Searching  //////////////////////////////////////////////////
        $resultclass = mysqli_query($link, "SELECT exm_sub_code, exm_sub_name FROM exm_subject_mst WHERE exm_sub_id='$Subject_id' ");
        while ($row = mysqli_fetch_array($resultclass)){
        $Subjectcode= $row['exm_sub_code'];
        $Subjectname= $row['exm_sub_name'];
        }

        // Highest mark calculation
        $Highest_Mark = 0;
        $Highest_mark_Resutl = mysqli_query($link,  "SELECT max(mrk_total) FROM exm_marks WHERE mrk_exam_id='$Exam_id' AND mrk_class_id='$Class_id' AND mrk_subject_id='$Subject_id'");
        while($row = mysqli_fetch_array($Highest_mark_Resutl)){
        $Highest_Mark = $row['max(mrk_total)'];
        }

        // Full Mark Calculation
        $Full_Mark = 0;
        $result_Full_mark = mysqli_query($link,  "SELECT DISTINCT mrk_creative_full_mark, mrk_objective_full_mark, mrk_practical_full_mark FROM exm_marks WHERE mrk_exam_id='$Exam_id' AND mrk_class_id='$Class_id' AND mrk_subject_id='$Subject_id' ");
        while($row = mysqli_fetch_array($result_Full_mark)){
        $Full_Mark = $row['mrk_creative_full_mark'] + $row['mrk_objective_full_mark'] + $row['mrk_practical_full_mark'];
        }

?>
    <h5 class="text-left">Exam : <strong><?php echo " ".$Exam_Name. " - ". $Session ;?></strong></h5>
    <h5 class="text-left">Subject : <strong><?php echo " [ ".$Subjectcode." ]  -  ".$Subjectname;?></strong></h5>
    
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo "$classname"; ?></th>
                <td class="text-right" style="vertical-align:middle;">Group</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo "$Group_Name";?></th>
                      
                <td class="text-right" style="vertical-align:middle;">Examinee</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $TotalExaminee. " || Attend : ".$TotalExamineeAt. " || Absent : ".$TotalAbsent;?></th>
            
                <td class="text-right" style="vertical-align:middle;">Result</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo "Pass : ".$TotalExamineePass. " || Fail : ". $TotalFail;?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Full Mark</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo "$Full_Mark";?></th>
                <td class="text-right" style="vertical-align:middle;">Highest Mark</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $Highest_Mark;?></th>
            
                <td class="text-right" style="vertical-align:middle;">Pass Summary</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th colspan="4" class="text-left" style="vertical-align:middle;">
                    <?php echo "A+ = " .$TotalAplus." || A = ".$TotalA." || A- = ".$TotalAM." || B = ".$TotalB." || C = ".$TotalC." || D = ".$TotalD;?>
                </th>
            </tr>
            </table>
            <?PHP 
            $result = mysqli_query($link,  "SELECT st_name, ss_roll, mrk_creative_full_mark, mrk_objective_full_mark, mrk_practical_full_mark, mrk_creative, mrk_objective, mrk_practical, mrk_total, exm_current_percent, mrk_extra, mrk_gp, mrk_grade FROM student_info, exm_mst, exm_marks, st_class, st_session WHERE ss_st_id=st_id AND mrk_st_id=st_id AND exm_id=mrk_exam_id AND mrk_exam_id='$Exam_id' AND ss_class_id=sc_id AND sc_id='$Class_id' AND mrk_subject_id='$Subject_id' AND ss_year='$Session' AND st_status='0' ORDER BY ss_roll ASC ");
            ?>
            
            
            <table class="table table-bordered table-striped table-hover">
                <tr>                
                    <th class="text-center" style="vertical-align:middle; width:5%;"># Roll</th>
                    <th class="text-center" style="vertical-align:middle; width:15%;">Student Name</th>
                    <th class="text-center" style="vertical-align:middle; width:5%;">Creative</th>
                    <?php if ($row['mrk_objective']){ ?>
                        <th class="text-center" style="vertical-align:middle; width:5%;">Objective</th>
                    <?php }
                    if ($row['mrk_practical']){
                    ?>
                        <th class="text-center" style="vertical-align:middle; width:5%;">Practical</th>
                    <?php } ?>
                    <th class="text-center" style="vertical-align:middle; width:5%;">Mark Obtain</th>
                    <?php  if($exm_catagory==1){?>
                    <th class="text-center" style="vertical-align:middle; width:5%;">Extra Mark</th>
                    <th class="text-center" style="vertical-align:middle; width:5%;">Total Mark</th>
                    <?php } ?>


                    <th class="text-center" style="vertical-align:middle; width:5%;">Grade Point</th>
                    <th class="text-center" style="vertical-align:middle; width:5%;">Grade</th>
                </tr>
            <?php
            while($row = mysqli_fetch_array($result)){?>
            <tr>                
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></td>
                <td class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_creative'];?></td>
                <?php if ($row['mrk_objective']){ ?>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_objective'];?></td>
                <?php }
                if ($row['mrk_practical']){
                ?>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_practical'];?></td>
                <?php } ?>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_total'];?></td>
                <?php  if($exm_catagory==1){?>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_extra'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo round((100/$row['mrk_full_mark']*$row['mrk_total']*$row['exm_current_percent']/100)+$row['mrk_extra'],2);?></td>
                <?php } ?>
                <td class="text-center" style="vertical-align:middle;"><?php echo number_format((float)$row['mrk_gp'],2,'.','') ;?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_grade'] ; }?></td>
                </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <hr>
    <p>Teacher Signature</p>
    
</div>
