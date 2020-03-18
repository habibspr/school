<?php include "header.php" ;?>
<?php include '../nav-bar.php';?>
<div class="container">
    <div class="row">
        <?php
        if(isset($_POST['mobile'])){ // Fetching variables of the form which travels in URL 
            $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
            $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
            $formdate = isset($_POST['formdate']) ? $_POST['formdate'] : '';
            
            if(empty($mobile) || empty($dob)){?>
        <p class="text-center"><strong>Notice!</strong> Please fill up ....Blank Fields.</p> 
        <?php
            }else if(!is_numeric($mobile)){
        ?>
        <p class="text-center"><strong>Mobile No.</strong> Please Enter like 0123456789.</p> 
        <?php
            }else if(strlen($mobile) != 11){?>
        <p class="text-center"><strong>Mobile No.</strong> Please Enter 11 Number.</p>
        <?php
            }else{
                
                if($dob>=date('Y-m-d')){?>
        <p class="text-center"><strong>Notice!</strong> Invalied Date of birth.</p>
        <?php 
                }else{
                    
                    // Form No
                    $resultmax = mysqli_query($link, "SELECT * FROM student_info ORDER BY st_id DESC LIMIT 1");
                    $row = mysqli_fetch_array($resultmax);                    
                    $studentcode=$row['st_code'];
                    
                    
                   
                    if(empty($studentcode)){
                        $studentcode='0000000000';
                                           }else{
                        $studentcode=$row['st_code']+1;
                        $studentcode=str_pad($studentcode,10,"0",STR_PAD_LEFT); // code for number length
                    }
                    //for the first entry
                    
                    
                    if(!empty($mobile)){
                        $result=mysqli_query($link,"SELECT * FROM student_info WHERE st_mobile='$mobile' AND st_dob='$dob'");
                        if(mysqli_num_rows($result)>0){
                            mysqli_query($link, "UPDATE student_info SET WHERE st_form_date='$formdate' AND st_mobile='$mobile' AND st_dob='$dob'");
        ?>
        <p class="text-center"><strong>Update!</strong> .................Update Successfully!</p>
        <?php 
                        }else{
                            
                            mysqli_query($link, "INSERT INTO student_info (st_code , st_form_date, st_mobile , st_dob) VALUES ('$studentcode','$formdate','$mobile', '$dob')");
                            
                            $result=mysqli_query($link,"SELECT * FROM student_info WHERE st_mobile='$mobile' AND st_dob='$dob'");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){ 
                                    $studentid=$row['st_id'];
                                    
                                    mysqli_query($link, "INSERT INTO st_address (sta_st_id) VALUES ('$studentid')");
                                    mysqli_query($link, "INSERT INTO st_parents_info (stpi_st_id) VALUES ('$studentid')");
                                    mysqli_query($link, "INSERT INTO st_session (ss_st_id) VALUES ('$studentid')");
                                    mysqli_query($link, "INSERT INTO st_previous_academic_info (stpai_st_id) VALUES ('$studentid')");
                                }
                            }
                                                
        ?>
        <p class="text-center"><strong>Notice!</strong> .................Insert Successfully!</p>
        <?php
                        }
                    }
                    if($result = mysqli_query($link,  "SELECT * FROM student_info WHERE st_mobile ='$mobile' AND st_dob ='$dob' ORDER BY st_id ASC")){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){ 
                                $studentid=$row['st_id'];
                                $student_code=$row['st_code'];
                                
        ?>
        <div class="col-md-4"></div>
        <div class="col-sm-6 col-lg-4">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                        <h3 class="text-center">Please collect the following informations</h3>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-right" style="vertical-align:middle;">Student Code</td>
                            <td class="text-center" style="vertical-align:middle;">:</td>
                            <th class="text-left" style="vertical-align:middle;"><?php echo "$student_code";?></th>
                        </tr>
                        <tr>
                            <td class="text-right" style="vertical-align:middle;">Mobile No.</td>
                            <td class="text-center" style="vertical-align:middle;">:</td>
                            <th class="text-left" style="vertical-align:middle;"><?php echo $mobile=$row['st_mobile'];?></th>
                        </tr>
                        <tr>
                            <td class="text-right" style="vertical-align:middle;">Date of Birth.</td>
                            <td class="text-center" style="vertical-align:middle;">:</td>
                            <th class="text-left" style="vertical-align:middle;"><?php echo $dob=$row['st_dob'];}?></th>    
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php    
                        }
                    }
                }
            }
        }
        ?>
    </div>
    <div class="row">
        <form class="form-horizontal" action="atdn_add_student_info.php" role="form" method="get"> 
            <input class="form-control" type="hidden"  id="student_id" name="student_id" value="<?php echo  $studentid ;?>" >
            <input class="form-control" type="hidden"  id="student_code" name="student_code" value="<?php echo  $studentcode ;?>" >
            <input class="form-control" type="hidden" id="formdate" name="formdate" value="<?php echo $formdate ;?>">
            <input class="form-control" type="hidden" id="dob" name="dob" value="<?php echo $dob ;?>">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Next</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php 
    session_start();
    if(isset($_POST["student_id"])){
        $_SESSION["student_id"] = $student_id;
        $_SESSION["student_code"] = $student_code;
        $_SESSION["formdate"] = $formdate;   
        $_SESSION["dob"] = $dob;
    }
    ?>
    
</div>



