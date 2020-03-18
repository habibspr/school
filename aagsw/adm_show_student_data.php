<!-- database connection -->
<?php include "../resources/db_aags_w.php" ;?>
<?php

if($_REQUEST["form_no"] ){
    
    $form_no = $_REQUEST['form_no'];
}

// searching Marks Table 
$studentdata=0;
$querystudent = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_id='$form_no'");
while ($row = mysqli_fetch_array($querystudent)){
    $studentdata=$row['aui_id'];
}
if($studentdata==0){ ?>
    <div class="alert alert-success fade in">
        <a href="" class="close" data-dismiss="alert">&times;</a>
        <strong>Notice!</strong> Data not found!
    </div>
<?php exit;} ?> 


<?php
    // searching Marks Table 
$marksDetails=0;
$querystudent = mysqli_query($link, "SELECT * FROM adm_marks WHERE am_form_id='$form_no'");
while ($row = mysqli_fetch_array($querystudent)){
    $marksDetails=$row['am_form_id'];
}



if($marksDetails==0){
    
    $querystudent = mysqli_query($link, "SELECT * FROM adm_user_info, adm_class_mst WHERE acm_id=aui_class_id AND aui_id='$form_no'");
    
    while ($row = mysqli_fetch_array($querystudent)){
?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">   
        <tr>
            <th class="text-center" style="vertical-align:middle;" colspan="3">DETAILS</th>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Form No.</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><congratulations><b><?php echo $row['aui_form_no'];?></b></congratulations></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Name</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_name'];?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Session</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_session'];?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Class</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['acm_name'];}?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Mark</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><sorry><strong>Null</strong></sorry></td>
        </tr>
    </table>
    <?php 
}else{
    
    if($form_no !=''){
        
        $querystudent = mysqli_query($link, "SELECT * FROM adm_user_info, adm_marks, adm_class_mst WHERE aui_id=am_form_id AND acm_id=aui_class_id AND aui_id='$form_no'");
        
        while ($row = mysqli_fetch_array($querystudent)){ ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">   
        <tr>
            <th class="text-center" style="vertical-align:middle;" colspan="3">DETAILS</th>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Form No.</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><congratulations><b><?php echo $row['aui_form_no'];?></b></congratulations></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Name</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_name'];?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Session</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_session'];?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Class</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['acm_name'];?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Mark</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><sorry><strong><?php echo $row['am_mark'];}?></strong></sorry></td>
        </tr>
    </table>
</div>
<?php   }  }

?>
