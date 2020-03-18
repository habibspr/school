<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php" ;?>


    <?php 
    if(empty($student_code)){         
        include_once "../student_login.php";        
    }else{
    ?>
    
<?php include "nav-bar.php" ;?>

<div class="container">
    <div class="row">
        <form class="form-horizontal" action="../aagsn/atdn_print_update_student_roll.php" role="form" method="post">
        <?php
        if(isset($_POST['student_code'])){ // Fetching variables of the form which travels in URL 
            
            $student_code = isset($_POST['student_code']) ? $_POST['student_code'] : '';
            $st_session = isset($_POST['session']) ? $_POST['session'] : '';
            
            if(empty($st_session)){ echo "Check Student id or Session";}else{
                
            // st_id //
            $studentid=0;
            $resultst_id = mysqli_query($link,  "SELECT * FROM student_info WHERE st_code='$student_code' ");
                if(mysqli_num_rows($resultst_id) > 0){
                    while($row = mysqli_fetch_array($resultst_id)){
                        $studentid=$row['st_id'];
                    }
                
            $resultsearch = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class WHERE st_id=$studentid AND ss_st_id=st_id AND ss_year=$st_session AND ss_class_id=sc_id ");
                    
            if(mysqli_num_rows($resultsearch) > 0){
                
                while($row = mysqli_fetch_array($resultsearch)){
                    $Session=$row['ss_year'];
                    $class=$row['ss_class_id'];
                    $className=$row['sc_name'];
                    $roll=$row['ss_roll'];
                    $group=$row['ss_group_id'];
                    $name=$row['st_name'];
                }
            
                
            
                     ?>        
            <div class="row">
                <div class="col-md-4"></div>
                <h3 class="text-left"><strong>Student Info</strong>Promotion</h3>
                <hr>
                <div class="col-sm-6 col-lg-3">
                    <div class="form-group">
                        <label for="studentid" class="col-md-4 control-label">Student Id</label>
                        <div class="col-md-5">
                            <input class="form-control" type="text" id="studentid" name="studentid" value="<?php echo $studentid;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="form-group">
                        <label for="Session" class="col-md-4 control-label">Session</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="Session" name="Session" value="<?php echo $Session;?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="form-group">
                        <label for="studentname" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="studentname" name="studentname" value="<?php echo $name;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="form-group">
                        <label for="studentClass" class="col-md-4 control-label">Class</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" id="studentClass" name="studentClass" value="<?php echo $className;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="form-group">
                        <label for="studentRoll" class="col-md-4 control-label">Roll</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" id="studentRoll" name="studentRoll" value="<?php echo $roll;?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php } } } } ?>
            <h3 class="text-left">Promoted to</h3>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="newSession" class="col-md-4 control-label">Session</label>
                        <div class="col-md-8">
                            <select id="newSession" class="form-control selectpicker" data-mobile="true" name="newSession">
                                <option value="2018" selected>2018</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                            </select>
                        </div>
                    </div>
                </div>                
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="newClass" class="col-md-4 control-label">Class</label>
                        <div class="col-md-8">
                            <select id="newClass" class="form-control selectpicker" data-mobile="true" name="newClass">
                                <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value = '$row[sc_id]' >$row[sc_name] </option>";
                            } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="newSection" class="col-md-4 control-label">Section</label>
                        <div class="col-md-8">
                            <select id="newSection" class="form-control selectpicker" data-mobile="true" name="newSection">
                                <?php 
                            $sql="SELECT * FROM st_section"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value = '$row[ssec_id]' >$row[ssec_section] </option>";
                            } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">                
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="newGroup" class="col-md-4 control-label">Group</label>
                        <div class="col-md-8">
                            <select id="newGroup" class="form-control selectpicker" data-mobile="true" name="newGroup">
                                <?php 
                            $sql="SELECT * FROM st_group"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value = '$row[sg_id]' >$row[sg_group] </option>";
                            } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="newRoll" class="col-md-4 control-label">Roll</label>
                        <div class="col-md-8">
                            <input class="form-control" id="newRoll" type="text" name="newRoll" value="<?php echo $roll;?>">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Save</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php 
        } ?>
</div><!-- End containder -->