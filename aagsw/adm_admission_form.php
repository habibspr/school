<?php include "header.php" ;?>
<?php include "nav-bar.php" ;?>

<div class="container">
    <?php 
    include "adm_database_status.php";
    if($General_Security_Status){?>
    <div class="alert alert-success fade in">
        <strong>Permission ! </strong> You are not permitted !
    </div> 
    <?php die();} ?>
    
    <div class="page-header">
            <h3 class="text-center">Admission Form</h3>
        </div>
            
        <form class="form-horizontal" action="adm_print_admission_form_show.php" role="form" method="post"> 
            
            <div class="row">                
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="formdate" class="col-md-4 control-label">Date</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="formdate" type="date" name="formdate"  value="<?php echo date('Y-m-d');?>">
                        </div>
                    </div>
                </div>
                 <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="session" class="col-md-4 control-label">Session</label>
                        <div class="col-md-8">
                            <input class="form-control" id="session" name="session" value="<?php if(date('m')>6){ echo date('Y')+1; } else { echo date('Y'); }?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="class" class="col-md-4 control-label">Class</label>
                        <div class="col-md-8">
                            <select id="class" class="form-control selectpicker" data-mobile="true" name="class">
                                <?php 
                                $sql="SELECT * FROM adm_class_mst"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[acm_id]' > $row[acm_name] </option>";
                                } ?>            
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3 class="text-left"><strong> 1. </strong>General Info</h3>
                <hr>
            </div>         
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="name" type="text" name="name" style="text-transform:uppercase" value="" placeholder="Student Name" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mobile" class="col-md-4 control-label">Mobile No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mobile" type="text" name="mobile" placeholder="01XXXXXXXXX" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="dob" class="col-md-4 control-label">Date of birth</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="dob" type="date" required name="dob" value="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="gender" class="col-md-4 control-label">Gender</label>
                        <div class="col-md-8">
                            <select id="gender" class="form-control selectpicker" data-mobile="true" name="gender">
                                <?php 
                                $sql="SELECT * FROM adm_sex_mst"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[asxm_id]' > $row[asxm_name] </option>";
                                } ?>  
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
                                $sql="SELECT * FROM adm_religion_mst"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[arm_id]' > $row[arm_name] </option>";
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
                                $sql="SELECT * FROM adm_blood_mst ORDER BY abm_id DESC"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value = '$row[abm_id]' > $row[abm_name] </option>";
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
                        <label for="familyno" class="col-md-4 control-label">No. of Family Members</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="familyno" type="text" name="familyno" value="" placeholder="Family Members">
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
                            <input  class="form-control" id="vill" type="text" name="vill" style="text-transform:uppercase"  value="GILARCHALA" placeholder="Village">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="PO" class="col-md-4 control-label">Post office</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="PO" type="text" name="PO" style="text-transform:uppercase" value="GILABERAID" placeholder="Post Office">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="postcode" class="col-md-4 control-label">Postal Code</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="postcode" type="text" name="postcode" value="1740" placeholder="Postal Code">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="upazilla" class="col-md-4 control-label">Upazilla/Thana</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="upazilla" style="text-transform:uppercase" type="text" name="upazilla" value="SREEPUR" placeholder="Upazilla/Thana">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="district" class="col-md-4 control-label">District/City</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="district" style="text-transform:uppercase" type="text" name="district" value="GAZIPUR" placeholder="District/City">
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
                            <input class="form-control" id="fname" type="text" name="fname" style="text-transform:uppercase" value="" placeholder="Father's Name" required>
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
                            <input class="form-control" id="foccu" type="text" name="foccu" style="text-transform:uppercase" value="" placeholder="Occupation">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fyin" class="col-md-4 control-label">Yearly Income (Taka)</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fyin" type="text" name="fyin" style="text-transform:uppercase" value="" placeholder="Yearly Income (Taka)">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fnid" class="col-md-4 control-label">NID No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fnid" type="text" name="fnid" style="text-transform:uppercase" value="" placeholder="NID No.">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fmob" class="col-md-4 control-label">Mobile No</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fmob" type="text" name="fmob" style="text-transform:uppercase" value="" placeholder="Mobile No">
                        </div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <h3 class="text-left"><strong> 4. </strong>Mother's Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mname" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mname" type="text" name="mname" style="text-transform:uppercase" value="" placeholder="Mother's Name" required>
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
                            <input class="form-control" id="moccu" type="text" name="moccu" style="text-transform:uppercase" value="HOUSE WIFE" placeholder="Occupation" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="myin" class="col-md-4 control-label">Yearly Income (Taka)</label>
                        <div class="col-md-8">
                            <input class="form-control" id="myin" type="text" name="myin" style="text-transform:uppercase" value="" placeholder="Yearly Income (Taka)">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mnid" class="col-md-4 control-label">NID No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mnid" type="text" name="mnid" style="text-transform:uppercase" value="" placeholder="NID No.">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mmob" class="col-md-4 control-label">Mobile No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mmob" type="text" name="mmob" style="text-transform:uppercase"  value="" placeholder="Mobile No.">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3 class="text-left"><strong> 5. </strong>Academic Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="acschool" class="col-md-4 control-label">Prevous School Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="acschool" type="text" name="pschool" style="text-transform:uppercase" value="" placeholder="Prevous School Name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Submit</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div><!-- End containder -->


<script>
// mothers mobile no. from main mobile no.//
$('#mobile').keyup(function(){
   $('#mmob').val($('#mobile').val());
});
</script>
