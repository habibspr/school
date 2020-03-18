<?php

//HighestMark
$resultMax = mysqli_query($link, "SELECT max(mrk_total) FROM exm_marks WHERE mrk_exam_id='$Exam_Id' AND mrk_class_id='$Class_Id' AND mrk_subject_id='$Subject_Id'");

while($rowMax=mysqli_fetch_array($resultMax)){
        
        $Highest_Mark_Of_This_Class_In_the_Subject=$rowMax['max(mrk_total)']; 
        
    }

// Subject Code and Subject Name

$Subject_Result = mysqli_query($link,  "SELECT exm_sub_code , exm_sub_name FROM exm_subject_mst WHERE exm_sub_id='$Subject_Id'");

while($row = mysqli_fetch_array($Subject_Result)){

    $Subject_Code = $row['exm_sub_code'];
    
    $Subject_Name = $row['exm_sub_name'];
}
?>

<div class="btn btn-lg btn-block btn-primary" style="width:100%; height:auto; padding:0.5em; ">
    <h4><?php echo "Exam : [ ".$Exam_Id." ]  ".$Exam_Master_Name." - ".$Session;?></h4>
</div>
<div class="table-responsive">
        <table class="table table table-bordered table-striped table-hover table-condensed" >
            <tr>
                <td class="text-center" style="vertical-align:middle;">Roll no.</td>
                <td class="text-center" style="vertical-align:middle;">Student name</td>
                
                <td class="text-center" <?php if(!$Creative_Full_Mark){?> style="vertical-align:middle; display:none;" <?php } ?> >Creative mark</td>
                
                <td class="text-center" <?php if(!$Objective_Full_Mark){?> style="display:none;" <?php } ?> >Objective mark</td>
                <td class="text-center" <?php if(!$Practical_Full_Mark){?> style="display:none;" <?php } ?> >Practical mark</td>
                
                <td class="text-center" style="vertical-align:middle;">Total</td>
            </tr>
<?php
$result = mysqli_query($link,  "SELECT * FROM student_info, st_session, exm_marks, st_class, st_group WHERE st_id=ss_st_id AND mrk_st_id=st_id AND ss_class_id=sc_id AND ss_group_id=sg_id AND ss_group_id='$Group_Id' AND mrk_exam_id='$Exam_Id' AND ss_year='$Session' AND ss_class_id='$Class_Id' AND mrk_subject_id='$Subject_Id' AND st_id='$Student_Id' ORDER BY ss_roll ASC");

while($row = mysqli_fetch_array($result)){
    
?>
            
            <tr>
                <th class="text-center" style="vertical-align:middle; "><?php echo $row['ss_roll']; ?> </th>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_name']; ?> </th>
                
                <th class="text-center" <?php if(!$Creative_Full_Mark){?> style="display:none;" <?php } ?> >
                    <?php echo $row['mrk_creative'];?>
                </th>
                <th class="text-center" <?php if(!$Objective_Full_Mark){?> style="display:none;" <?php } ?> >
                    <?php echo $row['mrk_objective'];?>
                </th>
                
                <th class="text-center" <?php if(!$Practical_Full_Mark){?> style="display:none;" <?php } ?> >
                    <?php echo $row['mrk_practical']; ?>
                </th>
                
                <th class="text-center" style="vertical-align:middle;"><?php echo $row['mrk_total']; }?></th>
            
            </tr>
    </table>
</div>


<?php
if($Message_Updated){?>
<div class="text-center alert alert-warning fade in">
    <strong>Oh ! </strong> Data updated !
</div>
<?php }

if($Message_Inserted){?>
<div class="text-center alert alert-success fade in">
    <strong>Yes ! </strong> Data inserted !
</div>
<?php }




mysqli_close($link);
?>
