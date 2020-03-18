<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;?>
<?php 

if($_REQUEST["Studentid"] ){
    
    $Studentid = $_REQUEST['Studentid'];
    
    $Session = $_REQUEST['Session'];
    
}

if(empty($Studentid)){die(); }

$querystudent = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group WHERE  st_id=ss_st_id AND ss_class_id=sc_id AND st_id='$Studentid' AND ss_year='$Session' AND ss_group_id=sg_id ");

        while ($row = mysqli_fetch_array($querystudent)){ 
             ?>


<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <button class="btn btn-lg btn-block btn-primary" > Details </button>
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
            <td class="text-left" style="vertical-align:middle;"><?php $stStatus=$row['st_status']; if ($stStatus==0){echo "Active";}else{echo "Inactive";} ?></td>
        </tr>
        <tr>
            <th class="text-right" style="vertical-align:middle;">Card Info </th>
            <th class="text-center" style="vertical-align:middle;">:</th>
            <td class="text-left" style="vertical-align:middle;"><?php echo $row['st_rfid'];} ?></td>
        </tr>
    </table>
</div>

