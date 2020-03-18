<?php include "header.php";?>
<?php include '../nav-bar.php';?>
<div class="container">
    <?php
    // Attempt select query execution
    $result = mysqli_query($link, "SELECT * FROM teacher_info, st_blood WHERE stb_id=t_bgroup ORDER BY t_id ASC");
    ?>
    <h2 align="center">Teachers <small> & Status</small></h2>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
                <?php echo "".date('l -  d M, Y'). "";?>
                <span class="badge">
                <?php
                // Rows Count
                $rows = mysqli_num_rows($result);
                echo "" . $rows ."";
                ?>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped table-hover">
                        <tr>
                            <th class="text-center" style="vertical-align:middle;">Code/Rfid</th>
                            <th class="text-center" style="vertical-align:middle;">Name</th>
                            <th class="text-center" style="vertical-align:middle;">Sex</th>
                            <th class="text-center" style="vertical-align:middle;">Designation</th>
                            <th class="text-center" style="vertical-align:middle;">J.Date</th>
                            <th class="text-center" style="vertical-align:middle;">Subject</th>
                            <th class="text-center" style="vertical-align:middle;">B.Group</th>
                            <th class="text-center" style="vertical-align:middle;">Mobile No.</th>
                            <th class="text-center" style="vertical-align:middle;">Status</th>
                            <th class="text-center" style="vertical-align:middle;">Class Teacher</th>
                            <th class="text-center" style="vertical-align:middle;">Photo</th>
                        </tr>
                        <?php  
                        $i=1;
                        while($row = mysqli_fetch_array($result)){?>
                        <tbody>
                            <tr>
                                
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_code']."<br>".$row['t_rfid'];?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $row['t_name'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php $Teacher_Sex=$row['t_sex']; if ($Teacher_Sex==1) {echo "Female";} else {echo "Male"; }?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_des'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_joindate'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_subject'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['stb_name'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['t_phone'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php if($row['t_status']==0){echo "Active";}else{echo "Inactive";}?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php 
                                $t_class_id=$row['t_class_id'];
                                $result_class=mysqli_query($link, "SELECT sc_name FROM st_class WHERE sc_id='$t_class_id'"); 
                                while($row_class = mysqli_fetch_array($result_class)){
                                echo $row_class['sc_name'];
                                }
                                ?></td>
                                <td class="text-center" style="vertical-align:middle;">
                                    <?php 
																		 //checking extention of image

                                         $test_img_name = "../images/teachers/".$row['t_id'];

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
                                            $img_name = $test_img_name.".png";
                                         }?>
                                         
                                         <img src="<?php if(file_exists($img_name)){ echo $img_name; }else{echo "No Photo"; }?>" class="img-thumbnail" alt="No Photo" width="50" height="50"></td>
                                         
                                         <?php 
                                         }
                                         // Close result set
                                         mysqli_free_result($result);
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