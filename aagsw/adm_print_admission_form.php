<?php include "header.php" ;?>
<?php include 'nav-bar.php';?>
<div class="container">
    
    <?php 
    include "adm_database_status.php";
    if($General_Security_Status){?>
    <div class="alert alert-success fade in">
        <strong>Permission ! </strong> You are not permitted !
    </div> 
    <?php die(); }         
    if(empty($Others_User)){  
        include_once "../others_login.php";        
    die(); }
        
    if(isset($_POST['others_id'])){ // Fetching variables of the form which travels in URL 
        $formno = isset($_POST['others_id']) ? $_POST['others_id'] : '';
            if($resultformid = mysqli_query($link,  "SELECT * FROM adm_user_info WHERE aui_form_no ='$formno' ")){
                if(mysqli_num_rows($resultformid) > 0){
                    while($row = mysqli_fetch_array($resultformid)){
                        $formid=$row['aui_id'];
                        $payment=$row['aui_adf_payment'];
                        $Session=$row['aui_session'];
                    }
                }
            }
    }
    if($formid==''){?>
       <div class="alert alert-success fade in">
        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
        <strong>Notice!</strong> Invalied Form No.
    </div>
    <?php } ?>
    <div class="page-header">
        <h4 class="text-center">Admission form [ Admission test - <?php echo "$Session";?> ]</h4>
    </div>
    
    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <?php 
            if($resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_address_mst, adm_blood_mst, adm_class_mst, adm_religion_mst, adm_sex_mst WHERE aui_religion_id=arm_id AND acm_id=aui_class_id AND abm_id=aui_blood_id AND asxm_id=aui_gender_id AND aam_aui_id='$formid' AND aui_id ='$formid' ORDER BY aui_id ASC")){
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


