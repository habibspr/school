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
    <h2 align="center">Student List : <small>Acive / Inactive</small></h2>
    
    <?php
    $classname=0; $groupname=0; 
    //Class Searching  //////////////////////////////////////////////////
    $resultclass = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group WHERE student_info.st_id=st_session.ss_st_id AND st_session.ss_class_id=st_class.sc_id AND st_class.sc_id='$class' AND st_session.ss_group_id=st_group.sg_id AND st_group.sg_id='$group' AND ss_year='$session'");
    while ($row = mysqli_fetch_array($resultclass)){
        $classname= $row['sc_name'];
        $groupname= $row['sg_group'];
    }
    
    // Active Student Count
    $studentcountActive = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND ss_class_id=$class AND ss_year=$session AND ss_group_id='$group' AND st_status=0");
    $Activestudent = mysqli_num_rows($studentcountActive);
    
    // InActive Student Count
    $studentcountInaActive = mysqli_query($link, "SELECT * FROM student_info, st_session WHERE st_id=ss_st_id AND ss_class_id=$class AND ss_year=$session AND ss_group_id='$group' AND st_status=1");
    $InaActivestudent = mysqli_num_rows($studentcountInaActive);
    
    ?>
    
    
    <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                    General Info: 
                </div>
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                                <th class="text-center" style="vertical-align:middle;">Session</th>
                                <th class="text-center" style="vertical-align:middle;">Class</th>
                                <th class="text-center" style="vertical-align:middle;">Group</th>
                                <th class="text-center" style="vertical-align:middle;">Active</th>
                                <th class="text-center" style="vertical-align:middle;">Inactive</th>
                            </tr>
                            
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $session; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $classname;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $groupname;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $Activestudent;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $InaActivestudent;?></td>
                            </tr>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                </div>
            </div>
        </div>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
                <?php echo "".date('l -  d M, Y'). " ";?>
                <span class="badge">
                <?php
                    // class result from class searching
                    echo $rows = mysqli_num_rows($resultclass);                    
                ?>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center" style="vertical-align:middle;">No.</th>
                            <th class="text-center" style="vertical-align:middle;">Code/RFID</th>
                            <th class="text-center" style="vertical-align:middle;">Student Name/DOB</th>
                            <th class="text-center" style="vertical-align:middle;">Blood Group</th>
                            <th class="text-center" style="vertical-align:middle;">Group/Roll</th>
                            <th class="text-center" style="vertical-align:middle;">Religion</th>
                            <th class="text-center" style="vertical-align:middle;">Father/Mother</th>
                            <th class="text-center" style="vertical-align:middle;">Prev. School</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile No</th>
                            <th class="text-center" style="vertical-align:middle;">Status</th>
                            <th class="text-center" style="vertical-align:middle;">Photo</th>
                        </tr>
                        <?php  
                        $i=1;
                        if($resultst = mysqli_query($link, "SELECT * FROM student_info,
						st_session,
						st_class,
						st_group,
						st_parents_info,
						st_religion,
						st_blood,
						st_previous_academic_info  
						WHERE st_id = ss_st_id 
						AND ss_class_id = '$class' 
						AND sc_id = ss_class_id 
						AND ss_year = '$session' 
						AND ss_class_id = sc_id 
						AND stpi_st_id = st_id 
						AND ss_group_id = '$group' 
						AND sg_id = ss_group_id 
						AND st_religion_id = str_id 
						AND st_blood_id = stb_id 
						AND st_id = stpai_st_id 
						ORDER BY ss_roll, st_id ASC ")){
                            if(mysqli_num_rows($resultst) > 0){
                                while($row = mysqli_fetch_array($resultst)){?>
                        <tbody>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['st_code']); ?><br><?php echo ($row['st_rfid']); ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['st_name']);?><br><?php echo ($row['st_dob']);?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['stb_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['sg_group']); ?><br><?php echo ($row['ss_roll']); ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['str_name']); ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['stpi_st_father_name']);?><br><?php echo ($row['stpi_st_mather_name']);?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo ($row['stpai_school_name']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo ($row['st_mobile']);?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php if($row['st_status']==0){
                                    echo "Active";
                                }else
                                    echo "Inactive";
                                                                         ?></td>
																		 <?php 
																		 //checking extention of image

                                         $test_img_name = "../images/students/".$row['st_id'];

                                         if(file_exists($test_img_name.".jpg")){
                                            $img_name= $test_img_name.".jpg";
                                         }
                                         elseif(file_exists($test_img_name.".jpeg")){
                                            $img_name= $test_img_name.".jpeg";
                                         }
                                         elseif(file_exists($test_img_name.".JPG")){
                                            $img_name= $test_img_name.".JPG";
                                         }
                                         elseif(file_exists($test_img_name.".JPEG")){
                                            $img_name= $test_img_name.".JPEG";
                                         }
                                         elseif(file_exists($test_img_name.".PNG")){
                                            $img_name= $test_img_name.".PNG";
                                         } else{
                                            $img_name= $test_img_name.".png";
                                         }
																		 ?>
                                <td class="text-center" style="vertical-align:middle;"><img src="<?php echo $img_name;?>" class="img-thumbnail" alt="No Photo" width="auto" height="150px"></td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>