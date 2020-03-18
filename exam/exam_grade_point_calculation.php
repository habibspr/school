<?php 

// grade point data search

$result = mysqli_query($link,  "SELECT mrk_creative, mrk_objective, mrk_practical, mrk_creative_full_mark, mrk_objective_full_mark, mrk_practical_full_mark FROM student_info, st_session, exm_marks, st_class, st_group WHERE st_id=ss_st_id AND mrk_st_id=st_id AND ss_class_id=sc_id AND ss_group_id=sg_id AND ss_group_id='$Group_Id' AND mrk_exam_id='$Exam_Id' AND ss_year='$Session' AND ss_class_id='$Class_Id' AND mrk_subject_id='$Subject_Id' AND mrk_st_id='$Student_Id' ");
    while($row = mysqli_fetch_array($result)){
        $Achieved_Creative_Mark = $row['mrk_creative'];
        $Achieved_Objective_Mark = $row['mrk_objective'];
        $Achieved_Practical_Mark = $row['mrk_practical']; 
        
        $Creative_Full_Mark = $row['mrk_creative_full_mark']; 
        $Objective_Full_Mark = $row['mrk_objective_full_mark']; 
        $Practical_Full_Mark = $row['mrk_practical_full_mark']; 
        
    }   


(float)$Full_Mark_of_This_Subject = (float)$Creative_Full_Mark + (float)$Objective_Full_Mark + (float)$Practical_Full_Mark;


// Achieved mark Calculation
(float)$Achieved_Mark_of_This_Subject = ( (float)$Achieved_Creative_Mark + (float)$Achieved_Objective_Mark + (float)$Achieved_Practical_Mark);



// Grand Total Achieved Mark
(float)$Total_Achieved_Mark = (float)$Achieved_Extra_Mark_Percentage_Of_This_Subject + ((float)$Achieved_Mark_of_This_Subject * (float)$Exam_Master_Mark_Current_Percentage / 100)  ;




// Grade Point Validity
$Grade_Point_Validity = 0;



if( 
    ( 
        (float)$Creative_Full_Mark >= (float) $Achieved_Creative_Mark 
        
        and (float)$Achieved_Creative_Mark >= round( $Creative_Full_Mark * $Pass_Mark_Percentage/100 ) 
    )
    
    or
    
    ( 
        (float)$Objective_Full_Mark >= (float)$Achieved_Objective_Mark 
        
        and (float)$Achieved_Objective_Mark >= round( $Objective_Full_Mark * $Pass_Mark_Percentage/100 )
    )
    
    or
    
    ( 
        (float)$Practical_Full_Mark >= (float)$Achieved_Practical_Mark 
        
        and (float)$Achieved_Practical_Mark >= round( $Practical_Full_Mark * $Pass_Mark_Percentage/100 ) 
    )
    
    
    or 
    
    (
        (float)$Creative_Full_Mark >= (float)$Achieved_Creative_Mark and (float)$Achieved_Creative_Mark>= round( $Creative_Full_Mark * $Pass_Mark_Percentage/100 ) 
        
        and (float)$Objective_Full_Mark >= (float)$Achieved_Objective_Mark and (float)$Achieved_Objective_Mark >= round( $Objective_Full_Mark * $Pass_Mark_Percentage / 100 ) 
    )
    
    or
    
    ( 
        (float)$Creative_Full_Mark >= (float)$Achieved_Creative_Mark and (float)$Achieved_Creative_Mark >= round( $Creative_Full_Mark * $Pass_Mark_Percentage/100 ) 
        
        and (float)$Objective_Full_Mark >= (float)$Achieved_Objective_Mark and (float)$Achieved_Objective_Mark >= round( $Objective_Full_Mark * $Pass_Mark_Percentage / 100 )  
        
        and (float)$Practical_Full_Mark >= (float)$Achieved_Practical_Mark and (float)$Achieved_Practical_Mark >= round( $Practical_Full_Mark * $Pass_Mark_Percentage/100 ) 
        
    ) 
    
    and (float)$Total_Achieved_Mark >= round( $Achieved_Mark_of_This_Subject * $Pass_Mark_Percentage / 100 )
    
) {
    
    $Grade_Point_Validity=1;    
    
}


// Grade point Calculation
if ($Grade_Point_Validity==1 and 100/$Full_Mark_of_This_Subject*$Total_Achieved_Mark >= 79.5){
    
    $Grade_Point='5.00'; $Grade='A+';
    
}else if ($Grade_Point_Validity==1 and 100/$Full_Mark_of_This_Subject*$Total_Achieved_Mark >= 69.5){
    
    $Grade_Point='4.00'; $Grade='A';
    
}else if ($Grade_Point_Validity==1 and 100/$Full_Mark_of_This_Subject*$Total_Achieved_Mark >= 59.5){
    
    $Grade_Point='3.50'; $Grade='A-';
    
}else if ($Grade_Point_Validity==1 and 100/$Full_Mark_of_This_Subject*$Total_Achieved_Mark >= 49.5){
    
    $Grade_Point='3.00'; $Grade='B';
    
}else if ($Grade_Point_Validity==1 and 100/$Full_Mark_of_This_Subject*$Total_Achieved_Mark >= 39.5){
    
    $Grade_Point='2.00'; $Grade='C';
    
}else if ($Grade_Point_Validity==1 and 100/$Full_Mark_of_This_Subject*$Total_Achieved_Mark >= 32.5){
    
    $Grade_Point='1.00'; $Grade='D';
    
}else {
    
    $Grade_Point='0.00'; $Grade='F';
}


// end
?>