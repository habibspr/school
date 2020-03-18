<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;?>
<?php 
$Counter=0;
$Session = 0; $Exam_Id =0; $Class_Id=0; $Subject_Id=0; $Student_Roll=0; $Achieved_Creative_Mark=0; 
if($_REQUEST["Session"] ){
    $Session = $_REQUEST['Session'];
    $Exam_Id = $_REQUEST['Exam'];
    $Class_Id = $_REQUEST['Class'];
    $Group_Id = $_REQUEST['Group'];
    $Subject_Id = $_REQUEST['Subject'];
    $Student_Roll = $_REQUEST['Roll'];
    $Mark_Type_Selection = $_REQUEST['Mark_Type_Selection'];
    $Creative_Full_Mark = $_REQUEST['Creative_Full_Mark'];
    $Objective_Full_Mark = $_REQUEST['Objective_Full_Mark'];
    $Practical_Full_Mark = $_REQUEST['Practical_Full_Mark'];
    $Pass_Mark_Percentage = $_REQUEST['Pass_Mark_Percentage'];
    $Achieved_Creative_Mark = $_REQUEST['Achieved_Creative_Mark'];
    $Achieved_Objective_Mark = $_REQUEST['Achieved_Objective_Mark'];
    $Achieved_Practical_Mark = $_REQUEST['Achieved_Practical_Mark'];
}



// Exam master status checking //////////////////

$Exam_data_Result = mysqli_query($link, "SELECT exm_name, exm_cat, exm_lock, exm_ex_mark1, exm_ex_mark2, exm_ex_mark3, exm_extra_percent, exm_current_percent, exm_annual FROM exm_mst WHERE exm_id='$Exam_Id' AND exm_year='$Session'");
while($row = mysqli_fetch_array($Exam_data_Result)){ 
    $Exam_Master_Name=$row['exm_name'];
    $Exam_Master_Category=$row['exm_cat'];
    $Exam_Master_Securtiy=$row['exm_lock'];
    $Exam_Master_Mark_One=$row['exm_ex_mark1'];
    $Exam_Master_Mark_Two=$row['exm_ex_mark2'];
    $Exam_Master_Mark_Three=$row['exm_ex_mark3'];
    $Exam_Master_Mark_Extra_Percentage=$row['exm_extra_percent'];
    $Exam_Master_Mark_Current_Percentage=$row['exm_current_percent'];
    $Exam_Master_Type=$row['exm_annual'];
}


include_once"exam_alerts.php";


// Full mark Calculation
(float)$Full_Mark_of_This_Subject = ( (float)$Creative_Full_Mark + (float)$Objective_Full_Mark + (float)$Practical_Full_Mark );



// absent mark 
if ( $Creative_Full_Mark and  $Achieved_Creative_Mark=='' ) { $Achieved_Creative_Mark ='AA'; $Total_Achieved_Mark='AA'; $Grade_Point='AA'; $Grade='AA'; }

if ( $Objective_Full_Mark and $Achieved_Objective_Mark=='' ) { $Achieved_Objective_Mark ='AA'; $Total_Achieved_Mark='AA'; $Grade_Point='AA'; $Grade='AA';}

if ( $Practical_Full_Mark and $Achieved_Practical_Mark=='' ) {$Achieved_Practical_Mark ='AA'; $Total_Achieved_Mark='AA'; $Grade_Point='AA'; $Grade='AA';};


// Extra Mark Calculation adding
include_once "exam_extra_mark_calculation.php";



// Insert and update data
include_once"exam_insert_update_data.php";


  
// view_data_after_insert_update
include_once "exam_view_data_after_insert_update.php";

?>  

