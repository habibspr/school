<?php include "header.php";?>
<?php include "nav-bar.php" ;?>

<div class="container-fluid">
<?php 
    $payment=200;
    if(isset($_POST['adclass'])){ // Fetching variables of the form which travels in URL 
        
        $session = isset($_POST['session']) ? $_POST['session'] : '';
        $adclass = isset($_POST['adclass']) ? $_POST['adclass'] : '';
    }
        
    // class name searching
	$resultClassName = mysqli_query($link,  "SELECT * FROM adm_class_mst WHERE acm_id='$adclass' ");
                        while($row = mysqli_fetch_array($resultClassName)){
                            $ClassName = $row['acm_name'];
                        }
	
    
    ?>
        
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover ">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align:middle;" colspan="8">
                        <h3 class="text-center">Admission Test-<?php echo "$session";?> -<strong> Attendance Sheet</strong></h3>
                         <?php
                        $flag=0;
                        $resultpaid = mysqli_query($link,  "SELECT * FROM adm_user_info WHERE aui_class_id='$adclass' AND aui_session='$session' AND aui_adf_payment>0");
                        while($row = mysqli_fetch_array($resultpaid)){
                            $flag=1;
                        }
                        if($flag==0){?>
                        <div class="alert alert-danger fade in text-left">
                            <strong>Notice ! </strong><?php echo "$ClassName"; ?>  Data not found !
                        </div>
                        <?php die(); }  ?>
                    </th>
                </tr>
                <tr>
                    <th class="text-right" style="vertical-align:middle;">Session </th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "$session";?> </td>
                    <th class="text-right" style="vertical-align:middle;">Class </th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "$ClassName";?> </td>
                
                    <th class="text-right" style="vertical-align:middle;">Date</th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "03 - 01 - $session";?> </td>
                    <th class="text-right" style="vertical-align:middle;">Time </th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "09:00 AM";?> </td>
                </tr>
                <tr>
                    <th class="text-center" style="vertical-align:middle;">SL No.</th>
                    <th class="text-center" style="vertical-align:middle;">Form No.</th>
                    <th class="text-center" style="vertical-align:middle;">Name</th>
                    <th class="text-center" style="vertical-align:middle;">Date of Birth</th>
                    <th class="text-center" style="vertical-align:middle;" colspan="3">Student Signature</th>
                    <th class="text-center" style="vertical-align:middle;">Remarks</th>
                </tr>
            </thead>
            <?php 
        $i=1; 
        
        $resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info WHERE aui_class_id='$adclass' AND aui_session='$session' AND aui_adf_payment='$payment'");
        while($row = mysqli_fetch_array($resultprint)){?>
            <tr  style="height : 5em;">
                <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_form_no'];?></td>
                <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_name'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_dob'];?></td>
                <td class="text-center" style="vertical-align:middle;" colspan="3"></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo "";}?></td>
            </tr>
            <tfoot><th  class="text-center page-number" style="vertical-align:middle;" colspan="8"></th></tfoot>  
        </table>
    </div>
    <p class="text-left"><br> Head Master: </p>
</div>
    
