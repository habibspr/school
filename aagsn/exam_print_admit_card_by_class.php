<?php include "exam_header_for_print.php";?>

<?php 
if(isset($_POST['exam'])){
    $exam = $_POST['exam'];            
    $session = $_POST['Session'];            
    $class = $_POST['stClass'];
}

$result = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$exam'");
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $ExamLock=$row['exm_lock'];
                    }
                }
            
        
        if($ExamLock){?> 
<div class="row text-center" style="margin-top:100px;">
        <div class="col-sm-12">
            <div class="alert alert-danger fade in">
                <strong>Warning!</strong> Exam Locked!
            </div>
        </div>
    </div>
    
<?php die(); }
    
    if($class!=''){
        if($stud = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=$class AND st_class.sc_id=$class AND st_session.ss_year='$session' AND st_status='0' AND ss_year='$session' ORDER BY ss_roll ASC")){
            while($row = mysqli_fetch_array($stud)){
                $studentid= $row['st_id'];                  
                $studentcode= $row['st_code'];                  
?>
<div class="container">
            <?php
                        $Company = mysqli_query($link, "SELECT * FROM company_info");
                        while($row = mysqli_fetch_array($Company)){?>
            
            <div class="table-responsive">
                <table class="table table-condensed">
                    <tr>
                        <td class="col-sm-2" style="vertical-align:middle;">
                            <img src="../images/logo.png" alt="Cinque Terre" width="auto" height="60"><br>
                            <?php echo $row['co_estd'];?>
                        </td >
                        <td class="col-sm-8" style="vertical-align:middle;">
                            <h3 class="text-center"><?php echo $row['co_name'];?></h3><br>
                            <p class="text-center" style="margin-top: -20px;"><?php echo $row['co_address'];?><br>
                            <?php echo $row['co_web'];?>
                            </p>
                        </td>
                        <td class="col-sm-2" style="vertical-align:middle;">
                            <p class="text-left"><?php echo "<br> EIIN : ".$row['co_code1']."<br> CODE : ".$row['co_code2'];?></p>
                        </td>
                    
                    </tr>
                </table>
            <?php } 
                        if($resultexam = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$exam'")){
                            if(mysqli_num_rows($resultexam) > 0){
                                while($row = mysqli_fetch_array($resultexam)){
                                    
                                    $result = mysqli_query($link, "SELECT * FROM exm_mst, student_info, st_session, st_class, st_group WHERE student_info.st_id='$studentid' AND exm_id='$exam' AND st_id=ss_st_id AND ss_class_id=sc_id AND ss_group_id=sg_id AND  EXISTS (SELECT DISTINCT 'ess_st_code' FROM exm_sub_set) AND  st_status='0' AND ss_year='$session'");
                                
                                ?>
            <h3 class="text-center" style="margin-top: -20px;" >ADMIT CARD <small><?php echo "   ".$row['exm_name']." - ".$row['exm_year'];?></small></h3>
            
        <table class="table table-bordered table-condensed">
            <?php
                 
                                                                          if(mysqli_num_rows($result) > 0){
                                                                              while($row = mysqli_fetch_array($result)){ 
            ?>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Student id</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_code'];?></th>
                <td class="text-right" style="vertical-align:middle;">Session</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['ss_year'];?></th>
                <td class="text-center" style="vertical-align:middle;" rowspan="3"><?php //checking extention of image

                                         $test_img_name = "../images/students/".$row['st_id'];

                                         if(file_exists($test_img_name.".jpg")){
                                            $img_name= $test_img_name.".jpg";
                                         }
                                         elseif(file_exists($test_img_name.".jpeg")){
                                            $img_name= $test_img_name.".jpeg";
                                         }
                                         elseif(file_exists($test_img_name.".JPG")){
                                            $img_name= $test_img_name.".JPG";
                                         }
                                         elseif(file_exists($test_img_name.".JPEG")){
                                            $img_name= $test_img_name.".JPEG";
                                         }
                                         elseif(file_exists($test_img_name.".PNG")){
                                            $img_name= $test_img_name.".PNG";
                                         } else{
                                            $img_name= $test_img_name.".png";
                                         }
            ?>
			<img class="student-image" src="<?php echo $img_name;?>" alt="Image" width="auto" height="70px">
			</td>
                
            </tr>
            <tr>            
                
                <td class="text-right" style="vertical-align:middle;">Student Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></th>    
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sc_name'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Group</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sg_group'];?></th>
                <td class="text-right" style="vertical-align:middle;">Roll</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></th>
                </tr>
            
        </table>
        <?php 
                                                                              }
                                                                          }else{echo "No Data";}
                                                                      
                                                                      
            ?>
    </div>    
        <h4 class="text-center">Routine</h4>
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th class="text-center" style="vertical-align:middle;">No.</th>
                <th class="text-center" style="vertical-align:middle;">Date</th>
                <th class="text-center" style="vertical-align:middle;">Day</th>
                <th class="text-center" style="vertical-align:middle;">Time</th>
                <th class="text-center" style="vertical-align:middle;">Subjects</th>
            </tr>
            <?php 
                $i=1;
                if($resultAC = mysqli_query($link, "SELECT * FROM exm_routine_mst, exm_sub_set, exm_subject_mst WHERE erm_session=ess_session AND ess_class_id=erm_class_id AND erm_sub_id=ess_sub_id AND erm_sub_id=exm_sub_id AND erm_session='$session'  AND erm_class_id='$class' AND erm_exam_id='$exam' AND ess_st_id='$studentid' ORDER BY erm_date ASC")){
                    if(mysqli_num_rows($resultAC) > 0){
                        while($row = mysqli_fetch_array($resultAC)){
            ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?> </td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['erm_date'];?> </td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['erm_day'];?> </td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['erm_time'];?> </td>
                <td class="text-left" style="vertical-align:middle;"><?php echo $row['exm_sub_code'].".   ".$row['exm_sub_name'];}?> </td>
            </tr>
            <?php }}}}}
            ?>
        </table>
    <p>
        <br><br>
        ............................ <br> 
        Exam Controller
        </p>
    <p class="footnotes"></p>
</div>
<?php }}} ?>
