<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
        <?php     
            if(isset($_POST['class'])){ // Fetching variables of the form which travels in URL 
                $class = isset($_POST['class']) ? $_POST['class'] : '';
                $session = isset($_POST['session']) ? $_POST['session'] : '';
                $Group = isset($_POST['Group']) ? $_POST['Group'] : '';
                ?>
    
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <td class="text-center" style="vertical-align:middle;">Session</td>
                <td class="text-center" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">Group</td>
            </tr>
            <?php
            if($result = mysqli_query($link,  "SELECT * FROM st_class, st_group WHERE sc_id='$class' AND sg_id=$Group ")){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                           ?>            
            <tr>
                <th class="text-center" style="vertical-align:middle;"><?php echo $session;?></th>
                <th class="text-center" style="vertical-align:middle;"><?php echo $row['sc_name'];?></th>
                <th class="text-center" style="vertical-align:middle;"><?php echo $row['sg_group'];?></th>
            </tr>
            <?php } } } ?>
        </table>
    </div>
    <h3 class="text-center">Subject Summary</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                
                <th class="text-center" rowspan="2" style="vertical-align:middle;">Roll</th>
                <th class="text-center" rowspan="2" style="vertical-align:middle;">Name</th>                        
                <th class="text-center" rowspan="2" style="vertical-align:middle;">Class</th>
                <th class="text-center" rowspan="2" style="vertical-align:middle;">Group</th>
                <th class="text-center" colspan="15" style="vertical-align:middle;">Subjects</th>
                <th class="text-center" rowspan="2" style="vertical-align:middle;">Total</th>
            </tr>
            <tr>
                
                <th class="text-center" style="vertical-align:middle;">S-1</th>
                <th class="text-center" style="vertical-align:middle;">S-2</th>
                <th class="text-center" style="vertical-align:middle;">S-3</th>
                <th class="text-center" style="vertical-align:middle;">S-4</th>
                <th class="text-center" style="vertical-align:middle;">S-5</th>
                <th class="text-center" style="vertical-align:middle;">S-6</th>
                <th class="text-center" style="vertical-align:middle;">S-7</th>
                <th class="text-center" style="vertical-align:middle;">S-8</th>
                <th class="text-center" style="vertical-align:middle;">S-9</th>
                <th class="text-center" style="vertical-align:middle;">S-10</th>
                <th class="text-center" style="vertical-align:middle;">S-11</th>
                <th class="text-center" style="vertical-align:middle;">S-12</th>
                <th class="text-center" style="vertical-align:middle;">S-13</th>
                <th class="text-center" style="vertical-align:middle;">S-14</th>
                <th class="text-center" style="vertical-align:middle;">S-15</th>
                
            </tr>
            <?php
                $i=1;
                if($result = mysqli_query($link,  "SELECT * FROM student_info, st_session, st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=st_class.sc_id AND st_class.sc_id='$class' AND ss_group_id=sg_id AND ss_group_id=$Group AND ss_year='$session' AND st_status='0' ORDER BY ss_roll ASC")){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $studentid=$row['st_id'];?>
            <tr>
                
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></td>
                <td class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['sc_name'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['sg_group'];?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=1");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>

                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=2");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=3");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=4");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=5");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=6");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=7");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=8");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=9");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=10");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=11");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=12");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=13");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=14");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>
                <td class="text-center" style="vertical-align:middle;">
                <?php                                 
                //Subject Code
                $SubjectsCode=0;
                $resultSubjectsCode = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst WHERE ess_sub_id=exm_sub_id AND ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid AND ess_sub_no=15");
                if(mysqli_num_rows($resultSubjectsCode) > 0){
                while($row = mysqli_fetch_array($resultSubjectsCode)){
                    echo $SubjectsCode =  $row ['exm_sub_code'];} }?></td>

                <td class="text-center" style="vertical-align:middle;">
                <?php      
                // count Subject
                $Subjects=0;
                $resultSubjects = mysqli_query($link, "SELECT * FROM exm_sub_set WHERE ess_session='$session' AND ess_class_id='$class' AND ess_st_id=$studentid ");
                $Subjects = mysqli_num_rows($resultSubjects);
                echo $Subjects;}                                
                ?></td>
            </tr>
            <?php
                    }
                }
            }?>
        </table>
    </div>
</div><!--end Container -->
<?php include 'footer.php';?>