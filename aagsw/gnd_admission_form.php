<?php include "header.php" ;?>
<?php include "nav-bar.php" ;?>

<div class="container">
    <?php 
    if(empty($Others_User)){
        include_once "../others_login.php";
        die();
    }
    
    ?>
    <div class="row">
        <form class="form-horizontal" action="../aagsw/gnd_print_admission_form.php" role="form" method="post">
        <?php 
        if(isset($_POST['others_id'])){ // Fetching variables of the form which travels in URL     
            
            $form_no = isset($_POST['others_id']) ? $_POST['others_id'] : '';   
            
            if($resultsearch = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_address_mst WHERE aui_form_no ='$form_no' AND aam_aui_id=aui_id")){
                if(mysqli_num_rows($resultsearch) > 0){
                    while($row = mysqli_fetch_array($resultsearch)){
                        $formid=$row['aui_id'];
                        $formno=$row['aui_form_no'];
                        $formdate=$row['aui_date'];
                        $session=$row['aui_session'];
                        $adclass=$row['aui_class_id'];
                        $name=$row['aui_name'];
                        $gender_id=$row['aui_gender_id'];
                        $dob=$row['aui_dob'];
                        $mobile=$row['aui_mobile'];
                        $hobby=$row['aui_hobby'];
                        $familyno=$row['aui_family_no'];
                        $vill=$row['aam_vill'];
                        $post=$row['aam_post'];
                        $postcode=$row['aam_postal_code'];
                        $upzilla=$row['aam_upazilla'];
                        $district=$row['aam_district'];
                        $country=$row['aam_country'];
                        $fname=$row['aui_father_name'];
                        $fquali=$row['aui_father_quali'];
                        $foccu=$row['aui_father_occu'];
                        $fyin=$row['aui_father_yin'];
                        $fnid=$row['aui_father_nid'];
                        $fmob=$row['aui_father_mobile'];
                        $mname=$row['aui_mather_name'];
                        $mquali=$row['aui_mather_quali'];
                        $moccu=$row['aui_mather_occu'];
                        $myin=$row['aui_mather_yin'];
                        $mnid=$row['aui_mather_nid'];
                        $mmob=$row['aui_mather_mobile'];
                        $acschool=$row['aui_ac_school'];
                        $adfpayment=$row['aui_adf_payment'];
                    }
                }
            }
        }
        
            
            // admisson grand sequrity 
            $Grand_Session_Sequrity = 0 ;
            $Session_Sequrity_Result = mysqli_query($link,  "SELECT * FROM adm_security_mst WHERE asec_session='$session'");
            while($row = mysqli_fetch_array($Session_Sequrity_Result)){
                $Grand_Session_Sequrity = $row['asec_grand_status'];
            }
            if($Grand_Session_Sequrity){?>
            <div class="alert alert-success fade in">
                <strong>Notice ! </strong> Admission Grand time over !
            </div>
            <?php die();}
            
            
        ?>   
            <div class="row">
                <div class="col-md-4"></div>
                <h3 class="text-left"><strong> 1. </strong>General Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="formid" class="col-md-4 control-label">Form id.</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="formid" name="formid" value="<?php echo $formid;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="formno" class="col-md-4 control-label">Form No.</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="formno" name="formno" value="<?php echo $formno;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="formdate" class="col-md-4 control-label">Date</label>
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
                            <input class="form-control" id="session" type="text" name="session" value="<?php echo $session;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="class" class="col-md-4 control-label">Class</label>
                        <div class="col-md-8">
                            <select id="class" class="form-control selectpicker" data-mobile="true" name="class" >
                                <?php 
                                $sql="SELECT * FROM adm_class_mst"; 
                                foreach ($link->query($sql) as $row){?>
                                    <option <?php if($adclass == $row['acm_id']){echo "selected";}?> value = '<?php echo $row['acm_id']?>' > <?php echo $row['acm_name'];?> </option>
                                <?php } ?>            
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
                                $sql="SELECT * FROM adm_group_mst"; 
                                foreach ($link->query($sql) as $row){?>
                                    <option <?php if($adclass == $row['agm_id']){echo "selected";}?> value = '<?php echo $row['agm_id']?>' > <?php echo $row['agm_name'];?> </option>
                                <?php } ?>            
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="section" class="col-md-4 control-label">Section</label>
                        <div class="col-md-8">
                            <select id="section" class="form-control selectpicker" data-mobile="true" name="section">
                                <?php 
                                    $sql="SELECT * FROM adm_section_mst"; 
                                    foreach ($link->query($sql) as $row){ ?>
                                        <option <?php if($adclass == $row['asm_id']){echo "selected";}?> value = '<?php echo $row['asm_id']?>' > <?php echo $row['asm_name'];?> </option>
                                    <?php } ?>            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="roll" class="col-md-4 control-label">Roll</label>
                        <div class="col-md-8">
                            <input class="form-control" id="roll" type="text" name="roll" value="0">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="name" type="text" name="name" style="text-transform:uppercase" value="<?php echo $name;?> " placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="dob" class="col-md-4 control-label">Date of Birth</label>
                        <div class="col-md-8">
                            <input class="form-control" id="dob" type="text" name="dob" style="text-transform:uppercase" value="<?php echo $dob;?> " placeholder="" >
                        </div>
                    </div>
                </div> 
                <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                            <label for="dob_certificate" class="col-md-4 control-label">Birth Certificate No</label>
                            <div class="col-md-8">
                                <input  class="form-control" id="dob_certificate" type="text" name="dob_certificate" value="N/A">
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mobile" class="col-md-4 control-label">Mobile</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mobile" type="text" name="mobile" style="text-transform:uppercase" value="<?php echo $mobile;?> " placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="gender" class="col-md-4 control-label">Gender</label>
                        <div class="col-md-8">
                            <select id="gender" class="form-control selectpicker" data-mobile="true" name="gender" >
                                <option <?php if($gender_id == 1){echo "selected";}?> value = '1' > Female </option>
                                <option <?php if($gender_id == 2){echo "selected";}?> value = '2' > Male </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="religion" class="col-md-4 control-label">Religion</label>
                        <div class="col-md-8">
                            <select id="religion" class="form-control selectpicker" data-mobile="true" name="religion" >
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
                            <input  class="form-control" id="hobby" style="text-transform:uppercase" type="text" name="hobby" value="<?php echo $hobby; ?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="familyno" class="col-md-4 control-label">No. of Family Members</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="familyno" type="text" name="familyno" value="<?php echo $familyno;?>" >
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
                            <input  class="form-control" id="vill" type="text" name="vill" style="text-transform:uppercase"  value="<?php echo $vill;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="PO" class="col-md-4 control-label">Post office</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="PO" type="text" name="PO" style="text-transform:uppercase" value="<?php echo $post;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="postcode" class="col-md-4 control-label">Postal Code</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="postcode" type="text" name="postcode" value="<?php echo $postcode;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="upazilla" class="col-md-4 control-label">Upazilla/Thana</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="upazilla" style="text-transform:uppercase" type="text" name="upazilla" value="<?php echo $upzilla; ?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="district" class="col-md-4 control-label">District/City</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="district" style="text-transform:uppercase" type="text" name="district" value="<?php echo $district; ?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="country" class="col-md-4 control-label">Country</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="country" style="text-transform:uppercase" type="text" name="country" value="<?php echo $country;?>" >
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
                            <input class="form-control" id="fname" type="text" name="fname" style="text-transform:uppercase" value="<?php echo $fname; ?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fquali" class="col-md-4 control-label">Qualification</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fquali" type="text" name="fquali" style="text-transform:uppercase" value="<?php echo $fquali;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="foccu" class="col-md-4 control-label">Occupation</label>
                        <div class="col-md-8">
                            <input class="form-control" id="foccu" type="text" name="foccu" style="text-transform:uppercase" value="<?php echo $foccu;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fyin" class="col-md-4 control-label">Yearly Income</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fyin" type="text" name="fyin" style="text-transform:uppercase" value="<?php echo $fyin;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fnid" class="col-md-4 control-label">NID No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fnid" type="text" name="fnid" style="text-transform:uppercase" value="<?php echo $fnid ;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="fmob" class="col-md-4 control-label">Mobile No</label>
                        <div class="col-md-8">
                            <input class="form-control" id="fmob" type="text" name="fmob" style="text-transform:uppercase" value="<?php echo $fmob ;?>" >
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
                            <input class="form-control" id="mname" type="text" name="mname" style="text-transform:uppercase" value="<?php echo $mname ;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mquali" class="col-md-4 control-label">Qualification</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mquali" type="text" name="mquali" style="text-transform:uppercase" value="<?php echo $mquali;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="moccu" class="col-md-4 control-label">Occupation</label>
                        <div class="col-md-8">
                            <input class="form-control" id="moccu" type="text" name="moccu" style="text-transform:uppercase" value="<?php echo $moccu;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="myin" class="col-md-4 control-label">Yearly Income</label>
                        <div class="col-md-8">
                            <input class="form-control" id="myin" type="text" name="myin" style="text-transform:uppercase" value="<?php echo $myin;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mnid" class="col-md-4 control-label">NID No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mnid" type="text" name="mnid" style="text-transform:uppercase" value="<?php echo $mnid;?>" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mmob" class="col-md-4 control-label">Mobile No</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mmob" type="text" name="mmob" style="text-transform:uppercase" value="<?php echo $mmob;?>" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3 class="text-left"><strong> 5. </strong>Academic Info</h3>
                <hr>
                <div class="col-sm-6 col-lg-8">
                    <div class="form-group">
                        <label for="acschool" class="col-md-4 control-label">School Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="acschool" type="text" name="acschool" style="text-transform:uppercase" value="<?php echo $acschool;?>" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Admitted</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div><!-- End containder -->