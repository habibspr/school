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
    if(isset($_POST['famount'])){ // Fetching variables of the form which travels in URL 
        
        $form_no = isset($_POST['form_no']) ? $_POST['form_no'] : '';
        $famount = isset($_POST['famount']) ? $_POST['famount'] : '';
    }
        if (!empty($form_no)){
            $result=mysqli_query($link,"SELECT * FROM adm_user_info WHERE aui_id='$form_no'");
            
            if(mysqli_num_rows($result)>0){
                mysqli_query($link, "UPDATE adm_user_info SET aui_adf_payment='$famount' WHERE aui_id='$form_no'");
            }
        
        }?>
    
    <div class="page-header"><h4 class="text-center"><strong>PAYMENT SLIP</strong> [ Admission test - <?php echo "$Security_Session";?> ]</h4></div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <?php 
            $resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_class_mst WHERE aui_class_id=acm_id AND aui_id ='$form_no'");
                    while($row = mysqli_fetch_array($resultprint)){?>
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
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['acm_name'];?></th>
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Father's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_father_name'];?></th> 
                <td class="text-right" style="vertical-align:middle;">Mother's Name</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mather_name'];?></th> 
            </tr>
            <tr>
                <td class="text-right" style="vertical-align:middle;">Taka in word</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;">Two Hundred Only</th>
                <td class="text-right" style="vertical-align:middle;">Amount</td>
                <td class="text-center" style="vertical-align:middle;">:</td>
                <th class="text-left" style="vertical-align:middle;">Tk. <sorry><?php echo $row['aui_adf_payment'];}?>/-</sorry></th>
            </tr>
        </table>
    </div>
    <p class="text-left">Received By: </p>    
    
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
    


