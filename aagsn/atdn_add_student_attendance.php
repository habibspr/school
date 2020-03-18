<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<!-- student info add -->
<?php include "header.php";?>
<?php include '../nav-bar.php';?>


<?php // for last id
$result = mysqli_query($link, 'SELECT st_id FROM student_info ORDER by st_id DESC LIMIT 1;') or die('Invalid query: ' . mysql_error());
$row_first = mysqli_fetch_array($result);
mysqli_data_seek($result , (mysqli_num_rows($result)-1));
$row_last =  mysqli_fetch_array($result);

?>


<div class="container">
    <div class="row">
        <form action="" method="post">
            <input type="hidden" name="action" value="submit">
            <hr>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stcode" class="col-md-3 control-label">Student Code</label>
                        <div class="col-md-6">
                            <input class="form-control" id="stcode" type="text" name="stcode" maxlength="10" value="" required placeholder="0000000000">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stname" class="col-md-3 control-label">Name </label>
                        <div class="col-md-8">
                            <input class="form-control" id="stname" name="stname" placeholder="Student Name" required>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stsex" class="col-md-3 control-label">Sex</label>
                        <div class="col-md-6">
                            <select  class="form-control selectpicker" id="stsex" data-mobile="true" name="stsex">
                             <option selected value="FEMALE">FEMALE</option>
                            <option value="MALE">FEMALE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stsession" class="col-md-3 control-label">Session</label>
                        <div class="col-md-6">
                            <select  class="form-control selectpicker" id="stsession" data-mobile="true" name="stsession">
                               <option selected value="2017">2017</option>
                            <option value="2018">2018</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stclass" class="col-md-3 control-label">Class</label>
                        <div class="col-md-6">
                            <select  class="form-control selectpicker" id="stclass" data-mobile="true" name="stclass">
                                <?php
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[sc_id]'>$row[sc_name] </option>"; } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stgroup" class="col-md-3 control-label">Group</label>
                        <div class="col-md-6">
                            <select  class="form-control selectpicker" id="stgroup" data-mobile="true" name="stgroup">
                                <?php
                            $sql="SELECT * FROM st_group"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[sg_id]'>$row[sg_group] </option>"; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stsection" class="col-md-3 control-label">Section</label>
                        <div class="col-md-6">
                            <select  class="form-control selectpicker" id="stsection" data-mobile="true" name="stsection">
                                 <?php
                            $sql="SELECT * FROM st_section"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[ssec_id]'>$row[ssec_section] </option>"; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stroll" class="col-md-3 control-label">Roll</label>
                        <div class="col-md-6">
                            <input class="form-control" id="stroll" type="text" name="stroll" value="" placeholder="Class Roll">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="stmobile" class="col-md-3 control-label">Mobile No.</label>
                        <div class="col-md-6">
                            <input class="form-control" id="stmobile" type="text" name="stmobile" value="" placeholder="Mobile No.">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Add</span></button>
                        </div>
                    </div>
                </div>
            </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
        </form>
        <hr>
        <?php
        if(isset($_POST['stcode'])){ // Fetching variables of the form which travels in URL
            $stcode = $_POST['stcode'];
            $stname = $_POST['stname'];
            $stsex = $_POST['stsex'];
            $stsession = $_POST['stsession'];            
            $stclass = $_POST['stclass'];
            $stgroup = $_POST['stgroup'];
            $stsection = $_POST['stsection'];
            $stroll = $_POST['stroll'];
            $stmobile = $_POST['stmobile'];
            
            if($stcode ==0){?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Worning!</strong> ..........Invalied Id!.
                </div>
            </div>
        </div>
        <?php 
            }else{ 
                // Maximum Subjects
                    $ss_id=0;
                    $resultssid = mysqli_query($link, "SELECT * FROM student_info");
                    while($row=mysqli_fetch_array($resultssid)){
                        $ss_id=$row['st_ses_id'];
                    }
                $result = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_code='$stcode' AND st_ses_id=$ss_id");
                if( mysqli_num_rows($result) > 0) {
                    mysqli_query($link, "UPDATE student_info, st_session, st_class, st_group, st_section SET st_name='$stname', st_sex='$stsex', ss_year='$stsession', ss_class_id=$stclass, ss_group_id='$stgroup', ss_section_id='$stsection', ss_roll='$stroll', st_mobile='$stmobile', st_status='0' WHERE st_code='$stcode'");
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-info fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Notice!</strong> ..............Updated!.
                </div>
            </div>
        </div>
        <?php }else{
                    mysqli_query($link, "INSERT INTO st_session (ss_class_id, ss_year, ss_group_id, ss_roll, ss_section_id) VALUES ('$stclass','$stsession','$stgroup','$stroll','$stsection')");
                    
                    // Maximum Subjects
                    $ssid=0;
                    $resultmaxid = mysqli_query($link, "SELECT max(ss_id) FROM st_session");
                    while($row=mysqli_fetch_array($resultmaxid)){
                        $ssid=$row['max(ss_id)'];
                    }
                    
                    mysqli_query($link, "INSERT INTO student_info (st_code, st_name, st_sex, st_mobile, st_status, st_ses_id ) VALUES ('$stcode', '$stname','$stsex', '$stmobile','0',$ssid )");
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Notice!</strong> .....Successfully Inserted.
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <?php    }
        }
        
        
        // Total Student Count
        $resulttotalstudent = mysqli_query($link, "SELECT * FROM student_info");
        $totalstudent = mysqli_num_rows($resulttotalstudent);
        ?>
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Total Student -
                    <span class="badge"><?php echo "" . $totalstudent ." ";?></span>
                </div>
                <div class="panel-body">  
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Id</th>
                                <th>Student Code</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Session</th>
                                <th>Class</th>
                                <th>Group</th>
                                <th>Section</th>
                                <th>Roll</th>
                                <th>Mobile No</th>
                                <th>Status</th>
                            </tr>
                            <?php  
        $resultstudent = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group, st_section WHERE student_info.st_ses_id=st_session.ss_id AND ss_class_id=sc_id AND ss_group_id=sg_id AND ss_section_id=ssec_id ORDER BY student_info.st_id DESC LIMIT 1"); 
            if(mysqli_num_rows($resultstudent) > 0){
                while($row = mysqli_fetch_array($resultstudent)){
                    ?>
                            <tr>
                                <td><?php echo $row['st_id']; ?></td>
                                <td><?php echo $row['st_code']; ?></td>
                                <td><?php echo $row['st_name']; ?></td>
                                <td><?php echo $row['st_sex'];?></td>
                                <td><?php echo $row['ss_year'];?></td>
                                <td><?php echo $row['sc_name'];?></td>
                                <td><?php echo $row['sg_group'];?></td>
                                <td><?php echo $row['ssec_section'];?></td>
                                <td><?php echo $row['ss_roll'];?></td>
                                <td><?php echo $row['st_mobile'];?></td>
                                <td><?php if($row['st_status']==0){ echo "Active"; }else{echo "Inactive";} }?></td>
                                
                                <?php 
                // Close result set
                mysqli_free_result($result);
            }else{
                mysqli_close($link);
            }
        
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div><!-- End containder -->
<?php include 'footer.php';?>