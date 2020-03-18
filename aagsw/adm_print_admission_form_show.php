<?php include "header.php" ;?>
<?php include 'nav-bar.php';?>
<div class="container">
   <?php

       //getting logged user CODE as ref_id
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $ref_id = $_SESSION["login_id"];


        if(isset($_POST['mobile'])){ // Fetching variables of the form which travels in URL 
            $Mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
            $Dob = isset($_POST['dob']) ? $_POST['dob'] : '';
            $Formdate = isset($_POST['formdate']) ? $_POST['formdate'] : '';
            $Session = isset($_POST['session']) ? $_POST['session'] : '';
            $Class = isset($_POST['class']) ? $_POST['class'] : '';
            $Name = isset($_POST['name']) ? $_POST['name'] : '';
            $Gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $Religion = isset($_POST['religion']) ? $_POST['religion'] : '';
            $Blood = isset($_POST['blood']) ? $_POST['blood'] : '';
            $Hobby = isset($_POST['hobby']) ? $_POST['hobby'] : '';
            $Familyno = isset($_POST['familyno']) ? $_POST['familyno'] : '';
            $Vill = isset($_POST['vill']) ? $_POST['vill'] : '';
            $PO = isset($_POST['PO']) ? $_POST['PO'] : '';
            $Postcode = isset($_POST['postcode']) ? $_POST['postcode'] : '';
            $Upazilla = isset($_POST['upazilla']) ? $_POST['upazilla'] : '';
            $District = isset($_POST['district']) ? $_POST['district'] : '';
            $Country = isset($_POST['country']) ? $_POST['country'] : '';
            $Fname = isset($_POST['fname']) ? $_POST['fname'] : '';
            $Fquali = isset($_POST['fquali']) ? $_POST['fquali'] : '';
            $Foccu = isset($_POST['foccu']) ? $_POST['foccu'] : '';
            $Fyin = isset($_POST['fyin']) ? $_POST['fyin'] : '';
            $Fnid = isset($_POST['fnid']) ? $_POST['fnid'] : '';
            $Fmob = isset($_POST['fmob']) ? $_POST['fmob'] : '';
            $Mname = isset($_POST['mname']) ? $_POST['mname'] : '';
            $Mquali = isset($_POST['mquali']) ? $_POST['mquali'] : '';
            $Moccu = isset($_POST['moccu']) ? $_POST['moccu'] : '';
            $Myin = isset($_POST['myin']) ? $_POST['myin'] : '';
            $Mnid = isset($_POST['mnid']) ? $_POST['mnid'] : '';
            $Mmob = isset($_POST['mmob']) ? $_POST['mmob'] : '';
            $Pschool = isset($_POST['pschool']) ? $_POST['pschool'] : '';
            
            if(empty($Mobile) || empty($Dob)){?>
        <p class="text-center"><strong>Notice!</strong> Please fill up ....Blank Fields.</p> 
        <?php 
            }else if(!is_numeric($Mobile)){ 
        ?>
        <p class="text-center"><strong>Mobile No.</strong> Please Enter like 0123456789.</p> 
        <?php
            }else if(strlen($Mobile) != 11){?>
        <p class="text-center"><strong>Mobile No.</strong> Please Enter 11 Number.</p>
        <?php
            }else{
                if($Dob>=date('Y-m-d')){?>
        <p class="text-center"><strong>Notice!</strong> Invalied Date of birth.</p>
        <?php 
                }else{                   
                    // Form No
                    $aui_id=1;
                    $resultmax = mysqli_query($link, "SELECT * FROM adm_user_info ORDER BY aui_id DESC LIMIT 1");
                    $row = mysqli_fetch_array($resultmax);       
                    $aui_id=$row['aui_id']+1;
                    
                    $formno= $Session . str_pad($aui_id,6,"0",STR_PAD_LEFT);// for session add and last id
                    
                    if(!empty($Mobile)){                        
                        $result=mysqli_query($link,"SELECT * FROM adm_user_info WHERE aui_mobile ='$Mobile' AND aui_dob ='$Dob'");
                        if(mysqli_num_rows($result)>0){
                            mysqli_query($link, "UPDATE adm_user_info SET aui_session='$Session', aui_name=upper('$Name'), aui_class_id='$Class', aui_gender_id='$Gender', aui_religion_id='$Religion', aui_blood_id='$Blood', aui_hobby=upper('$Hobby'), aui_family_no='$Familyno', aui_father_name=upper('$Fname'), aui_father_quali=upper('$Fquali'), aui_father_occu=upper('$Foccu'), aui_father_yin='$Fyin', aui_father_nid='$Fnid', aui_father_mobile='$Fmob', aui_mather_name=upper('$Mname'), aui_mather_quali=upper('$Mquali'), aui_mather_occu=upper('$Moccu'), aui_mather_yin='$Myin', aui_mather_nid='$Mnid', aui_mather_mobile='$Mmob', aui_ac_school=upper('$Pschool'), aui_ref_id = '$ref_id' WHERE aui_mobile= '$Mobile' AND aui_dob='$Dob'");
                                          
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_mobile ='$Mobile' AND aui_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['aui_id'];
                            }
                            
                            mysqli_query($link, "UPDATE adm_address_mst SET aam_vill=upper('$Vill'), aam_post=upper('$PO'), aam_upazilla=upper('$Upazilla'), aam_district= upper('$District'), aam_postal_code='$Postcode', aam_country=upper('$Country') WHERE aam_aui_id='$formid' ");
                        
                        }else{                                 
                            mysqli_query($link, "INSERT INTO adm_user_info (aui_form_no, aui_date, aui_session, aui_name, aui_class_id, aui_dob, aui_gender_id, aui_religion_id, aui_blood_id, aui_mobile, aui_hobby, aui_family_no, aui_father_name, aui_father_quali, aui_father_occu, aui_father_yin, aui_father_nid, aui_father_mobile, aui_mather_name, aui_mather_quali, aui_mather_occu, aui_mather_yin, aui_mather_nid, aui_mather_mobile, aui_ac_school, aui_ref_id) VALUES ('$formno', '$Formdate', '$Session', upper('$Name'), '$Class', '$Dob', '$Gender', '$Religion', '$Blood', '$Mobile', upper('$Hobby'), '$Familyno', upper('$Fname'), upper('$Fquali'), upper('$Foccu'), '$Fyin', '$Fnid', '$Fmob', upper('$Mname'), upper('$Mquali'), upper('$Moccu'), '$Myin', '$Mnid', '$Mmob', upper('$Pschool'), '$ref_id' )");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_mobile ='$Mobile' AND aui_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['aui_id'];
                            }                                    
                            mysqli_query($link, "INSERT INTO adm_address_mst (aam_aui_id, aam_vill, aam_post, aam_upazilla, aam_district, aam_postal_code, aam_country) VALUES ('$formid', upper('$Vill'), upper('$PO'), upper('$Upazilla'), upper('$District'), '$Postcode', upper('$Country')  )");
                            
                        }
                    }
                }
            }
        }
    
    // formid //
    $formid=0;
    $resultformid = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_mobile ='$Mobile' AND aui_dob ='$Dob'");
    while($row = mysqli_fetch_array($resultformid)){
        $formid=$row['aui_id'];
    }
    ?>              
    
    <div class="page-header">
        <h4 class="text-center">ADMISSION FORM  [ Admission test - <?php echo "$Session";?> ]</h4>
    </div>
    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <?php 
            if($resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_blood_mst, adm_class_mst, adm_religion_mst, adm_sex_mst, adm_address_mst WHERE abm_id=aui_blood_id AND acm_id=aui_class_id AND aui_religion_id=arm_id AND asxm_id=aui_gender_id AND aam_aui_id=aui_id AND aui_id ='$formid'")){
                if(mysqli_num_rows($resultprint) > 0){
                    while($row = mysqli_fetch_array($resultprint)){
            ?>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Form No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_form_no'];?></th>
                <td class="text-right" style="vertical-align:middle;">Date</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_date'];?></th>                        
                <td class="text-right" style="vertical-align:middle;">Mobile No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mobile'];?></th>
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Personal Info</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_name'];?></th>
                <td class="text-right" style="vertical-align:middle;">Session</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_session'];?></th>
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['acm_name'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Date of birth</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $Dob=$row['aui_dob'];?></th>
                <td class="text-right" style="vertical-align:middle;">Gender</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['asxm_name'];?></th>  
                <td class="text-right" style="vertical-align:middle;">Blood Group</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['abm_name'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Religion</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['arm_name'];?></th>
                <td class="text-right" style="vertical-align:middle;">Hobby</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_hobby'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Number of Family Members</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_family_no'];?></th> 
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Address</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Village</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aam_vill'];?></th>  
                <td class="text-right" style="vertical-align:middle;">Post Office</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aam_post'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Upazilla/Thana</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aam_upazilla'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">District</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aam_district'];?></th>
                <td class="text-right" style="vertical-align:middle;">Postal Code</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aam_postal_code'];?></th>
                <td class="text-right" style="vertical-align:middle;">Country</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aam_country'];?></th>
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Parents Info</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Father's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_name'];?></th>  
                <td class="text-right" style="vertical-align:middle;">Qualification</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_quali'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Occoupation</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_occu'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Yearly Income</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_yin'];?></th>  
                <td class="text-right" style="vertical-align:middle;">NID No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_nid'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Mobile</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_mobile'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Mother's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_name'];?></th>  
                <td class="text-right" style="vertical-align:middle;">Qualification</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_quali'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Occoupation</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_occu'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Yearly Income</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_yin'];?></th>  
                <td class="text-right" style="vertical-align:middle;">NID No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_nid'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Mobile</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_mobile'];?></th>
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Prev. Academic info</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">School Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;" colspan="8"><?php echo $row['aui_ac_school'];?></th>
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Admission info</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;" colspan="8"><?php echo $row['acm_name'];}?></th>
            </tr>
        </table>
    </div>
    <?php
                    }
                }
    ?>
    <div class="row">
        <hr>
        <p class="text-left"><strong>Note:</strong>The all information of above are true. I agree to follow the School's roles and regulations</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed">
                <tr>
                    <td class="text-left" style="vertical-align:middle;">Parents Sign :</td>
                    <td class="text-left" style="vertical-align:middle;">Student Sign :</td>
                </tr>
            </table>
        </div>
    </div>
    
      
</div><!-- container -->


