<?php include "header.php" ;?>
<?php include '../nav-bar.php';?>
<div class="container">
   <?php
        if(isset($_POST['mobile'])){ // Fetching variables of the form which travels in URL 
            $Mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
            $Dob = isset($_POST['dob']) ? $_POST['dob'] : '';
            $Formdate = isset($_POST['formdate']) ? $_POST['formdate'] : '';
            $Session = isset($_POST['session']) ? $_POST['session'] : '';
            $Class = isset($_POST['class']) ? $_POST['class'] : '';
            $st_group = isset($_POST['st_group']) ? $_POST['st_group'] : '';
            $st_section = isset($_POST['st_section']) ? $_POST['st_section'] : '';
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
                    $resultmax = mysqli_query($link, "SELECT * FROM student_info ORDER BY st_id DESC LIMIT 1");
                    $row = mysqli_fetch_array($resultmax);                    
                    $formno= $row['st_code'];
                    
                    if(empty($formno)){$formno= substr('0000000000' .+1, -10);}else{$formno++; $formno=substr('0000000000'.$formno, -10);}//for the first entry
                    
                    if(!empty($Mobile)){ 
                        
                        $result=mysqli_query($link,"SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                        if(mysqli_num_rows($result)>0){
                            mysqli_query($link, "UPDATE student_info SET st_name=upper('$Name'), st_sex=upper('$Gender'), st_religion_id='$Religion', st_blood_id='$Blood', st_hobby=upper('$Hobby'), st_family_no='$Familyno', st_status='0' WHERE st_mobile ='$Mobile' AND st_dob ='$Dob' ");
                                          
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                            
                            mysqli_query($link, "UPDATE st_address SET sta_vill=upper('$Vill'), sta_post=upper('$PO'), sta_postal_code='$Postcode', sta_upazilla=upper('$Upazilla'), sta_district=upper('$District'),  sta_country=upper('$Country') WHERE sta_st_id='$formid' ");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                            
                            mysqli_query($link, "UPDATE st_parents_info SET stpi_st_father_name=upper('$Fname'), stpi_st_father_mobile='$Fmob', stpi_st_father_nid='$Fnid', stpi_st_father_occu=upper('$Foccu'), stpi_st_father_quali=upper('$Fquali'), stpi_st_father_yin=$Fyin, stpi_st_mather_name=upper('$Mname'), stpi_st_mather_mobile='$Mmob', stpi_st_mather_nid='$Mnid', stpi_st_mather_occu=upper('$Moccu'), stpi_st_mather_quali=upper('$Mquali'), stpi_st_mather_yin='$Myin' WHERE stpi_st_id='$formid' ");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                            
                            mysqli_query($link, "UPDATE st_session SET ss_class_id='$Class', ss_group_id='$st_group', ss_section_id='$st_section', ss_year='$Session' WHERE ss_st_id='$formid' ");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                            
                            mysqli_query($link, "UPDATE st_previous_academic_info SET stpai_st_id='$formid', stpai_school_name=upper('$Fname') ");
                        
                        }else{                                 
                            mysqli_query($link, "INSERT INTO student_info (st_code, st_form_date, st_name, st_mobile, st_dob, st_sex, st_religion_id, st_blood_id, st_hobby, st_family_no, st_status) VALUES ('$formno', '$Formdate', upper('$Name'), '$Mobile', '$Dob', '$Gender', '$Religion', '$Blood', upper('$Hobby'), '$Familyno', '0')");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                                    
                            mysqli_query($link, "INSERT INTO st_address (sta_st_id, sta_vill, sta_post, sta_postal_code, sta_upazilla, sta_district, sta_country) VALUES ('$formid', upper('$Vill'), upper('$PO'), '$Postcode', upper('$Upazilla'), upper('$District'), upper('$Country')  )");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                                    
                            mysqli_query($link, "INSERT INTO st_parents_info (stpi_st_id, stpi_st_father_name, stpi_st_father_mobile, stpi_st_father_nid, stpi_st_father_occu, stpi_st_father_quali, stpi_st_father_yin, stpi_st_mather_name, stpi_st_mather_mobile, stpi_st_mather_nid, stpi_st_mather_occu, stpi_st_mather_quali, stpi_st_mather_yin ) VALUES ('$formid', upper('$Fname'), '$Fmob', '$Fnid', '$Foccu', '$Fquali', '$Fyin', upper('$Mname'), '$Mmob', '$Mnid', '$Moccu', '$Mquali', '$Myin')");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                                    
                            mysqli_query($link, "INSERT INTO st_session (ss_st_id, ss_class_id, ss_group_id, ss_section_id, ss_year ) VALUES ('$formid', '$Class','$st_group','$st_section','$Session')");
                            
                            // formid //
                            $formid=0;
                            $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
                            while($row = mysqli_fetch_array($resultformid)){
                                $formid=$row['st_id'];
                            }
                                    
                            mysqli_query($link, "INSERT INTO st_previous_academic_info (stpai_st_id, stpai_school_name ) VALUES ('$formid', upper('$Fname') )");
                            
                        }
                    }
                }
            }
        }
        
    // formid //
    $formid=0;
    $resultformid = mysqli_query($link, "SELECT * FROM student_info WHERE st_mobile ='$Mobile' AND st_dob ='$Dob'");
    while($row = mysqli_fetch_array($resultformid)){
        $formid=$row['st_id'];
    
    ?>              
    <h4 class="text-center"><strong>ADMISSION FORM</strong></h4>
    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <?php 
            if($resultprint = mysqli_query($link,  "SELECT * FROM student_info, st_session, st_class, st_group, st_section, st_address, st_parents_info, st_previous_academic_info, st_religion, st_blood WHERE st_id=ss_st_id AND ss_class_id=sc_id AND ss_group_id=sg_id AND ssec_id=ss_section_id AND st_id=sta_st_id AND st_id=stpi_st_id AND st_id=stpai_st_id AND stb_id=st_blood_id AND st_religion_id=str_id AND ss_year='$Session' AND st_id='$formid' LIMIT 1")){
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
                <td class="text-right" style="vertical-align:middle;">Date of birth</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $Dob=$row['st_dob'];?></th>
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
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['stpai_school_name']; }?></th>
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


