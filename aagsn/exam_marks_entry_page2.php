<?php include "header.php";?>
<?php include '../nav-bar.php';?>
<?php 
session_start();
$exam  = $_GET["exam"];
$session = $_GET["session"];
$class =$stClass = $_GET["class"];
$subject = $_GET["subject"];
$stype = $_GET["stype"];
?>
<div class="container">
    <form class="form-horizontal" action="" role="form" method="post">        
        <div class="row">  
            <input class="form-control" type="hidden"  id="exam" name="exam" value="<?php echo  $exam ;?>" disabled>
            <input class="form-control" type="hidden" id="session" name="session" value="<?php echo $session ;?>" disabled>
            <input class="form-control" type="hidden" id="class" name="class" value="<?php echo $class ;?>" disabled>
            <input class="form-control" type="hidden" id="subject" name="subject" value="<?php echo $subject ;?>" disabled>
            <input class="form-control" type="hidden" id="stype" name="stype" value="<?php echo $stype ;?>" disabled>
        </div>
        <div class="row">
            <h3> Marks for <small> 
                <?php 
                $exmname = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$exam'");
                while($row = mysqli_fetch_array($exmname)){
                    echo $exam_name=$row['exm_name']."-";            
                    echo $exam_year=$row['exm_year'];            
                }?> </small>
            </h3>
        </div>   
        
       <?php  
        // examlocking  .
        $exmlock=0;
        $resultexmlock = mysqli_query($link, "SELECT exm_lock FROM exm_mst WHERE exm_mst.exm_id='$exam'");
        while($row = mysqli_fetch_array($resultexmlock)){
            $exmlock=$row['exm_lock'];
        }
        
        if($exmlock==1){?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> Time Out The <?php echo $exam_name, $exam_year;?> Number Entry ................
                </div>
            </div>
        </div>
        <?php }else{?>
        <hr>
        <div class="row">  
            <div class="col-sm-6 col-lg-2"></div>
            <?php if ($stype=='cr'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerCr" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="NubmerCr" name="NubmerCr" <?php if (isset($_POST['NubmerCr'])) echo 'value="'.$_POST['NubmerCr'].'"';?>>
                    </div>
                </div>
            </div>
            <?php }else if ($stype=='ob'){ ?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerObj" class="col-md-7 control-label">Objective :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerObj" name="NubmerObj" class="form-control" <?php if (isset($_POST['NubmerObj'])) echo 'value="'.$_POST['NubmerObj'].'"';?>>
                    </div>
                </div>
            </div>
            <?php }else if ($stype=='pr'){ ?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerPrac" class="col-md-7 control-label">Practical :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerPrac" name="NubmerPrac" class="form-control" <?php if (isset($_POST['NubmerPrac'])) echo 'value="'.$_POST['NubmerPrac'].'"';?>>
                    </div>
                </div>
            </div>
            <?php }else if ($stype=='obj'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerCr" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerCr" name="NubmerCr" class="form-control" <?php if (isset($_POST['NubmerCr'])) echo 'value="'.$_POST['NubmerCr'].'"';?>>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerObj" class="col-md-7 control-label">Objective :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerObj" name="NubmerObj" class="form-control" <?php if (isset($_POST['NubmerObj'])) echo 'value="'.$_POST['NubmerObj'].'"';?>>
                    </div>
                </div>
            </div>
            <?php }else if ($stype=='prac'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerCr" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerCr" name="NubmerCr" class="form-control" <?php if (isset($_POST['NubmerCr'])) echo 'value="'.$_POST['NubmerCr'].'"';?>>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerPrac" class="col-md-7 control-label">Practical :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerPrac" name="NubmerPrac" class="form-control" <?php if (isset($_POST['NubmerPrac'])) echo 'value="'.$_POST['NubmerPrac'].'"';?>>
                    </div>
                </div>
            </div>
            <?php }else{?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerCr" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerCr" name="NubmerCr" class="form-control" <?php if (isset($_POST['NubmerCr'])) echo 'value="'.$_POST['NubmerCr'].'"';?>>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerObj" class="col-md-7 control-label">Objective :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerObj" name="NubmerObj" class="form-control" <?php if (isset($_POST['NubmerObj'])) echo 'value="'.$_POST['NubmerObj'].'"';?>>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="NubmerPrac" class="col-md-7 control-label">Practical :</label>
                    <div class="col-md-5">
                        <input type="text" id="NubmerPrac" name="NubmerPrac" class="form-control" <?php if (isset($_POST['NubmerPrac'])) echo 'value="'.$_POST['NubmerPrac'].'"';?>>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="Pass" class="col-md-7 control-label">Pass % :</label>
                    <div class="col-md-5">
                        <input type="text" id="Pass" name="Pass" class="form-control" <?php if (isset($_POST['Pass'])) echo 'value="'.$_POST['Pass'].'"';?> value="40" >
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h3>Marks Obtained <small> :<?php
                $queryEX="SELECT * FROM exm_subject_mst WHERE exm_sub_id='$subject'"; 
                $resultEX = $link->query($queryEX);
                if ($resultEX->num_rows > 0) {
                    // output data of each row
                    while($row = $resultEX->fetch_assoc()) {
                        echo "| Code :".$row['exm_sub_code']. "  | Subject : " .$row['exm_sub_name'];
                    }
                }?>
            </small></h3>
        <div class="row">
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="stroll" class="col-md-7 control-label">Roll :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="stroll" type="text" name="stroll" autofocus>
                        <?php 
                        if(isset($_POST["stroll"])){
                            $stroll=$_POST['stroll'];
                            $studentid=0; 
                            $query="SELECT st_id FROM student_info, st_session WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_year='$session' AND st_session.ss_class_id='$class' AND student_info.st_status='0' AND st_session.ss_roll='$stroll'";
                            $result = $link->query($query);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $studentid=$row['st_id'];
                                    }
                                
                            }
                        }else{ 
                            
                            echo "No Roll Found"; $studentid='';
                        }
                    
                        ?>
                    </div>
                </div>
            </div>
            <?php if ($stype=='cr'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_creative" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_creative" type="text" name="mrk_creative" value="AA">
                    </div>
                </div>
            </div>
            <?php } else if ($stype=='ob'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_objective" class="col-md-7 control-label">Objective :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_objective" type="text" name="mrk_objective" value="AA">
                    </div>
                </div>
            </div>
            <?php } else if ($stype=='pr'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_practical" class="col-md-7 control-label">Practical :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_practical" type="text" name="mrk_practical" value="AA">
                    </div>
                </div>
            </div>
            <?php } else if ($stype=='obj'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_creative" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_creative" type="text" name="mrk_creative" value="AA">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_objective" class="col-md-7 control-label">Objective :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_objective" type="text" name="mrk_objective" value="AA">
                    </div>
                </div>
            </div>
            <?php }else if ($stype=='prac'){?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_creative" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_creative" type="text" name="mrk_creative" value="AA">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_practical" class="col-md-7 control-label">Practical :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_practical" type="text" name="mrk_practical" value="AA">
                    </div>
                </div>
            </div>
            <?php }else{?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_creative" class="col-md-7 control-label">Creative :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_creative" type="text" name="mrk_creative"  value="AA">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_objective" class="col-md-7 control-label">Objective :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_objective" type="text" name="mrk_objective" value="AA">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <label for="mrk_practical" class="col-md-7 control-label">Practical :</label>
                    <div class="col-md-5">
                        <input class="form-control" id="mrk_practical" type="text" name="mrk_practical" value="AA">
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <div class="col-md-7">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Add</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <?php     
    if(isset($_POST['stroll'])){ // Fetching variables of the form which travels in URL 
        $NubmerCr = isset($_POST['NubmerCr']) ? $_POST['NubmerCr'] : '';
        $NubmerObj = isset($_POST['NubmerObj']) ? $_POST['NubmerObj'] : '';
        $NubmerPrac = isset($_POST['NubmerPrac']) ? $_POST['NubmerPrac'] : '';
        
        $Pass = isset($_POST['Pass']) ? $_POST['Pass'] : '';
        
        $mrk_creative = isset($_POST['mrk_creative']) ? $_POST['mrk_creative'] : '';
        $mrk_objective = isset($_POST['mrk_objective']) ? $_POST['mrk_objective'] : '';
        $mrk_practical = isset($_POST['mrk_practical']) ? $_POST['mrk_practical'] : '';
        
        
        //////////////////////////////////Statring Extra Marks Calculation /////////////////////////////////////////////////
        
        // extra marks exam no 1.
        $extexam1=0;
        $resultextexam1 = mysqli_query($link, "SELECT exm_ex_mark1 FROM exm_mst WHERE exm_mst.exm_id='$exam'");
        while($row = mysqli_fetch_array($resultextexam1)){
            $extexam1=$row['exm_ex_mark1'];
        }
        
        // extra marks exam no 2.
        $extexam2=0;
        $resultextexam2 = mysqli_query($link, "SELECT exm_ex_mark2 FROM exm_mst WHERE exm_mst.exm_id='$exam'");
        while($row = mysqli_fetch_array($resultextexam2)){
            $extexam2=$row['exm_ex_mark2'];
        } 
        
        // extra marks exam no 3.
        $extexam3=0;
        $resultextexam3 = mysqli_query($link, "SELECT exm_ex_mark3 FROM exm_mst WHERE exm_mst.exm_id='$exam'");
        while($row = mysqli_fetch_array($resultextexam3)){
            $extexam3=$row['exm_ex_mark3'];
        }
        
        // extra marks calculation-1
        if($extexam1>0){
            $extramark1=0; $extrafullmark1=0; 
            $resultefm1 = mysqli_query($link, "SELECT * FROM exm_marks WHERE exm_marks.mrk_exam_id='$extexam1' AND exm_marks.mrk_st_id='$studentid' AND exm_marks.mrk_subject_id='$subject'"); 
            while($row = mysqli_fetch_array($resultefm1)){
                $extramarkcr1 =$row['mrk_creative']; // extra obtained marks 
                $extramarkobj1 =$row['mrk_objective']; // extra obtained marks 
                $extramarkpra1 =$row['mrk_practical']; // extra obtained marks 
                $extrafullmark1 =$row['mrk_full_mark']; // extra full marks
            }
            if($extramark1!=0 or $extrafullmark1!=0){
                $extramarkspercent1=100/$extrafullmark1*($extramarkcr1+$extramarkobj1+$extramarkpra1);
            }else{$extramarkspercent1=0;
                ?>
    
            <div class="alert alert-danger fade in">
                <strong>Warning!</strong> One or More Prevous Exam Marks not Found .....
            </div>
    <?php
            }
            
        }else{
            $extramarkspercent1=0;
        }
        
        // extra marks calculation-2
        if($extexam2>0){
            $extramark2=0; $extrafullmark2=0; 
            $resultefm2 = mysqli_query($link, "SELECT * FROM exm_marks WHERE exm_marks.mrk_exam_id='$extexam2' AND exm_marks.mrk_st_id='$studentid' AND exm_marks.mrk_subject_id='$subject'");
            while($row = mysqli_fetch_array($resultefm2)){
                $extramarkcr2 =$row['mrk_creative']; // extra obtained marks 
                $extramarkobj2 =$row['mrk_objective']; // extra obtained marks 
                $extramarkpra2 =$row['mrk_practical']; // extra obtained marks 
                $extrafullmark2 =$row['mrk_full_mark']; // extra full marks
            }
            if($extramark2!=0 or $extrafullmark2!=0){
                $extramarkspercent2=100/$extrafullmark2*($extramarkcr2+$extramarkobj2+$extramarkpra2);
            }else{$extramarkspercent2=0;
                ?>
    
            <div class="alert alert-danger fade in">
                <strong>Warning!</strong> One or More Prevous Exam Marks not Found .....
            </div>
    <?php
            }
            
        }else{
            $extramarkspercent2=0;
        }  
        
        // extra marks calculation-3
        if($extexam3>0){
            $extramark3=0; $extrafullmark3=0; 
            $resultefm3 = mysqli_query($link, "SELECT * FROM exm_marks WHERE exm_marks.mrk_exam_id='$extexam3' AND exm_marks.mrk_st_id='$studentid' AND exm_marks.mrk_subject_id='$subject'");
            while($row = mysqli_fetch_array($resultefm3)){
                $extramarkcr3 =$row['mrk_creative']; // extra obtained marks 
                $extramarkobj3 =$row['mrk_objective']; // extra obtained marks 
                $extramarkpra3 =$row['mrk_practical']; // extra obtained marks 
                $extrafullmark3 =$row['mrk_full_mark']; // extra full marks
            }
            if($extramark3!=0 or $extrafullmark3!=0){
                $extramarkspercent3=100/$extrafullmark3*($extramarkcr3+$extramarkobj3+$extramarkpra3);
            }else{
                $extramarkspercent3=0;
                ?>
   
            <div class="alert alert-danger fade in">
                
                <strong>Warning!</strong> One or More Prevous Exam Marks not Found .....
            </div>
            
    <?php }
                        
        }else{
            $extramarkspercent3=0;
        }
                
        if($extexam1>0 && $extexam2>0 && $extexam3>0){
            $EOMark=($extramarkspercent1+$extramarkspercent2+$extramarkspercent3)/3;
        }else if ($extexam1>0 && $extexam2>0 && $extexam3==0){
            $EOMark=($extramarkspercent1+$extramarkspercent2)/2;
        }else if ($extexam1>0 && $extexam2==0 && $extexam3==0) {
            $EOMark=$extramarkspercent1;
        }else{$EOMark=0;}
        //exam catagory
        $exm_catagory=0; $exm_extrapercent=0; $exm_currentpercent=0;
        $exmcat = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_mst.exm_id='$exam'");
        while($row = mysqli_fetch_array($exmcat)){
            $exm_catagory=$row['exm_cat'];            
            $exm_extrapercent=$row['exm_extra_percent'];            
            $exm_currentpercent=$row['exm_current_percent'];            
        }
        
        //Totals 80%
        $SumObtainMarks=$mrk_creative + $mrk_objective + $mrk_practical;
        $fullMark=($NubmerCr+$NubmerObj+$NubmerPrac);
        $TotalPercent=100/$fullMark*$SumObtainMarks*$exm_currentpercent/100;
        
        
        $ExtraMark=0;
        if($exm_catagory==1){
            $ExtraMark=$EOMark*$exm_extrapercent/100;
            $gtotal=($TotalPercent+$ExtraMark);            
        }else{
            //$ExtraMark=0;
            $gtotal=$TotalPercent;
        }
        
        //////////////////////////////////Ending Extra Marks Calculation /////////////////////////////////////////////////
        
        //////////////////////////////////Starting Grade Point calculation //////////////////////////////////////////////
        $ExamMarks=$NubmerCr+$NubmerObj+$NubmerPrac;    
                
        $PercentCr=$NubmerCr*$Pass/100;
        $PercentObj=$NubmerObj*$Pass/100;
        $PercentPrac=$NubmerPrac*$Pass/100;
        
        if($stroll!='') {
            if ($Pass=='' or $ExamMarks>100){
    ?>    
    
            <div class="alert alert-danger fade in">
                <strong>Warning!</strong> Exam Marks Blank .....
            </div>
    
    <?php }else{
                if ($mrk_creative>=round($PercentCr) and $mrk_objective>=round($PercentObj) and $mrk_practical>=round($PercentPrac) and $SumObtainMarks>=round($Pass/100)){$markObtain='1';}else{$markObtain='0';}
                
                if ($mrk_creative=='AA' or $mrk_objective=='AA' or $mrk_practical=='AA'){$total='AA'; $GP='AA'; $Grade='AA';}
                
                else if ($mrk_creative>$NubmerCr or $mrk_objective>$NubmerObj or $mrk_practical>$NubmerPrac){$total=''; $GP=''; $Grade='';
    ?>
    
            <div class="alert alert-danger fade in">
                <strong>Notice!</strong> Invalied Marks .....! 
                <?php echo "Creative = ".$mrk_creative. " | Objective = " .$mrk_objective. " | Practical = " .$mrk_practical."" ; ?>
            </div>
    <?php }else{
                    if ($markObtain==1 and $gtotal>=79.5){$GP='5.00'; $Grade='A+';}
                    else if ($markObtain==1 and $gtotal>=69.5){$GP='4.00'; $Grade='A';}
                    else if ($markObtain==1 and $gtotal>=59.5){$GP='3.50'; $Grade='A-';}
                    else if ($markObtain==1 and $gtotal>=49.5){$GP='3.00'; $Grade='B';}
                    else if ($markObtain==1 and $gtotal>=39.5){$GP='2.00'; $Grade='C';}
                    else if ($markObtain==1 and $gtotal>=32.5){$GP='1.00'; $Grade='D';}
                    else {$GP='0.00'; $Grade='F';}
                    
                }// end calculation
                
               if($studentid!='' or $studentid!=0){
                        $result = mysqli_query($link, "SELECT * FROM exm_marks WHERE exm_marks.mrk_exam_id='$exam' AND exm_marks.mrk_st_id=$studentid AND exm_marks.mrk_subject_id='$subject'");
                    if( mysqli_num_rows($result)>0) {
                        
                        // Subject Choice
                        $subchoice=0;
                        $resultsubchoice = mysqli_query($link, "SELECT ess_sub_id FROM exm_sub_set WHERE ess_session='$session' AND ess_class_id='$class' AND ess_st_id='$studentid'");
                        while($row = mysqli_fetch_array($resultsubchoice)){
                            $subchoice=$row['ess_sub_id'];
                        }
                        //if($subchoice>0){
                            
                            mysqli_query($link, "UPDATE exm_marks SET exm_marks.mrk_extra='".round($ExtraMark,2)."', exm_marks.mrk_full_mark='$fullMark', exm_marks.mrk_creative='$mrk_creative', exm_marks.mrk_objective='$mrk_objective', exm_marks.mrk_practical='$mrk_practical', exm_marks.mrk_total='".round($SumObtainMarks,2)."', exm_marks.mrk_gp='$GP', exm_marks.mrk_grade ='$Grade' WHERE exm_marks.mrk_exam_id='$exam' AND exm_marks.mrk_st_id=$studentid AND exm_marks.mrk_subject_id='$subject'"); 
                            ?> 
    <div class="alert alert-success fade in">
        <strong>Update!</strong> Updated.........
        <?php echo "Student Id = ".$studentid." | Roll= ".$stroll. " | Class = " .$class. " | Subject = " .$subject. " | Creative = ".$mrk_creative. " | Objective = " .$mrk_objective. " | Practical = " .$mrk_practical." | Grade = ".$Grade ; ?>
    </div>
    
    <?php 
                        }else{
                            mysqli_query($link, "INSERT INTO exm_marks (mrk_exam_id, mrk_st_id, mrk_class_id, mrk_subject_id, mrk_extra, mrk_full_mark, mrk_creative, mrk_objective, mrk_practical, mrk_total, mrk_gp, mrk_grade) VALUES ('$exam', '$studentid', $class, '$subject','".round($ExtraMark,2)."', '$fullMark', '$mrk_creative', '$mrk_objective', '$mrk_practical', '".round($SumObtainMarks,2)."', '$GP', '$Grade') ");
                        echo "Inserted";
                        }
            
                    
                    // count Subject
                    $Subjects=0;
                    $resultSubjects = mysqli_query($link, "SELECT exm_marks.mrk_st_id FROM exm_marks WHERE exm_marks.mrk_exam_id=$exam AND exm_marks.mrk_st_id=$studentid ");
                    $Subjects = mysqli_num_rows($resultSubjects);
                    
                    // Final GP
                    $GPsum=0; $FinalGP=0;
                    $resultGPsum = mysqli_query($link, "SELECT * FROM exm_marks WHERE exm_marks.mrk_exam_id=$exam AND exm_marks.mrk_st_id=$studentid");
                    while ($row = mysqli_fetch_assoc($resultGPsum)){$GPsum += $row['mrk_gp']; $FinalGP=$GPsum/$Subjects;}
                    
                    //status
                    $FSubjects = mysqli_query($link, "SELECT exm_marks.mrk_grade FROM exm_marks WHERE exm_marks.mrk_exam_id=$exam AND exm_marks.mrk_st_id=$studentid AND mrk_grade='F'");
                    $FailSubjects = mysqli_num_rows($FSubjects);
                    $Status=$FailSubjects;
                    
                    //grandTotal
                    $grandTotal=0;
                    $resultgrandTotal = mysqli_query($link, "SELECT exm_marks.mrk_total FROM exm_marks WHERE exm_marks.mrk_exam_id='$exam' AND exm_marks.mrk_st_id=$studentid");
                    while($row = mysqli_fetch_array($resultgrandTotal)){
                        $grandTotal +=$row['mrk_total'];
                    }    
                    
                    // result summary
                    $resultsummary = mysqli_query($link, "SELECT * FROM result_summary WHERE result_summary.rs_exm_id='$exam' AND result_summary.rs_st_id='$studentid'");
                    if( mysqli_num_rows($resultsummary)>0) {
                        mysqli_query($link, "UPDATE result_summary SET result_summary.rs_subjects='$Subjects', result_summary.rs_total_marks='$grandTotal', result_summary.rs_result='".round($FinalGP,2)."', result_summary.rs_status='$Status'  WHERE result_summary.rs_exm_id='$exam' AND result_summary.rs_st_id='$studentid'"); 
                        echo "Updated result_summary";
                    }else{                        
                        mysqli_query($link, "INSERT INTO result_summary (result_summary.rs_exm_id, result_summary.rs_st_id, result_summary.rs_subjects, result_summary.rs_total_marks, result_summary.rs_result, result_summary.rs_status) VALUES ('$exam', '$studentid', '$Subjects', '$grandTotal', '".round($FinalGP,2)."','$Status' ) "); 
                        echo "<br>Inserted result_summary<br>";
                        
                    }
               }echo "No Student found or student Inactive";
            }
        }
    }
                   } 
        
        
        
        
                
    ?>
</div><!--end Container -->
<?php include 'footer.php';?>