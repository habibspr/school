<?php include "exam_header_for_print.php";?>
<div class="container"> 
    <?php
    $Session = "2018";
    
    $exp_table = "Result_Half_Yearly_Exam"; // Table to export    
    
    $link->set_charset("utf8");
    
    // Create and open new csv file
    $csv  = $exp_table . "-" . date('d-m-Y-his') . '.csv';
    $file = fopen($csv, 'w');
    
    // Get the table
    if (!$mysqli_result = mysqli_query($link, "SELECT ss_roll, st_name, sc_name, sg_group, mrk_creative, mrk_objective, mrk_practical, mrk_total, mrk_gp, mrk_grade  FROM student_info, st_session, st_class, st_group, exm_marks WHERE st_id=ss_st_id AND mrk_st_id=st_id AND ss_class_id=sc_id AND ss_year='$Session' AND ss_class_id=sc_id AND ss_group_id=sg_id ORDER BY sg_group ASC, ss_roll ASC"))
        
        printf("Error: %s\n", $link->error);
    
    // Get column names 
    while ($column = mysqli_fetch_field($mysqli_result)) {
        $column_names[] = $column->name;
    }
    
    // Write column names in csv file
    if (!fputcsv($file, $column_names))
        die('Can\'t write column names in csv file');
    
    // Get table rows
    while ($row = mysqli_fetch_row($mysqli_result)) {
        
        // Write table rows in csv files
        if (!fputcsv($file, $row))
            die('Can\'t write rows in csv file');
    }
    
    fclose($file);
    
    echo "<p><a href=\"$csv\">Download Data $Session</a></p>\n"; 
    
    ?>
</div>