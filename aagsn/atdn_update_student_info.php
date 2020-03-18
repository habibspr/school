<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php" ;?>
<?php include "nav-bar.php" ;?>



<div class="container">
   
    <?php
        if(isset($_POST["submit_st_update_req"])){

                    $update_st_id=$_POST['update_st_id'];
                    $Applicant_Mobile=$_POST['Applicant_Mobile'];
                    $name=$_POST['name'];
                    $gender_id=$_POST['gender'];
                    $religion_id = (int)$_POST['religion'];
                    $blood_id = $_POST['blood'];
                    $DOB=$_POST['Dob'];
                    $hobby=$_POST['hobby'];
                    $familyno=$_POST['familyno'];
                    $vill=$_POST['vill'];
                    $post=$_POST['PO'];
                    $postcode=$_POST['postcode'];
                    $upzilla=$_POST['upazilla'];
                    $district=$_POST['district'];
                    $country=$_POST['country'];
                    $fname=$_POST['fname'];
                    $fquali=$_POST['fquali'];
                    $foccu=$_POST['foccu'];
                    $fyin=$_POST['fyin'];
                    $fnid=$_POST['fnid'];
                    $fmob=$_POST['fmob'];
                    $mname=$_POST['mname'];
                    $mquali=$_POST['mquali'];
                    $moccu=$_POST['moccu'];
                    $myin=$_POST['myin'];
                    $mnid=$_POST['mnid'];
                    $mmob=$_POST['mmob'];
                    $acschool=$_POST['acschool'];
                    $adclass=$_POST['class'];
                    $Student_Roll=$_POST['Student_Roll'];

                    $update_st_result = mysqli_query($link, "UPDATE student_info, 
                    st_address, 
                    st_parents_info, 
                    st_previous_academic_info, 
                    st_session,
                    st_religion
                    
                    SET st_mobile = '$Applicant_Mobile', 
                    st_name = '$name', 
                    st_sex = '$gender_id', 
                    st_religion_id = '$religion_id', 
                    st_blood_id = '$blood_id', 
                    st_dob = '$DOB', 
                    st_hobby = '$hobby', 
                    st_family_no = '$familyno', 
                    sta_vill = '$vill', 
                    sta_post = '$post', 
                    sta_upazilla = '$upzilla', 
                    sta_district = '$district', 
                    sta_country = '$country', 
                    stpi_st_father_name = '$fname', 
                    stpi_st_father_quali = '$fquali', 
                    stpi_st_father_occu = '$foccu', 
                    stpi_st_father_yin = '$fyin', 
                    stpi_st_father_nid = '$fnid', 
                    stpi_st_father_mobile = '$fmob', 
                    stpi_st_mather_name = '$mname', 
                    stpi_st_mather_quali = '$mquali', 
                    stpi_st_mather_occu = '$moccu', 
                    stpi_st_mather_yin = '$myin', 
                    stpi_st_mather_nid = '$mnid', 
                    stpi_st_mather_mobile = '$mmob', 
                    stpai_school_name = '$acschool', 
                    ss_class_id = '$adclass',
                    ss_roll = '$Student_Roll'
                    
                    WHERE st_id ='$update_st_id' 
                    AND sta_st_id = '$update_st_id' 
                    AND stpi_st_id='$update_st_id' 
                    AND stpai_st_id = '$update_st_id' 
                    AND ss_st_id = '$update_st_id'
                    ") 
                    
                    or die(mysqli_error($link));

                    if($update_st_result){?>
                        <div class="alert alert-success">
                          <strong>Success!</strong> Student updated!.
                        </div>
                    <?php
                    } else {?>
                        <div class="alert alert-danger">
                          <strong>Failed!</strong> Student was not updated!!.
                        </div>
                    <?php }
        }
    ?>
    <h1 class = "text-center">Student Update</h1>
    <hr>
     <?php
    
    if(!isset($_POST["st_id_for_update"])){ ?>
        <form action="" method="post">
            <div class="input-group">
                <input type = "text" class="form-control" id = "st_id_for_update" name = "st_id_for_update" placeholder="Student ID"/>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary" name="submit" value=""> Search </button>
                </span>
            </div><!-- /input-group -->
        </form>
    <?php die();
    }?>
    
    
    
    
    <?php
    
    if(isset($_POST['st_id_for_update'])){ // Fetching variables of the form which travels in URL     
        
        $st_id = $_POST['st_id_for_update'];   
        
        if($resultsearch = mysqli_query($link,  "SELECT * FROM student_info, st_address, st_parents_info, st_previous_academic_info, st_session WHERE st_id ='$st_id' AND sta_st_id = '$st_id' AND stpi_st_id='$st_id' AND stpai_st_id = '$st_id' AND ss_st_id = '$st_id'")){
            if(mysqli_num_rows($resultsearch) > 0){
                while($row = mysqli_fetch_array($resultsearch)){
                    $formid=$row['st_id'];
                    $formno=$row['st_code'];
                    $formdate=$row['st_form_date'];
                    $session=$row['ss_year'];
                    $Applicant_Mobile=$row['st_mobile'];
                    $name=$row['st_name'];
                    $gender_id=$row['st_sex'];
                    $religion_id = $row['st_religion_id'];
                    $blood_id = $row['st_blood_id'];
                    $DOB=$row['st_dob'];
                    $hobby=$row['st_hobby'];
                    $familyno=$row['st_family_no'];
                    $vill=$row['sta_vill'];
                    $post=$row['sta_post'];
                    $postcode=$row['sta_postal_code'];
                    $upzilla=$row['sta_upazilla'];
                    $district=$row['sta_district'];
                    $country=$row['sta_country'];
                    $fname=$row['stpi_st_father_name'];
                    $fquali=$row['stpi_st_father_quali'];
                    $foccu=$row['stpi_st_father_occu'];
                    $fyin=$row['stpi_st_father_yin'];
                    $fnid=$row['stpi_st_father_nid'];
                    $fmob=$row['stpi_st_father_mobile'];
                    $mname=$row['stpi_st_mather_name'];
                    $mquali=$row['stpi_st_mather_quali'];
                    $moccu=$row['stpi_st_mather_occu'];
                    $myin=$row['stpi_st_mather_yin'];
                    $mnid=$row['stpi_st_mather_nid'];
                    $mmob=$row['stpi_st_mather_mobile'];
                    $acschool=$row['stpai_school_name'];
                    $adclass=$row['ss_class_id'];
                    $Student_Roll=$row['ss_roll'];
                    $adfpayment="";
                }
            }
        }
    }
    ?>     
    
    <form class="form-horizontal" action="" role="form" method="post">
        <input type="hidden" style="text-transform:uppercase" class="form-control" id="formid" name="formid" value="<?php echo $formid;?>">
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="formno">Student Code. </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" style="text-transform:uppercase" type="text" id="formno" name="formno" value="<?php echo $formno;?>" readonly>
                <input style="text-transform:uppercase" class="form-control col-sm-4" style="text-transform:uppercase" type="hidden" id="update_st_id" name="update_st_id" value="<?php echo $formid;?>">
            </div>
            <div class="col-xs-4 input-group-lg">
                <label for="session">Session </label>
                <input style="text-transform:uppercase" class="form-control" id="session" style="text-transform:uppercase" type="text" name="session" value="<?php echo $session;?>" readonly>
            </div>
            <div class="col-xs-4 input-group-lg">
                <label for="formdate">Date </label>
                <input style="text-transform:uppercase" class="form-control" id="session" style="text-transform:uppercase" type="text" name="formdate" value="<?php echo $formdate;?>" readonly>
            </div>
            
        </div>
        
        <div class="page-header">
            <h3 class="text-left">1. Applicant basic information</h3>
        </div>    
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="name">Applicant full name </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" id="name" type="text" name="name" style="text-transform:uppercase" value="<?php echo $name;?> ">
            </div>
            
            <div class="col-xs-4 input-group-lg">
                <label for="class">Class wants to be admitted </label>
                <select id="class" class="form-control selectpicker col-sm-4" data-mobile="true" name="class">
                            <?php 
                                $sql="SELECT * FROM st_class"; 
                                foreach ($link->query($sql) as $row){?>
                                    <option <?php if($adclass == $row['sc_id']){echo "selected";}?> value = '<?php echo $row['sc_id']?>' > <?php echo $row['sc_name'];?> </option>
                                <?php } ?>          
                        </select>
            </div>
            
            <div class="col-xs-4 input-group-lg">
                <label for="Applicant_Mobile">Applicant/Gaurdian's mobile no. </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" id="Applicant_Mobile" type="text" name="Applicant_Mobile" value="<?php echo $Applicant_Mobile;?>">
            </div>
            
            <div class="col-xs-4 input-group-lg">
                <label for="Student_Roll">Class Roll. </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" id="Student_Roll" type="text" name="Student_Roll" value="<?php echo $Student_Roll;?>">
            </div>
            
        </div>
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="Dob">Applicant date of birth (YYYY-mm-dd) </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" id="Dob" type="text" name="Dob" value="<?php echo $DOB;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="gender">Applicant gender </label>
                <select id="gender" class="form-control selectpicker col-sm-4" data-mobile="true" name="gender">
                           <option <?php if($gender_id == 1){echo "selected";}?> value = '1' > Female </option>
                                <option <?php if($gender_id == 2){echo "selected";}?> value = '2' > Male </option>
                        </select>
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="religion">Applicant religion </label>
                <select id="religion" class="form-control selectpicker col-sm-4" data-mobile="true" name="religion">
                    <?php 
                    $sql="SELECT * FROM st_religion"; 
                    foreach ($link->query($sql) as $row){ ?>
                                        <option <?php if($religion_id == $row['str_id']){echo "selected";}?> value = '<?php echo $row['str_id']?>' > <?php echo $row['str_name'];?> </option>
                    <?php
                    } ?>            
                </select>
            </div>            
            
        </div>
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Applicant blood group </label>
                <select id="blood" class="form-control selectpicker col-sm-4" data-mobile="true" name="blood">
                                <?php 
                                $sql="SELECT * FROM st_blood"; 
                                foreach ($link->query($sql) as $row){?>
                                    <option <?php if($blood_id == $row['stb_id']){echo "selected";}?> value = '<?php echo $row['stb_id']?>' > <?php echo $row['stb_name'];?> </option>
                                <?php } ?>            
                            </select>
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="hobby">Applicant hobby </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" id="hobby" type="text" name="hobby" value="<?php echo $hobby;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="familyno">Number of family member </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" id="familyno" type="text" name="familyno" value="<?php echo $familyno;?>">
            </div>            
            
        </div>
        
        <div class="page-header">
            <h3 class="text-left">2. Applicant Address</h3>
        </div>
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Village / Road </label>
                <input  class="form-control col-sm-4" id="vill" type="text" name="vill" style="text-transform:uppercase"  value="<?php echo $vill;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="PO">Post Office </label>
                <input  class="form-control col-sm-4" id="PO" type="text" name="PO" style="text-transform:uppercase" value="<?php echo $post;?>" >
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="postcode">Postal code </label>
                <input  class="form-control col-sm-4" id="postcode" type="text" name="postcode" value="<?php echo $postcode;?>">
            </div>            
            
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Upazilla / Thana </label>
                <input  class="form-control col-sm-4" id="upazilla" style="text-transform:uppercase" type="text" name="upazilla" value="<?php echo $upzilla; ?>" >
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="PO">District / City </label>
                <input  class="form-control col-sm-4" id="district" style="text-transform:uppercase" type="text" name="district" value="<?php echo $district; ?>" >                
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="postcode">Postal code </label>
                <input  class="form-control col-sm-4" id="country" style="text-transform:uppercase" type="text" name="country" value="<?php echo $country;?>">
            </div> 
            
        </div>
        
        <div class="page-header">
            <h3 class="text-left">3. Applicant father's information</h3>
        </div>
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Applicant father's name </label>
                <input class="form-control col-sm-4" id="fname" type="text" name="fname" style="text-transform:uppercase" value="<?php echo $fname; ?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="PO">Applicant father's qualification </label>
                <input class="form-control col-sm-4" id="fquali" type="text" name="fquali" style="text-transform:uppercase" value="<?php echo $fquali;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="postcode">Applicant father's occupation </label>
                <input class="form-control col-sm-4" id="foccu" type="text" name="foccu" style="text-transform:uppercase" value="<?php echo $foccu;?>">
            </div>            
            
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Applicant father's yearly income </label>
                <input class="form-control col-sm-4" id="fyin" type="text" name="fyin" style="text-transform:uppercase" value="<?php echo $fyin;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="PO">Applicant father's national identity card No. </label>
                <input class="form-control col-sm-4" id="fnid" type="text" name="fnid" style="text-transform:uppercase" value="<?php echo $fnid ;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="postcode">Applicant father's mobile No </label>
                <input class="form-control col-sm-4" id="fmob" type="text" name="fmob" style="text-transform:uppercase" value="<?php echo $fmob ;?>">
            </div> 
            
        </div>
                       
        <div class="page-header">
            <h3 class="text-left">4. Applicant mother's information</h3>
        </div>
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Applicant mother's name </label>
                <input class="form-control col-sm-4" id="mname" type="text" name="mname" style="text-transform:uppercase" value="<?php echo $mname ;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="PO">Applicant mother's qualification </label>
                <input class="form-control col-sm-4" id="mquali" type="text" name="mquali" style="text-transform:uppercase" value="<?php echo $mquali;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="postcode">Applicant mother's occupation </label>
                <input class="form-control col-sm-4" id="moccu" type="text" name="moccu" style="text-transform:uppercase" value="<?php echo $moccu;?>">
            </div>            
            
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Applicant mother's yearly income </label>
                <input class="form-control col-sm-4" id="myin" type="text" name="myin" style="text-transform:uppercase" value="<?php echo $myin;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="PO">Applicant mother's national identity card No. </label>
                <input class="form-control col-sm-4" id="mnid" type="text" name="mnid" style="text-transform:uppercase" value="<?php echo $mnid;?>">
            </div>            
            
            <div class="col-xs-4 input-group-lg">
                <label for="postcode">Applicant mother's mobile No </label>
                <input class="form-control col-sm-4" id="mmob" type="text" name="mmob" style="text-transform:uppercase" value="<?php echo $mmob;?>">
            </div> 
            
        </div>
            
        <div class="page-header">
            <h3 class="text-left">5. Applicant's academic information</h3>
        </div>
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Applicant previous school name </label>
                <input class="form-control col-sm-4" id="acschool" type="text" name="acschool" style="text-transform:uppercase" value="<?php echo $acschool;?>">
            </div>            
            
        </div>
        
        
            
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="col-md-4">
                            <button type="submit" name="submit_st_update_req" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Update</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div><!-- End containder -->

