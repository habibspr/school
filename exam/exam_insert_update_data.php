<?php 


// count Subject
$Total_Subjects_Count=0;
$Total_Subjects_Count_Result = mysqli_query($link, "SELECT mrk_st_id FROM exm_marks WHERE mrk_exam_id=$Exam_Id AND mrk_st_id=$Student_Id ");
$Total_Subjects_Count = mysqli_num_rows($Total_Subjects_Count_Result);




// Final GP
$Grade_Point_Sum=0; $Final_Grade_Point=0;
$Grade_Point_Sum_Result = mysqli_query($link, "SELECT mrk_gp FROM exm_marks WHERE mrk_exam_id=$Exam_Id AND mrk_st_id=$Student_Id");
while ($row = mysqli_fetch_assoc($Grade_Point_Sum_Result)){
    
    $Grade_Point_Sum += $row['mrk_gp']; 
    
    $Final_Grade_Point=$Grade_Point_Sum/$Total_Subjects_Count;
}



//status
$Fail_Subjects_Count = 0 ;
$Fail_Subjects_Count_Result = mysqli_query($link, "SELECT mrk_grade FROM exm_marks WHERE mrk_exam_id=$Exam_Id AND mrk_st_id=$Student_Id AND mrk_grade='F'");

$Fail_Subjects_Count = mysqli_num_rows($Fail_Subjects_Count_Result);



//grandTotal
$Grand_Total_Marks_of_The_Student_In_This_Exam = 0 ;
$Grand_Total_Marks_Result = mysqli_query($link, "SELECT mrk_total FROM exm_marks WHERE mrk_exam_id='$Exam_Id' AND mrk_st_id=$Student_Id");
while($row = mysqli_fetch_array($Grand_Total_Marks_Result)){
    
    $Grand_Total_Marks_of_The_Student_In_This_Exam +=$row['mrk_total'];
}


// insert and update marks
$Message_Updated=0; $Message_Inserted = 0 ;

// Result exam marks table
$Exam_marks_Result = mysqli_query($link, "SELECT * FROM exm_marks, exm_mst, st_session WHERE exm_id=mrk_exam_id AND exm_lock='0' AND mrk_exam_id='$Exam_Id' AND ss_st_id=mrk_st_id AND ss_year=exm_year AND mrk_st_id=$Student_Id AND mrk_subject_id='$Subject_Id'");

    if( mysqli_num_rows($Exam_marks_Result)>0) {
        
       
        
        // update exam marks table
        if($Creative_Full_Mark){
            
            mysqli_query($link, "UPDATE exm_marks SET mrk_extra='$Achieved_Extra_Mark_Percentage_Of_This_Subject', mrk_creative_full_mark = '$Creative_Full_Mark', mrk_creative='$Achieved_Creative_Mark' WHERE mrk_exam_id='$Exam_Id' AND mrk_st_id='$Student_Id' AND mrk_subject_id='$Subject_Id'");
        }
        if($Objective_Full_Mark){
            
            mysqli_query($link, "UPDATE exm_marks SET mrk_extra='$Achieved_Extra_Mark_Percentage_Of_This_Subject', mrk_objective_full_mark = '$Objective_Full_Mark', mrk_objective='$Achieved_Objective_Mark' WHERE mrk_exam_id='$Exam_Id' AND mrk_st_id='$Student_Id' AND mrk_subject_id='$Subject_Id'");
        }
        if($Practical_Full_Mark){
            
            mysqli_query($link, "UPDATE exm_marks SET mrk_extra='$Achieved_Extra_Mark_Percentage_Of_This_Subject', mrk_practical_full_mark = '$Practical_Full_Mark' , mrk_practical='$Achieved_Practical_Mark' WHERE mrk_exam_id='$Exam_Id' AND mrk_st_id='$Student_Id' AND mrk_subject_id='$Subject_Id'");
        }
        
        
        // Grade Point calculation adding
        include_once"exam_grade_point_calculation.php";
        
        // update total Grade point and Grade 
        mysqli_query($link, "UPDATE exm_marks SET mrk_total='".round($Total_Achieved_Mark,2)."', exm_marks.mrk_gp='$Grade_Point', mrk_grade ='$Grade' WHERE mrk_exam_id='$Exam_Id' AND mrk_st_id='$Student_Id' AND mrk_subject_id='$Subject_Id'");
        
            $Message_Updated = 1 ;
        
    }else{
        
        
        // Grade Point calculation adding
        include_once"exam_grade_point_calculation.php";
        
        
        // insert exam marks table 
        mysqli_query($link, "INSERT INTO exm_marks (mrk_exam_id, mrk_st_id, mrk_class_id, mrk_subject_id, mrk_extra, mrk_creative_full_mark, mrk_objective_full_mark, mrk_practical_full_mark, mrk_creative, mrk_objective, mrk_practical, mrk_total, mrk_gp, mrk_grade) VALUES ('$Exam_Id', '$Student_Id', $Class_Id, '$Subject_Id','$Achieved_Extra_Mark_Percentage_Of_This_Subject', '$Creative_Full_Mark', '$Objective_Full_Mark', '$Practical_Full_Mark', '$Achieved_Creative_Mark', '$Achieved_Objective_Mark', '$Achieved_Practical_Mark', '".round($Total_Achieved_Mark,2)."', '$Grade_Point', '$Grade') ");
        
        
        $Message_Inserted = 1 ;
    } 




// result summary table
    $Summary_Result = mysqli_query($link, "SELECT * FROM result_summary WHERE rs_exm_id='$Exam_Id' AND rs_st_id='$Student_Id'");
    if( mysqli_num_rows($Summary_Result)>0) {
        
        
        
        //update result_summary table 
        mysqli_query($link, "UPDATE result_summary SET rs_subjects='$Total_Subjects_Count', rs_total_marks='$Grand_Total_Marks_of_The_Student_In_This_Exam', rs_result='".round($Final_Grade_Point,2)."', rs_status='$Fail_Subjects_Count'  WHERE rs_exm_id='$Exam_Id' AND rs_st_id='$Student_Id'"); 
        
    }else{ 
        
        // isert result_summary table
        mysqli_query($link, "INSERT INTO result_summary (rs_exm_id, rs_st_id, rs_subjects, rs_total_marks, rs_result, rs_status) VALUES ('$Exam_Id', '$Student_Id', '$Total_Subjects_Count', '$Grand_Total_Marks_of_The_Student_In_This_Exam', '".round($Final_Grade_Point,2)."','$Fail_Subjects_Count' ) ");               
    
    }?>
