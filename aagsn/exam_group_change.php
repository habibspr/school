<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h3 class="text-center">Student Stutus Update</h3>
    <hr>
    
    <form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-6">
                        <select id="session" class="form-control selectpicker" data-mobile="true" name="session">
                            <?php 
                            $sql="SELECT distinct ss_year FROM st_session ORDER BY ss_year DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[ss_year]'>$row[ss_year] </option>";
                            } ?>            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="class" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-6">
                        <select id="class" class="form-control selectpicker" data-mobile="true" name="class">
                            <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value = '$row[sc_id]' > $row[sc_name] </option>";
                            } ?>            
                        </select>
                    </div>
                </div>
            </div> 
        </div>
        <div class="row">            
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="stroll" class="col-md-4 control-label">Roll :</label>
                    <div class="col-md-6">
                        <input  class="form-control" id="stroll" type="stroll" name="stroll" <?php if (isset($_POST['stroll'])) echo 'value="'.$_POST['stroll'].'"';?> required>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="group" class="col-md-4 control-label">Group :</label>
                    <div class="col-md-6">
                        <select id="group" class="form-control selectpicker" data-mobile="true" name="group">
                            <?php 
                            $sql="SELECT * FROM st_group"; 
                            foreach ($link->query($sql) as $row){ 
                                echo "<option value= '$row[sg_id]' > $row[sg_group] </option>" ;
                            }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"> Update</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->
<hr>
    
    <?php
    if(isset($_POST['stroll'])){ // Fetching variables of the form which travels in URL
        $session = $_POST["session"];
        $class  = $_POST["class"];
        $group  = $_POST["group"];
        $stroll  = $_POST["stroll"];
    
    $i=1;
    //searching student id
        $studentid=0;
        $resultstudentid=mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id='$class' AND ss_group_id=sg_id AND st_class.sc_id='$class' AND st_session.ss_roll='$stroll' AND st_session.ss_year='$session' ");
        while($row = mysqli_fetch_array($resultstudentid)){
            $studentid=$row['st_id'];
            $studentname=$row['st_name'];
            $studentroll=$row['ss_roll'];
            $studentclass=$row['sc_name'];
            $studentgroup=$row['sg_group'];
            $studentsession=$row['ss_year'];
        }
        
        if($studentid !=''){
                mysqli_query($link, "UPDATE st_session SET ss_group_id=$group WHERE ss_st_id='$studentid'");
        }
        
        
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                Name:<strong><?php echo "$studentname";?></strong>
                Roll No : <strong> <?php echo "$studentroll";?></strong>
                Class : <strong> <?php echo "$studentclass";?></strong>
                Session : <strong> <?php echo "$studentsession";?></strong>
                Group: <strong><?php echo "$studentgroup"; ?></strong>
                <?php
                $resultstudentid=mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id='$class' AND ss_group_id=sg_id AND st_class.sc_id='$class' AND st_session.ss_roll='$stroll' AND st_session.ss_year='$session' ");
        while($row = mysqli_fetch_array($resultstudentid)){
            $studentgroup=$row['sg_group'];
        }
        ?>
                To:<strong><?php echo "$studentgroup"; ?></strong>
            </div>
        </div>
    </div>
    
    <?php 
             }
    ?>
</div><!--end Container -->
<?php include 'footer.php';?>