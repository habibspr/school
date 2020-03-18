<?php include "header.php" ;?>
<?php include 'nav-bar.php';?>

<?php 
    if(isset($_POST['adclass'])){ // Fetching variables of the form which travels in URL 
        $session = isset($_POST['session']) ? $_POST['session'] : '';
        $adclass = isset($_POST['adclass']) ? $_POST['adclass'] : '';
        $merit_status = isset($_POST['marit_waiting']) ? $_POST['marit_waiting'] : '';
    }
    
    //// Merit Status 
    switch ($merit_status) {
        case "0": $rStatus="NOT ASSIGNED"; break;
        case "1": $rStatus="ALLOWED"; break;
        case "2": $rStatus="WAITING"; break;
        case "3": $rStatus="NOT ALLOWED"; break;
    }
    
    // class name searching
	$resultClassName = mysqli_query($link,  "SELECT * FROM adm_class_mst WHERE acm_id='$adclass' ");
                        while($row = mysqli_fetch_array($resultClassName)){
                            $ClassName = $row['acm_name'];
                        }
	
    ?>

<div class="container">
    <?php if($merit_status==""){ ?>
    <div class="alert alert-danger fade in">
        <strong>Notice ! </strong> <?php echo "$session, $merit_status ";?> Result Not Published !
    </div>
    <?php die(); }?>
    
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead>
                <tr> 
                    <th class="text-center" style="vertical-align:middle;" colspan="6">
                        <h3>Admission test Result- <?php echo "$session";?> <strong>[ <?php echo $rStatus ; ?> ]</strong></h3> 
                        <h6> <?php echo "Printed at : " .date(' F d, Y'). " - " .date('l')." " .date('H:s:m A');?></h6>
                    </th>
                </tr>
                <tr>
                    <th class="text-right" style="vertical-align:middle;">Session </th>
                    <th class="text-center" style="vertical-align:middle;">: </th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "$session";?> </td>
                     <th class="text-right" style="vertical-align:middle;">Class </th>
                    <th class="text-center" style="vertical-align:middle;">: </th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "$ClassName"; ?> </td>
                </tr>
            
                <tr>
                    <th class="text-center" style="vertical-align:middle;">SL No.</th>
                    <th class="text-center" style="vertical-align:middle;">Form No.</th>
                    <th class="text-center" style="vertical-align:middle;">Name</th>
                    <th class="text-center" style="vertical-align:middle;">Marks</th>
                    <th class="text-center" style="vertical-align:middle;">Merit Position</th>
                    <th class="text-center" style="vertical-align:middle;">Status</th>
                </tr>
        </thead>
        <?php 
        $i=1; 
        $formid=0;
        $resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_marks WHERE aui_id=am_form_id AND aui_class_id='$adclass' AND aui_session='$session' AND am_status='$merit_status' ORDER BY am_position, aui_form_no ASC ");
        while($row = mysqli_fetch_array($resultprint)){
                    $formid=$row['aui_id'];
            ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $i++;?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $row['aui_form_no'];?></td>
                <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_name'];?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $row['am_mark'];?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $row['am_position'];?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $rStatus;}?></td>
            </tr>            
            <tfoot><th  class="text-center page-number" style="vertical-align:middle;" colspan="6"></th></tfoot>   
        </table>
    </div>
     <p class="text-left"><br> Head Master: </p>
</div><!--end Container -->