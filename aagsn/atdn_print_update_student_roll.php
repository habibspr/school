<?php include "header.php" ;?>
<?php include '../nav-bar.php';?>
<div class="container">
    <?php
    if(isset($_POST['studentid'])){ // Fetching variables of the form which travels in URL           
        $studentid = isset($_POST['studentid']) ? $_POST['studentid'] : '';
        $Session = isset($_POST['newSession']) ? $_POST['newSession'] : '';
        $Class = isset($_POST['newClass']) ? $_POST['newClass'] : '';
        $Group = isset($_POST['newGroup']) ? $_POST['newGroup'] : '';
        $Section = isset($_POST['newSection']) ? $_POST['newSection'] : '';
        $Roll = isset($_POST['newRoll']) ? $_POST['newRoll'] : '';
        $Name = isset($_POST['name']) ? $_POST['name'] : '';
          
        
        if(!empty($studentid)){
                        
            // User info update
            $result=mysqli_query($link, "SELECT * FROM st_session WHERE ss_st_id=$studentid AND ss_year=$Session ");
            if(mysqli_num_rows($result)>0){
                    mysqli_query($link, "UPDATE st_session SET ss_roll='$Roll', ss_group_id='$Group' WHERE ss_st_id='$studentid' ");
                }else{
                mysqli_query($link, "INSERT INTO st_session (ss_st_id, ss_class_id, ss_group_id, ss_section_id, ss_roll, ss_year) VALUES('$studentid','$Class','$Group','$Section','$Roll','$Session')"); 
                //insert data to st_session table
            }
        }
    
    ?>
    <style>
        h4 {
            letter-spacing: 10px;
        }
    </style>
    <h4 class="text-center"><strong>Student Info</strong></h4>
    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <?php 
                     
            if($resultprint = mysqli_query($link,  "SELECT * FROM student_info,  st_session,  st_class, st_group WHERE st_id=ss_st_id AND ss_st_id=$studentid AND sc_id=ss_class_id AND sg_id=ss_group_id AND ss_year='$Session' LIMIT 1")){
                if(mysqli_num_rows($resultprint) > 0){
                    while($row = mysqli_fetch_array($resultprint)){
            ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;" rowspan="6"><img src="../images/students/<?php echo $row['st_code'];?>.jpg" 
                                 class="img-thumbnail" alt="No Photo" width="200" height="200"></td>
                
                <td class="text-right" style="vertical-align:middle;">Code.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_code'];?></th>
            </tr>
            <tr>                
                <td class="text-right" style="vertical-align:middle;">Session</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['ss_year'];?></th>
            </tr>
            <tr> 
                <td class="text-right" style="vertical-align:middle;">Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></th>
            </tr>
            <tr> 
                <td class="text-right" style="vertical-align:middle;">Group</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sg_group'];?></th>
            </tr>
            <tr> 
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sc_name'];?></th>
            </tr>
            <tr> 
                <td class="text-right" style="vertical-align:middle;">Roll</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></th>
            </tr>
        </table>
    </div>
    <?php    }
                }
                }
            }
    ?>
    
</div><!-- container -->


