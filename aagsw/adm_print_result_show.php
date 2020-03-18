<?php include "header.php" ;?>
<?php include 'nav-bar.php';?>
 
<?php 

if(empty($Others_User)){  
        include_once "../others_login.php";      
        die(); }

    if(isset($_POST['others_id'])){ // Fetching variables of the form which travels in URL 
        
        $formno = isset($_POST['others_id']) ? $_POST['others_id'] : '';
        
        //Form id searching //
        if($resultformid = mysqli_query($link,  "SELECT aui_id, aui_session FROM adm_user_info WHERE aui_form_no ='$formno' ")){
            if(mysqli_num_rows($resultformid) > 0){
                while($row = mysqli_fetch_array($resultformid)){
                    $formid=$row['aui_id'];
                    $Session=$row['aui_session'];
                }
            }
        }
    }
$merit_status="";
$resultstatus = mysqli_query($link,  "SELECT * FROM adm_marks WHERE am_form_id ='$formid' ");
while($row = mysqli_fetch_array($resultstatus)){
    $merit_status=$row['am_status'];
}

switch ($merit_status) {
    case "0": $rStatus="NOT ASSIGNED"; break;
    case "1": $rStatus="ALLOWED"; break;
    case "2": $rStatus="WAITING"; break;
    case "3": $rStatus="NOT ALLOWED"; break;
}?>

<div class="container">
    
    <?php if($merit_status==""){ ?>
    <div class="alert alert-danger fade in">
        <strong>Notice ! </strong> <?php echo "$Session";?> Result Not Published !
    </div>
    <?php die(); }
    ?>
    
    <div class="page-header">
        <h2 class="text-center">Admission Text Result- <?php echo "$Session";?></h2>
    </div>
    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <?php 
        $resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_marks WHERE aui_id ='$formid' AND aui_id=am_form_id ");
            while($row = mysqli_fetch_array($resultprint)){
                $adclass=$row['aui_class_id'];
                
                // Class choice
                switch ($adclass) {
                    case "1":
                        $Class="SIX";
                        break;
                    case "2":
                        $Class="SEVEN";
                        break;
                    case "3":
                        $Class="EIGHT";
                        break;
                    case "4":
                        $Class="NINE";
                        break;
                    case "5":
                        $Class="TEN";
                        break;
                }
                
            ?>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Form No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_form_no'];?></th>
                
                <td class="text-right" style="vertical-align:middle;">Session</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_session'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_name'];?></th>
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo "$Class";?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Father's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_name'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Mather's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_name'];?></th> 
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Position</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><congratulations><?php echo $row['am_position'];?></congratulations></th>
                <td class="text-right" style="vertical-align:middle;">Result</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><sorry><?php echo "$rStatus";}?></sorry></th>
            </tr>
        </table>
    </div>
</div><!-- container -->


