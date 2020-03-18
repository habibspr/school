<?php include "header.php" ;?>
<?php include "nav-bar.php" ;?>

<div class="container">
    <?php
    if(isset($_POST['formid'])){ // Fetching variables of the form which travels in URL          
        $formid = isset($_POST['formid']) ? $_POST['formid'] : '';
        $Dob = isset($_POST['Dob']) ? $_POST['Dob'] : '';
        $Formdate = isset($_POST['formdate']) ? $_POST['formdate'] : '';
        $Session = isset($_POST['session']) ? $_POST['session'] : '';
        $Applicant_Mobile = isset($_POST['Applicant_Mobile']) ? $_POST['Applicant_Mobile'] : '';
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
        $Pschool = isset($_POST['acschool']) ? $_POST['acschool'] : '';
        
            if(!empty($formid)){
                // User info update
                $resultui=mysqli_query($link,"SELECT * FROM adm_user_info WHERE aui_id ='$formid'");
                
                if(mysqli_num_rows($resultui)>0){
                    mysqli_query($link, "UPDATE adm_user_info SET aui_session='$Session', aui_mobile='$Applicant_Mobile', aui_name=upper('$Name'), aui_class_id='$Class', aui_dob='$Dob', aui_gender_id='$Gender', aui_religion_id='$Religion', aui_blood_id='$Blood', aui_hobby=upper('$Hobby'), aui_family_no='$Familyno', aui_father_name=upper('$Fname'), aui_father_quali=upper('$Fquali'), aui_father_occu=upper('$Foccu'), aui_father_yin='$Fyin', aui_father_nid='$Fnid', aui_father_mobile='$Fmob', aui_mather_name=upper('$Mname'), aui_mather_quali=upper('$Mquali'), aui_mather_occu=upper('$Moccu'), aui_mather_yin='$Myin', aui_mather_nid='$Mnid', aui_mather_mobile='$Mmob', aui_ac_school=upper('$Pschool') WHERE aui_id='$formid' "); 
                    
                    // Adress update
                    $resultadr=mysqli_query($link,"SELECT * FROM adm_address_mst WHERE aam_aui_id ='$formid'");
                    
                    if(mysqli_num_rows($resultadr)>0){
                        mysqli_query($link, "UPDATE adm_address_mst SET aam_vill=upper('$Vill'), aam_post=upper('$PO'), aam_upazilla=upper('$Upazilla'), aam_district= upper('$District'), aam_postal_code='$Postcode', aam_country=upper('$Country') WHERE aam_aui_id=('$formid') ");
                    }else{
                        
                        mysqli_query($link, "INSERT INTO adm_address_mst (aam_aui_id, aam_vill , aam_post , aam_upazilla , aam_district , aam_postal_code , aam_country ) VALUES ('$formid', upper('$Vill') , upper('$PO') , upper('$Upazilla') , upper('$District') , '$Postcode' , upper('$Country') )");
                    
                    }
                }
            }
        
    ?>
    <div class="page-header">
        <h4 class="text-center">ADMISSION FORM  [ Admission test - <?php echo "$Session";?> ]</h4>
    </div>
    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <?php 
            if($resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_address_mst, adm_blood_mst, adm_class_mst, adm_religion_mst, adm_sex_mst WHERE aui_religion_id=arm_id AND acm_id=aui_class_id AND abm_id=aui_blood_id AND aui_gender_id=asxm_id AND aam_aui_id='$formid' AND aui_id ='$formid' ORDER BY aui_id ASC")){
                if(mysqli_num_rows($resultprint) > 0){
                    while($row = mysqli_fetch_array($resultprint)){?>
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
                <th class="text-left" style="vertical-align:middle;"><?php echo $dob=$row['aui_dob'];?></th>
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


