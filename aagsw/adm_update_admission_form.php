<?php include "header.php" ;?>
<?php include "nav-bar.php" ;?>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<div class="container">
    <?php
	
    if(empty($Others_User)){
    include_once "../others_login.php";
    die();
    }?>
    <div class="page-header">
    <h2 class="text-center">Update Applicant Information</h2>
    </div>
    
    
    <?php 
    include "adm_database_status.php";
    if($General_Security_Status){?>
    <div class="alert alert-success fade in">
        <strong>Permission ! </strong> You are not permitted !
    </div> 
    <?php die(); } 
    
    if(isset($_POST['others_id'])){ // Fetching variables of the form which travels in URL     
        
        $form_no = isset($_POST['others_id']) ? $_POST['others_id'] : '';   
        
        if($resultsearch = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_address_mst WHERE aui_form_no ='$form_no' AND aam_aui_id=aui_id")){
            if(mysqli_num_rows($resultsearch) > 0){
                while($row = mysqli_fetch_array($resultsearch)){
                    $formid=$row['aui_id'];
                    $formno=$row['aui_form_no'];
                    $formdate=$row['aui_date'];
                    $session=$row['aui_session'];
                    $Applicant_Mobile=$row['aui_mobile'];
                    $name=$row['aui_name'];
                    $gender_id=$row['aui_gender_id'];
                    $religion_id = $row['aui_religion_id'];
                    $blood_id = $row['aui_blood_id'];
                    $DOB=$row['aui_dob'];
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
                    $adclass=$row['aui_class_id'];
                    $adfpayment=$row['aui_adf_payment'];
                }
            }
        }
    }
    ?>     
    
    <form class="form-horizontal" action="adm_print_update_admission_form.php" role="form" method="post">
        <input type="hidden" style="text-transform:uppercase" class="form-control" id="formid" name="formid" value="<?php echo $formid;?>">
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="formno">Application form No. </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" style="text-transform:uppercase" type="text" id="formno" name="formno" value="<?php echo $formno;?>" readonly>
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
                                $sql="SELECT * FROM adm_class_mst"; 
                                foreach ($link->query($sql) as $row){?>
                                    <option <?php if($adclass == $row['acm_id']){echo "selected";}?> value = '<?php echo $row['acm_id']?>' > <?php echo $row['acm_name'];?> </option>
                                <?php } ?>          
                        </select>
            </div>
            
            <div class="col-xs-4 input-group-lg">
                <label for="Applicant_Mobile">Applicant/Gaurdian's mobile no. </label>
                <input style="text-transform:uppercase" class="form-control col-sm-4" id="Applicant_Mobile" type="text" name="Applicant_Mobile" value="<?php echo $Applicant_Mobile;?>">
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
                    $sql="SELECT * FROM adm_religion_mst"; 
                    foreach ($link->query($sql) as $row){ ?>
                                        <option <?php if($religion_id == $row['arm_id']){echo "selected";}?> value = '<?php echo $row['arm_id']?>' > <?php echo $row['arm_name'];?> </option>
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
                                $sql="SELECT * FROM adm_blood_mst"; 
                                foreach ($link->query($sql) as $row){?>
                                    <option <?php if($blood_id == $row['abm_id']){echo "selected";}?> value = '<?php echo $row['abm_id']?>' > <?php echo $row['abm_name'];?> </option>
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
        
        <div class="page-header">
            <h3 class="text-left">5. Applicant's payment information</h3>
        </div>
        
        <div class="form-group row">
            
            <div class="col-xs-4 input-group-lg">
                <label for="blood">Payment Taka. </label>
                <input class="form-control col-sm-4" id="adfpayment" type="text" name="adfpayment" style="text-transform:uppercase" value="<?php echo $adfpayment;?>" readonly>
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

