<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <?php 
    session_start();
    $session = $_GET["session"];
    $class  = $_GET["class"];
    $group  = $_GET["group"];
    ?>    
    <h2>Subject Settings</h2>
    <form class="form-horizontal" action="" role="form" method="post">    
        <div class="row">  
            <input class="form-control" type="hidden" id="session" name="session" value="<?php echo $session ;?>" disabled>
            <input class="form-control" type="hidden" id="class" name="class" value="<?php echo $class ;?>" disabled>
            <input class="form-control" type="hidden" id="group" name="group" value="<?php echo $group ;?>" disabled>
        </div> 
       <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="sub_no" class="col-md-4 control-label">Sub. No.</label>
                    <div class="col-md-3">
                        <input  class="form-control" id="sub_no" type="text" name="sub_no" autofocus <?php if (isset($_POST['sub_no'])) echo 'value="'.$_POST['sub_no'].'"';?> required>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="subject" class="col-md-4 control-label">Subject</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" data-mobile="true" id="subject" name="subject">
                            <?php 
                            $sql="SELECT * FROM exm_subject_mst ORDER BY exm_sub_id ASC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option
                                value='$row[exm_sub_id]'>$row[exm_sub_code] "," $row[exm_sub_name]</option>";
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <div class="col-md-2">
                        <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Submit</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    //searching student id
    $studentid=0;
    $resultstudentid=mysqli_query($link, "SELECT * FROM student_info, st_session, st_class,  st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=$class AND st_class.sc_id=$class AND sg_id=ss_group_id AND sg_id='$group' AND st_session.ss_year='$session' AND st_status='0' ");
    while($row = mysqli_fetch_array($resultstudentid)){
        $studentid=$row['st_id'];
            
    if(isset($_POST['sub_no'])){         
        $sub_no = isset($_POST['sub_no']) ? $_POST['sub_no'] : '';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
        if($studentid!=0){
            $resultupdate = mysqli_query($link, "SELECT * FROM exm_sub_set WHERE ess_session='$session' AND ess_st_id='$studentid' AND ess_sub_no='$sub_no'");
            if( mysqli_num_rows($resultupdate)>0) {
                mysqli_query($link, "UPDATE exm_sub_set SET ess_sub_id='$subject' WHERE ess_session='$session' AND ess_class_id='$class' AND ess_st_id='$studentid' AND ess_sub_no='$sub_no' ");
            }else{
                mysqli_query($link, "INSERT INTO exm_sub_set (ess_session, ess_class_id, ess_st_id, ess_sub_id, ess_sub_no ) VALUES ('$session','$class','$studentid','$subject', '$sub_no') ");
            }
        }
    
        }
    }
    ?>
        <div class="row">
            <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-calendar">
                            Subject Details:
                            <span class="badge"></span>
                        </span>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                                <th class="text-center" style="vertical-align:middle;">Sl No.</th>
                                <th class="text-center" style="vertical-align:middle;">Subject No.</th>
                                <th class="text-center" style="vertical-align:middle;">Subject Code</th>
                                <th class="text-center" style="vertical-align:middle;">Subject Name</th>
                            </tr>
                            <?php
                            $i=1;
            if($resultsub = mysqli_query($link, "SELECT * FROM exm_sub_set, exm_subject_mst, st_class WHERE ess_session='$session' AND ess_class_id=sc_id AND sc_id=$class AND ess_st_id='$studentid' AND ess_sub_id=exm_sub_id ORDER BY ess_sub_no ASC")){
                if(mysqli_num_rows($resultsub) > 0){
                    while($row = mysqli_fetch_array($resultsub)){?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['ess_sub_no']; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_sub_code'];?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $row['exm_sub_name'];}?></td>
                            </tr>
                            <?php } 
            }
                            
        
    
    
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end Container -->
<?php include 'footer.php';?>