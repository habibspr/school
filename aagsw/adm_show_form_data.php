<!-- database connection -->
<?php include "../resources/db_aags_w.php" ;?>
<?php 
if($_REQUEST["form_no"] ){
    $form_no = $_REQUEST['form_no'];
    $Session = date('Y');
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
    if($form_no !=0){
        $querystudent = mysqli_query($link, "SELECT * FROM adm_user_info, adm_class_mst WHERE aui_id=$form_no AND aui_class_id=acm_id ");
        while ($row = mysqli_fetch_array($querystudent)){ ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <tr>
            <th class="text-center" style="vertical-align:middle;" colspan="3">D E T A I L S</th>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Form No. </th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_form_no']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Date </th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_date']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Name </th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_name']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Class</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['acm_name']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Date of Birth</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_dob']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Mobile</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_mobile']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Payment</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;">Tk. <?php echo $row['aui_adf_payment']."/-"; ?></td>
        </tr>
    </table>
</div>
<?php  }   
    }
?>
