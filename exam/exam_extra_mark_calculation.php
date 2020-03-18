<?php 

$Sum_of_Extra_Mark_In_This_Subject = 0; 
$Sum_of_Extra_Full_Mark_In_This_Subject = 0; 
$Sum_of_Extra_Creative_Full_Mark_In_This_Subject = 0;
$Sum_of_Extra_Objective_Full_Mark_In_This_Subject = 0;
$Sum_of_Extra_Practical_Full_Mark_In_This_Subject = 0;

$Achieved_Extra_Mark_Result = mysqli_query( $link, " SELECT SUM(mrk_total), SUM(mrk_creative_full_mark),  SUM(mrk_objective_full_mark), SUM(mrk_practical_full_mark) FROM exm_marks, exm_mst WHERE mrk_exam_id IN (exm_ex_mark1, exm_ex_mark2, exm_ex_mark3) AND exm_id='$Exam_Id' AND mrk_subject_id = '$Subject_Id' AND mrk_st_id='$Student_Id' "); 

while($row = mysqli_fetch_array($Achieved_Extra_Mark_Result)){
    
    $Sum_of_Extra_Mark_In_This_Subject = $row['SUM(mrk_total)'] ; 
    
    $Sum_of_Extra_Creative_Full_Mark_In_This_Subject = $row['SUM(mrk_creative_full_mark)'] ; 
    $Sum_of_Extra_Objective_Full_Mark_In_This_Subject = $row['SUM(mrk_objective_full_mark)'] ; 
    $Sum_of_Extra_Practical_Full_Mark_In_This_Subject = $row['SUM(mrk_practical_full_mark)'] ; 
    
    
}

$Sum_of_Extra_Full_Mark_In_This_Subject = $Sum_of_Extra_Creative_Full_Mark_In_This_Subject + $Sum_of_Extra_Objective_Full_Mark_In_This_Subject + $Sum_of_Extra_Practical_Full_Mark_In_This_Subject ;
    
if($Sum_of_Extra_Mark_In_This_Subject != 0 or $Sum_of_Extra_Full_Mark_In_This_Subject != 0 or $Exam_Master_Category != 0 ){
    
    $Average_of_Extra_Mark_In_This_Subject = $Sum_of_Extra_Mark_In_This_Subject / $Exam_Master_Category;
    
    $Average_of_Extra_Full_Mark_In_This_Subject = $Sum_of_Extra_Full_Mark_In_This_Subject / $Exam_Master_Category ;
    
    $Achieved_Extra_Mark_Percentage_Of_This_Subject = 100 / $Average_of_Extra_Full_Mark_In_This_Subject * $Average_of_Extra_Mark_In_This_Subject * $Exam_Master_Mark_Extra_Percentage / 100 ;
    
    
}else{
    
    $Achieved_Extra_Mark_Percentage_Of_This_Subject = 0 ;
    
}
    
?>

