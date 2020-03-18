<?php include "header.php";?>
<?php include 'nav-bar.php';?>
<?php 
if(date('m')>6){ 
    
    $Security_Session= date('Y')+1; 
    
}else{ 
    
    $Security_Session= date('Y'); 
    
}
?>

<div class="container-fluid">
    <?php     
    if(isset($_POST['form_no'])){ // Fetching variables of the form which travels in URL 
        $formid = isset($_POST['form_no']) ? $_POST['form_no'] : '';
        
        if($resultformid = mysqli_query($link,  "SELECT aui_adf_payment, aui_session  FROM adm_user_info WHERE aui_id ='$formid' ")){
            if(mysqli_num_rows($resultformid) > 0){
                while($rowformid = mysqli_fetch_array($resultformid)){
                    $payment=$rowformid['aui_adf_payment'];
                    $Session=$rowformid['aui_session'];
                }
            }
        }
    }
    
    $dayNdate="January 03, $Session"; ////// date and day calculation
    
    if($payment < 200){?>
    <div class="alert alert-success fade in">
        <strong>Notice!</strong> Please Pay at first!
    </div>
    <?php exit;} ?>    
    <div class="page-header"><h4 class="text-center"><strong>ADMIT CARD</strong>  [ Admission test - <?php echo "$Security_Session";?> ]</h4></div>
    <div class="table-responsive small">
        
        <table class="table table-bordered table-striped table-hover">
            <?php 
            $resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_blood_mst, adm_class_mst, adm_religion_mst WHERE aui_religion_id=arm_id AND acm_id=aui_class_id AND abm_id=aui_blood_id AND aui_session='$Session' AND aui_id ='$formid'");
                    while($row = mysqli_fetch_array($resultprint)){?>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Form No.</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_form_no'];?></th>
                <td class="text-right" style="vertical-align:middle;">Exam Date-time</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo "$dayNdate [ " .date('l', strtotime($dayNdate));?>  09.00 AM ]</th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_name'];?></th>
                <td class="text-right" style="vertical-align:middle;">Date of birth</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $dob=$row['aui_dob'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Session</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_session'];?></th>
                <td class="text-right" style="vertical-align:middle;">Class</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['acm_name'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Father's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_name'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Mother's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_name'];}?></th> 
            </tr>
        </table>
    </div>
    <hr>
   
    <p class="text-left">Controller :</p>
   
    <div class="col-sm-11 text-left">
    <button id="buttonGoBack" class="btn btn-success btn-lg" onclick="goBack()"><span class="glyphicon glyphicon-repeat"></span>  Back</button>
    </div>
    <div class="col-sm-1">
    <button id="printPageButton" class="btn btn-success btn-lg" onclick="printThispage()" ><span class="glyphicon glyphicon-print"></span>  Print</button>
    </div>
    <script type="text/javascript">        
        function printThispage() {
            //Get the print button and put it into a variable
            var printButton = document.getElementById("printPageButton");
            var gobackButton = document.getElementById("buttonGoBack");
            //Set the print button visibility to 'hidden' 
            printButton.style.visibility = 'hidden';
            //Set the goback button visibility to 'hidden' 
            gobackButton.style.visibility = 'hidden';
            //Print the page content
            window.print()
            //Set the print button to 'visible' again 
            //[Delete this line if you want it to stay hidden after printing]
            printButton.style.visibility = 'visible';
            //Set the goback button to 'visible' again 
            //[Delete this line if you want it to stay hidden after printing]
            gobackButton.style.visibility = 'visible';
            
        }        
        
        // go back 
        function goBack() {
            window.history.back();
        }        
    </script>
</div><!-- container -->


