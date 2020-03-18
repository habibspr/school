<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;?>

<?php
if($_REQUEST["Studentid"] ){
    
    $Studentid = $_REQUEST['Studentid'];
    
    $Session = $_REQUEST['Session'];
    
    $student_rfid = $_REQUEST['student_rfid'];
    
}

if(empty($Studentid)){?>
<div class="col-sm-6"></div>
<div class="col-sm-6">
<div class="alert alert-danger fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> Please Enter Student Id........
                </div>
</div>
<?php die(); }

// ID info update
$result=mysqli_query($link, "SELECT * FROM student_info WHERE st_id=$Studentid");

if(mysqli_num_rows($result)>0){
    mysqli_query($link, "UPDATE student_info SET st_rfid='$student_rfid', st_status = '0' WHERE st_id=$Studentid ");
}

$querystudent = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group WHERE  student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=st_class.sc_id AND student_info.st_id='$Studentid' AND ss_year='$Session' AND ss_group_id=sg_id");

while ($row = mysqli_fetch_array($querystudent)){
    
?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <button class="btn btn-lg btn-block btn-danger" > Details </button>
        <tr>
            <td rowspan="8" class="text-center">
                <img src="../images/students/<?php echo $row['st_code']; ?>.jpg" class="img-thumbnail" alt="No Photo" width="100" height="100">   
            </td>                        
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Student Code </th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['st_code']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Name </th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['st_name']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Class</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['sc_name']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Roll</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['ss_roll']; ?></td>
        </tr>
        <tr>                         
            <th class="text-right" style="vertical-align:middle;">Group</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['sg_group']; ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Status</th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><congratulations><?php $stStatus=$row['st_status']; if ($stStatus==0){echo "Active";}else{echo "Inactive";} ?></congratulations></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Card Info </th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><sorry><?php echo $row['st_rfid']; }?></sorry></td>
        </tr>
    </table>
</div>