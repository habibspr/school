<!-- Live searching -->

<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;?>

<?php
$Session = 0; $Class_Id=0; $Student_Roll=0; $Group_Id=0;

if($_REQUEST["Roll"] ){
    $Session = $_REQUEST['Session'];
    $Class_Id = $_REQUEST['Class'];
    $Group_Id = $_REQUEST['Group'];
    $Student_Roll = $_REQUEST['Roll'];
}
$result = mysqli_query($link,  "SELECT * FROM student_info, st_session, st_class, st_group WHERE st_id=ss_st_id AND ss_class_id=sc_id AND ss_group_id=sg_id AND ss_year='$Session' AND ss_class_id='$Class_Id' AND ss_group_id ='$Group_Id' AND ss_roll='$Student_Roll' ");
?>
<div class="table-responsive" style="position: relative;" >
    <table class="table table-bordered table-striped table-hover table-condensed" >
        <tr style="background-color:#e6e6e6; color: auto; ">
            <td class="text-center" style="vertical-align:middle; width:30%; width: 15%;"># Roll no.</td>
            <td class="text-center" style="vertical-align:middle; width:30%;">Student name</td>
            <td class="text-center" style="vertical-align:middle; width:30%;">Class</td>
            <td class="text-center" style="vertical-align:middle; width:30%;">Group</td>
        </tr>
        <?php 
        while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <th class="text-center" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></th>
            <th class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></th>
            <th class="text-center" style="vertical-align:middle;"><?php echo $row['sc_name'];?></th>
            <th class="text-center" style="vertical-align:middle;"><?php echo $row['sg_group'];}?></th>
        </tr>
        </table>
    </div>
