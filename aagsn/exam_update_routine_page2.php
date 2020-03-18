<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    
    
<?php 
session_start();
$exam  = $_GET["exam"];
$session = $_GET["Session"];
$class = $_GET["class"];

if($resultExam = mysqli_query($link,  "SELECT * FROM exm_mst WHERE exm_id='$exam' ORDER BY exm_id DESC LIMIT 1 ")){
    if(mysqli_num_rows($resultExam) > 0){
        while($row = mysqli_fetch_array($resultExam)){
            $ExamName=$row['exm_name'];
            $ExamYear=$row['exm_year'];
            $ExamLock=$row['exm_lock'];
        }
    }
}

if($ExamLock){?> 
<div class="row text-center">
        <div class="col-sm-12">
            <div class="alert alert-danger fade in">
                <strong>Warning!</strong> Exam Locked!
            </div>
        </div>
    </div>
    
<?php die(); }
//Class Searching  //////////////////////////////////////////////////
$resultclass = mysqli_query($link, "SELECT * FROM st_class WHERE st_class.sc_id='$class' ");
while ($row = mysqli_fetch_array($resultclass)){
    $classname= $row['sc_name'];
}

?>

<h2 class="text-center">Exam Routine</h2>
    <h4 class="text-center"><?php echo " " .$ExamName."-".$ExamYear. " Class : ".$classname ;?></h4>
    <hr>
    <form class="form-horizontal" action="" role="form" method="post"> 
        <input class="form-control" type="hidden"  id="exam" name="exam" value="<?php echo  $exam ;?>" disabled>
        <input class="form-control" type="hidden" id="Session" name="Session" value="<?php echo $session ;?>" disabled>
        <input class="form-control" type="hidden" id="class" name="class" value="<?php echo $stClass ;?>" disabled>
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <label for="date" class="col-md-4 control-label">Date</label>
                    <div class="col-md-8">
                        <input  class="form-control" id="date" type="date" name="date" <?php if (isset($_POST['date'])) echo 'value="'.$_POST['date'].'"';?> required value="<?php echo date('Y-m-d');?>">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <label for="time" class="col-md-4 control-label">Time</label>
                    <div class="col-md-8">
                        <input  class="form-control" id="time" type="time" name="time" <?php if (isset($_POST['time'])) echo 'value="'.$_POST['time'].'"';?> required value="<?php echo date('h:i A');?>">
                        <span class="help-block"> </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <label for="Subject" class="col-md-4 control-label">Subject</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" data-mobile="true" id="Subject" name="Subject">
                            <?php 
                            $sql="SELECT * FROM exm_subject_mst ORDER BY exm_sub_code ASC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[exm_sub_id]'>$row[exm_sub_code] "," $row[exm_sub_name]</option>";
                                }                            
                            ?>            
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Insert</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->
     <?php     
    if(isset($_POST['date'])){ // Fetching variables of the form which travels in URL 
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $Subject = isset($_POST['Subject']) ? $_POST['Subject'] : '';
        
        // Day count
        $dateday = strtotime($date);
        $day = date("l", $dateday);
        $i=1;
        
        if($exam!=0){
            $resultroutine = mysqli_query($link, "SELECT * FROM exm_routine_mst WHERE erm_session='$session' AND erm_exam_id='$exam' AND erm_class_id='$class' AND erm_date='$date' AND erm_time='$time' AND erm_sub_id='$Subject'");
            
            if(mysqli_num_rows($resultroutine)>0) {
                mysqli_query($link, "UPDATE exm_routine_mst SET erm_session='$session' AND erm_exam_id='$exam' AND erm_class_id='$class' AND erm_date='$date' AND erm_time='$time' AND erm_sub_id='$Subject' WHERE erm_session='$session' AND erm_exam_id='$exam' AND erm_class_id='$class' AND AND erm_date='$date' AND erm_time='$time'"); 
                ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Update!</strong> ................. Subject Updated!
            </div>
        </div>
    </div>
                <?php 
            }else{
                mysqli_query($link, "INSERT INTO exm_routine_mst (erm_session, erm_exam_id, erm_date, erm_day, erm_time, erm_class_id, erm_sub_id) VALUES ('$session','$exam','$date', '$day', '$time', '$class', '$Subject') ");
            }?>    
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th class="text-center" style="vertical-align:middle;">Sl. No.</th>
                <th class="text-center" style="vertical-align:middle;">Date - Day</th>
                <th class="text-center" style="vertical-align:middle;">Time</th>
                <th class="text-center" style="vertical-align:middle;">Class</th>
                <th class="text-center" style="vertical-align:middle;">Subject</th>
            </tr>
            <?php
            if($result = mysqli_query($link,  "SELECT * FROM exm_routine_mst, exm_subject_mst, st_class WHERE erm_session='$session' AND erm_exam_id='$exam' AND sc_id='$class' AND erm_class_id=sc_id AND erm_sub_id=exm_sub_id ORDER BY erm_date ASC, erm_time ASC ")){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){?>
            <tbody>
                <tr>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['erm_date']. "<br>".$row['erm_day'] ;?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['erm_time'];?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['sc_name'];?></td>
                    <td class="text-left" style="vertical-align:middle;"><?php echo $row['exm_sub_code']."-".$row['exm_sub_name'];?></td>
                    <?php
                                                             }
                }
            } 
        }
    }
    ?>
                </tr>
            </tbody>
        </table>
    </div>
    </div><!--end Container -->
<?php include 'footer.php';?>