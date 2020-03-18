<?php include "header.php" ;?>
<?php include '../nav-bar.php';?>
<div class="container">
    <?php
    if(isset($_POST['student_code'])){ // Fetching variables of the form which travels in URL           
        $studentid = isset($_POST['studentid']) ? $_POST['studentid'] : '';
        $student_code = isset($_POST['student_code']) ? $_POST['student_code'] : '';
        $formdate = isset($_POST['formdate']) ? $_POST['formdate'] : '';
        $session = isset($_POST['session']) ? $_POST['session'] : '';
        $adclass = isset($_POST['adclass']) ? $_POST['adclass'] : '';
        $group = isset($_POST['group']) ? $_POST['group'] : '';
        $section = isset($_POST['section']) ? $_POST['section'] : '';
        $roll = isset($_POST['roll']) ? $_POST['roll'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
        $dob_certificate = isset($_POST['dob_certificate']) ? $_POST['dob_certificate'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $religion = isset($_POST['religion']) ? $_POST['religion'] : '';
        $blood = isset($_POST['blood']) ? $_POST['blood'] : '';
        $hobby = isset($_POST['hobby']) ? $_POST['hobby'] : '';
        $familyno = isset($_POST['familyno']) ? $_POST['familyno'] : '';
        $vill = isset($_POST['vill']) ? $_POST['vill'] : '';
        $PO = isset($_POST['PO']) ? $_POST['PO'] : '';
        $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : '';
        $upazilla = isset($_POST['upazilla']) ? $_POST['upazilla'] : '';
        $district = isset($_POST['district']) ? $_POST['district'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $fname = isset($_POST['fname']) ? $_POST['fname'] : '';        
        $fmob = isset($_POST['fmob']) ? $_POST['fmob'] : '';
        $fnid = isset($_POST['fnid']) ? $_POST['fnid'] : '';
        $fquali = isset($_POST['fquali']) ? $_POST['fquali'] : '';
        $foccu = isset($_POST['foccu']) ? $_POST['foccu'] : '';
        $fyin = isset($_POST['fyin']) ? $_POST['fyin'] : '';
        $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
        $mquali = isset($_POST['mquali']) ? $_POST['mquali'] : '';
        $moccu = isset($_POST['moccu']) ? $_POST['moccu'] : '';
        $myin = isset($_POST['myin']) ? $_POST['myin'] : '';
        $mnid = isset($_POST['mnid']) ? $_POST['mnid'] : '';
        $mmob = isset($_POST['mmob']) ? $_POST['mmob'] : '';
        $acclass = isset($_POST['acclass']) ? $_POST['acclass'] : '';
        $acroll = isset($_POST['acroll']) ? $_POST['acroll'] : '';
        $acschoolname = isset($_POST['acschoolname']) ? $_POST['acschoolname'] : '';
        $acschooladdress = isset($_POST['acschooladdress']) ? $_POST['acschooladdress'] : '';
        
        
        if(!empty($studentid)){
            // User info update
            $result=mysqli_query($link, "SELECT * FROM student_info WHERE st_id=$studentid");
            
            if(mysqli_num_rows($result)>0){
                mysqli_query($link, "UPDATE student_info SET st_name=UPPER('$name'), st_mobile='$mobile', st_dob='$dob', st_dob_certificate='$dob_certificate', st_form_date='$formdate', st_sex=UPPER('$gender'), st_religion_id='$religion', st_blood_id='$blood', st_hobby=UPPER('$hobby') WHERE st_id ='$studentid'"); 
                
                mysqli_query($link, "UPDATE st_session SET ss_class_id=$adclass , ss_group_id=$group, ss_section_id=$section, ss_year='$session', ss_roll='$roll' WHERE st_session.ss_st_id=$studentid ");
                                
                mysqli_query($link, "UPDATE st_address SET sta_vill=UPPER('$vill'), sta_post=UPPER('$PO'), sta_upazilla=UPPER('$upazilla'), sta_district=UPPER('$district'), sta_postal_code='$postcode',  sta_country=UPPER('$country') WHERE st_address.sta_st_id=$studentid ");
                
                mysqli_query($link, "UPDATE st_parents_info SET stpi_st_father_name=UPPER('$fname'), stpi_st_father_mobile='$fmob', stpi_st_father_nid=UPPER('$fnid'), stpi_st_father_occu=UPPER('$foccu'), stpi_st_father_quali=UPPER('$fquali'),  stpi_st_father_yin='$fyin', stpi_st_mather_name=UPPER('$mname'), stpi_st_mather_mobile='$mmob', stpi_st_mather_nid=UPPER('$mnid'), stpi_st_mather_occu=UPPER('$moccu'), stpi_st_mather_quali=UPPER('$mquali'), stpi_st_mather_yin='$myin' WHERE st_parents_info.stpi_st_id='$studentid' ");
                
                mysqli_query($link, "UPDATE st_previous_academic_info SET stpai_school_name = UPPER('$acschoolname') , stpai_school_address = UPPER('$acschooladdress') , stpai_class_id = '$acclass' , stpai_roll ='$acroll' WHERE st_previous_academic_info.stpai_st_id ='$studentid' ");
                }
            }
    }
    
    ?>
    <style>
        h4 {
            letter-spacing: 10px;
        }
    </style>
    <h4 class="text-center"><strong>ADMISSION FORM</strong></h4>
    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <?php 
            
           $acclassname=0;
             $resultacclass=mysqli_query($link, "SELECT * FROM st_previous_academic_info, st_class WHERE stpai_st_id=$studentid AND stpai_class_id=sc_id");
            if(mysqli_num_rows($resultacclass) > 0){
                    while($row = mysqli_fetch_array($resultacclass)){
                        $acclassname=$row['sc_name'];
                    }
            }
            
            if($resultprint = mysqli_query($link,  "SELECT * FROM student_info, st_address, st_parents_info, st_session, st_previous_academic_info, st_class, st_group, st_section, st_blood, st_religion WHERE st_code='$student_code' AND st_id=sta_st_id AND st_id=stpi_st_id AND st_id=ss_st_id AND st_id=stpai_st_id AND sc_id=ss_class_id AND sg_id=ss_group_id AND ssec_id=ss_section_id AND st_blood_id=stb_id AND st_religion_id=str_id LIMIT 1")){
                if(mysqli_num_rows($resultprint) > 0){
                    while($row = mysqli_fetch_array($resultprint)){
                        
             
            
            ?>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Form No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_code'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Date</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_form_date'];?></th>                        
                
                <td class="text-right" style="vertical-align:middle;">Mobile No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_mobile'];?></th>
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Personal Info</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Session</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['ss_year'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sc_name'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Group</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sg_group'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Section</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['ssec_section'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Roll</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Student Mobile</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $mobile=$row['st_mobile'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Date of birth</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $dob=$row['st_dob'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Birth Certificate no.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_dob_certificate'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Gender</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_sex'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Blood Group</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stb_name'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Religion</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['str_name'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Hobby</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_hobby'];?></th> 
                
                <td class="text-right" style="vertical-align:middle;">Number of Family Members</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_family_no'];?></th> 
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Address</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Village</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sta_vill'];?></th>  
                
                <td class="text-right" style="vertical-align:middle;">Post Office</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sta_post'];?></th> 
                
                <td class="text-right" style="vertical-align:middle;">Upazilla/Thana</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sta_upazilla'];?></th>
                
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">District</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sta_district'];?></th>
                <td class="text-right" style="vertical-align:middle;">Postal Code</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sta_postal_code'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Country</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['sta_country'];?></th>
                
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Parents Info</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Father's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_father_name'];?></th>  
                
                <td class="text-right" style="vertical-align:middle;">Qualification</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_father_quali'];?></th> 
                
                <td class="text-right" style="vertical-align:middle;">Occoupation</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_father_occu'];?></th>
                
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Yearly Income</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_father_yin'];?></th>  
                
                <td class="text-right" style="vertical-align:middle;">NID No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_father_nid'];?></th> 
                
                <td class="text-right" style="vertical-align:middle;">Mobile</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_father_mobile'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Mather's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_mather_name'];?></th>  
                
                <td class="text-right" style="vertical-align:middle;">Qualification</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_mather_quali'];?></th> 
                
                <td class="text-right" style="vertical-align:middle;">Occoupation</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_mather_occu'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Yearly Income</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_mather_yin'];?></th>  
                <td class="text-right" style="vertical-align:middle;">NID No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_mather_nid'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Mobile</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpi_st_mather_mobile'];?></th>
            </tr>
            <tr>
                <th class="text-left" colspan="9" style="vertical-align:middle;">Prev. Academic info</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">School Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpai_school_name'];?></th>
                <td class="text-right" style="vertical-align:middle;">Address</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpai_school_address'];?></th>
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $acclassname;?></th>  
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Roll No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpai_roll'];?></th>
            </tr>
        </table>
    </div>
    <?php    }
                }
            }
    ?>
    <div class="row">
        <hr>
        <p class="text-left"><strong>Note:</strong>The all information of above are tue. I agree to follow the School's roles and regulations</p>
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


