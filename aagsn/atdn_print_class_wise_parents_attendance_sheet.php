<?php include "header.php";?>
<?php include '../nav-bar.php';?>
<?php
session_start();
$session = $_GET["session"];
$class  = $_GET["class"];
$group  = $_GET["group"];
?>
<div class="container">
    <form class="form-horizontal" action="" role="form" method="post">        
        <div class="row">  
            <input class="form-control" type="hidden" id="session" name="session" value="<?php echo $session ;?>" disabled>
            <input class="form-control" type="hidden" id="class" name="class" value="<?php echo $class ;?>" disabled>
            <input class="form-control" type="hidden" id="group" name="group" value="<?php echo $group ;?>" disabled>
        </div>
    </form>
    
    <h3 align="center">Parents Attendance Sheet : <small><?php echo date('d-M-Y');?></small> </h3>
    
    <?php
    $classname=0; $groupname=0; $sectionname=0;
    //Class Searching  //////////////////////////////////////////////////
    $resultclass = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id='$class' AND st_class.sc_id='$class' AND st_session.ss_group_id='$group' AND st_group.sg_id='$group' AND ss_year='$session'");
    while ($row = mysqli_fetch_array($resultclass)){
        $classname= $row['sc_name'];
        $groupname= $row['sg_group'];
    } ?>

    <div class="table-responsive small">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th class="text-center" style="vertical-align:middle;">Session</th>
                <th class="text-center" style="vertical-align:middle;">Class</th>
                <th class="text-center" style="vertical-align:middle;">Group</th>
            </tr>
            <tr>
                <td class="text-center" style="vertical-align:middle;"><?php echo $session; ?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $classname;?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $groupname;?></td>
            </tr>
        </table><!-- End Table Summary-->
    </div>
    <div class="table-responsive small">
        <table class="table table-bordered">
            <tr>
                <th class="text-center" style="vertical-align:middle;">Roll</th>
                <th class="text-center" style="vertical-align:middle;">Student Name</th>                            
                <th class="text-center" style="vertical-align:middle;">Father/Mother</th>
                <th class="text-center" style="vertical-align:middle;">Signature</th>
            </tr>
            <?php  
            if($resultst = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group, st_parents_info, st_religion WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id='$class' AND st_class.sc_id='$class' AND st_session.ss_year='$session' AND st_session.ss_class_id=st_class.sc_id AND stpi_st_id=st_id AND st_session.ss_group_id='$group' AND st_group.sg_id='$group' AND st_religion_id=str_id ORDER BY st_session.ss_roll ASC ")){
                if(mysqli_num_rows($resultst) > 0){
                    while($row = mysqli_fetch_array($resultst)){?>
                <tr>
                    <td class="text-center" style="vertical-align:middle;"><?php echo ($row['ss_roll']); ?></td>
                    <td class="text-left" style="vertical-align:middle;"><?php echo ($row['st_name']);?></td>
                    <td class="text-left" style="vertical-align:middle;"><?php echo ($row['stpi_st_father_name']);?><br><?php echo ($row['stpi_st_mather_name']);?></td>
                    <td class="text-center" style="vertical-align:middle;"></td>
                    <?php }
                    // Close result set
                    mysqli_free_result($result);
                }else{?>
                    <div class="alert alert-info fade in">
                        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                        <strong>Notice!</strong> Not Found.
                    </div>
                    <?php }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);    
                // Close connection
                mysqli_close($link);
            }
                    ?>
                </tr>
        </table>
    </div>
    </div>
<?php include 'footer.php';?>