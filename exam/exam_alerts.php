<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;?>


<?php 

//Student status and input checking /////////////////////////////
$Student_Id=0; $Student_Status=1; 
$Student_Id_Result = mysqli_query($link, "SELECT st_id, st_status FROM student_info, st_session, st_group WHERE ss_st_id=st_id  AND ss_group_id = sg_id AND ss_year='$Session' AND  ss_class_id='$Class_Id' AND sg_id='$Group_Id' AND ss_roll='$Student_Roll' ");
while($row = mysqli_fetch_array($Student_Id_Result)){ 
    $Student_Id=$row['st_id'];
    $Student_Status=$row['st_status'];
}

if(
    $Session == '' 
    or $Exam_Id == '' 
    or $Class_Id == '' 
    or $Subject_Id == '' 
    or $Student_Roll == ''
){ ?>

<div class="alert alert-danger fade in">
    <strong>Notice ! </strong> Input blank ......Please check input !
</div>

<?php die(); }




// student status
if($Student_Status){?>
<div class="alert alert-danger fade in">
    <strong>Notice ! </strong> Student not found ........... Student may be inactive !
</div>
<?php die();}




// Student for This Subject
$Subject_Id_of_This_Student=0;
$Subject_Id_of_This_Student_Result = mysqli_query($link, "SELECT ess_sub_id FROM exm_sub_set WHERE ess_session='$Session' AND ess_sub_id='$Subject_Id' AND ess_st_id='$Student_Id'");
while($row = mysqli_fetch_array($Subject_Id_of_This_Student_Result)){ 
    $Subject_Id_of_This_Student = $row['ess_sub_id'];
}
    

if($Subject_Id_of_This_Student==0){?>
<div class="alert alert-danger fade in">
    <strong>Notice ! </strong> Subject not found ..............  Student not have this subject !
</div>
<?php die();}




// Marks Greater then full marks
if( (float) $Achieved_Creative_Mark > (float)$Creative_Full_Mark or (float)$Achieved_Objective_Mark > (float)$Objective_Full_Mark or (float)$Achieved_Practical_Mark > (float)$Practical_Full_Mark){ ?>

<div class="alert alert-danger fade in">
    <strong>Notice ! </strong> Input greater then full mark ......... Plese check full marks !
</div>

<?php die();}




// full mark check
if( ((float)$Creative_Full_Mark + (float)$Objective_Full_Mark + (float)$Practical_Full_Mark) > 100 ){ ?>
<div class="alert alert-danger fade in">
    <strong>Notice ! </strong> Full marks exeeted .............. Please input full mark below 100 !
</div>
<?php die();}

?>
