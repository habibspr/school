<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "../aags/header.php" ;?>
<?php include "../nav-bar.php" ;?>

<?php 
    session_start();
    $student_id = $_GET["student_id"];
    $student_code = $_GET["student_code"];
    $formdate = $_GET["formdate"];
    ?>
<div class="container">
    <div class="row">
        <form class="form-horizontal" action="../aags/atdn_print_update_student_info.php" role="form" method="post">
            <input class="form-control" type="hidden" id="student_id" name="student_id" value="<?php echo $student_id;?>" disabled>
            <input class="form-control" type="hidden" id="student_code" name="student_code" value="<?php echo $student_code;?>" disabled>
            <div class="row">
                <div class="col-md-4"></div>
                <h3 class="text-left"><strong> 1. </strong>General Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="studentid" class="col-md-4 control-label">Student Id</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="studentid" name="studentid" value="<?php echo $student_id;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="student_code" class="col-md-4 control-label">Student code</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="student_code" name="student_code" value="<?php echo $student_code;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="formdate" class="col-md-4 control-label">Admission Date</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="formdate" type="text" name="formdate" value="<?php echo $formdate;?>"  readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="session" class="col-md-4 control-label">Session</label>
                        <div class="col-md-8">
                            <input class="form-control" id="session" type="text" name="session" value="2017">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="adclass" class="col-md-4 control-label">Class</label>
                        <div class="col-md-8">
                            <select id="adclass" class="form-control selectpicker" data-mobile="true" name="adclass">
                                <?php 
                                $sql="SELECT * FROM st_class"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[sc_id]'> $row[sc_name] </option>";
                                } ?>            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="group" class="col-md-4 control-label">Group</label>
                        <div class="col-md-8">
                            <select id="group" class="form-control selectpicker" data-mobile="true" name="group">
                                <?php 
                                $sql="SELECT * FROM st_group"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[sg_id]'> $row[sg_group] </option>";
                                } ?>            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="section" class="col-md-4 control-label">Section</label>
                        <div class="col-md-8">
                            <select id="section" class="form-control selectpicker" data-mobile="true" name="section">
                                <?php 
                                $sql="SELECT * FROM st_section"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[ssec_id]'> $row[ssec_section] </option>";
                                } ?>            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="roll" class="col-md-4 control-label">Roll</label>
                        <div class="col-md-8">
                            <input class="form-control" id="roll" type="text" name="roll" value="" placeholder="Roll No.">
                        </div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="name" type="text" name="name" style="text-transform:uppercase" value="" placeholder="Student Name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="gender" class="col-md-4 control-label">Gender</label>
                        <div class="col-md-8">
                            <select id="gender" class="form-control selectpicker" data-mobile="true" name="gender">
                                <option value="FEMALE" selected>Female</option>
                                <option value="MALE">Male</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="religion" class="col-md-4 control-label">Religion</label>
                        <div class="col-md-8">
                            <select id="religion" class="form-control selectpicker" data-mobile="true" name="religion">
                                <?php 
                                $sql="SELECT * FROM st_religion"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[str_id]' > $row[str_name] </option>";
                                } ?>            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="blood" class="col-md-4 control-label">Blood Group</label>
                        <div class="col-md-8">
                            <select id="blood" class="form-control selectpicker" data-mobile="true" name="blood">
                                <?php 
                                $sql="SELECT * FROM st_blood"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[stb_id]' > $row[stb_name] </option>";
                                } ?>            
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="hobby" class="col-md-4 control-label">Hobby</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="hobby" style="text-transform:uppercase" type="text" name="hobby" value="" placeholder="Hobby" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="familyno" class="col-md-4 control-label">Family Members</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="familyno" type="text" name="familyno" value="" placeholder="No. of Family Members">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <h3 class="text-left"><strong>2. </strong>Adress</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="vill" class="col-md-4 control-label">Village/Road</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="vill" type="text" name="vill" style="text-transform:uppercase"  value="" placeholder="Village/Road">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="PO" class="col-md-4 control-label">Post office</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="PO" type="text" name="PO" style="text-transform:uppercase" value="" placeholder="Post office">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="postcode" class="col-md-4 control-label">Postal Code</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="postcode" type="text" name="postcode" value="" placeholder="Post office">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="upazilla" class="col-md-4 control-label">Upazilla/Thana</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="upazilla" style="text-transform:uppercase" type="text" name="upazilla" value="" placeholder="Upazilla/Thana" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="district" class="col-md-4 control-label">District/City</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="district" style="text-transform:uppercase" type="text" name="district" value="" placeholder="District/City">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="country" class="col-md-4 control-label">Country</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="country" style="text-transform:uppercase" type="text" name="country" value="Bangladesh">
                        </div>
                    </div>
                </div>            
            </div>            
            <div class="row">
                <h3 class="text-left"><strong> 3. </strong>Father's Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fname" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fname" type="text" name="fname" style="text-transform:uppercase" value="" placeholder="Father's Name">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fquali" class="col-md-4 control-label">Qualification</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fquali" type="text" name="fquali" style="text-transform:uppercase" value="" placeholder="Qualification">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="foccu" class="col-md-4 control-label">Occupation</label>
                        <div class="col-md-8">
                            <input class="form-control" id="foccu" type="text" name="foccu" style="text-transform:uppercase" value="" placeholder="Qualification">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fyin" class="col-md-4 control-label">Yearly Income</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fyin" type="text" name="fyin" style="text-transform:uppercase" value="" placeholder="Yearly Income">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fnid" class="col-md-4 control-label">NID No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fnid" type="text" name="fnid" style="text-transform:uppercase" value="" placeholder="National Id No.">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fmob" class="col-md-4 control-label">Mobile No</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fmob" type="text" name="fmob" style="text-transform:uppercase" value="" placeholder="Mobile No.">
                        </div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <h3 class="text-left"><strong> 4. </strong>Mather's Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mname" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mname" type="text" name="mname" style="text-transform:uppercase" value="" placeholder="Mother's Name">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mquali" class="col-md-4 control-label">Qualification</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mquali" type="text" name="mquali" style="text-transform:uppercase" value="" placeholder="Qualification">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="moccu" class="col-md-4 control-label">Occupation</label>
                        <div class="col-md-8">
                            <input class="form-control" id="moccu" type="text" name="moccu" style="text-transform:uppercase" value="" placeholder="Occupation">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="myin" class="col-md-4 control-label">Yearly Income</label>
                        <div class="col-md-8">
                            <input class="form-control" id="myin" type="text" name="myin" style="text-transform:uppercase" value="" placeholder="Yearly Income">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mnid" class="col-md-4 control-label">NID No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mnid" type="text" name="mnid" style="text-transform:uppercase" value="" placeholder="National Id No.">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mmob" class="col-md-4 control-label">Mobile No</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mmob" type="text" name="mmob" style="text-transform:uppercase" value="" placeholder="Mobile No">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3 class="text-left"><strong> 5. </strong>Academic Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="acschoolname" class="col-md-4 control-label">School Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="acschoolname" type="text" name="acschoolname" style="text-transform:uppercase" value="" placeholder="School Name">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="acschooladdress" class="col-md-4 control-label">Address</label>
                        <div class="col-md-8">
                            <input class="form-control" id="acschooladdress" type="text" name="acschooladdress" style="text-transform:uppercase" value="" placeholder="Address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="acclass" class="col-md-4 control-label">Class</label>
                        <div class="col-md-8">
                            <select id="acclass" class="form-control selectpicker" data-mobile="true" name="acclass">
                                <?php $sql="SELECT * FROM st_class"; foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[sc_id]' > $row[sc_name] </option>";
                                } ?>            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="acroll" class="col-md-4 control-label">Roll No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="acroll" type="text" name="acroll" style="text-transform:uppercase" value="" placeholder="Roll No.">
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
</div><!-- End containder -->