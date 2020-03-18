<?php include "exam_header_for_print.php";?>
    
<style type="text/css">
    @media print{
        p.footnotes {
            page-break-after: always;
            text-align: center;
        }
    }
</style>
<div class="container small">
<?php 
if(isset($_POST['exam'])){
    $exam = $_POST['exam'];            
    $psession = $_POST['pSession'];            
    $ptsession = $_POST['ptSession'];            
    $pclass = $_POST['pclass'];
    $ptclass = $_POST['ptclass'];
    $ptgroup = $_POST['ptgroup'];
    $ptsection = $_POST['ptsection'];
    $ptrangeStart = $_POST['ptrangeStart'];
    $ptrangeEnd = $_POST['ptrangeEnd'];
    
    //exam allowed
    if($pt_exm_allowed = mysqli_query($link, "SELECT exm_cat FROM exm_mst WHERE exm_id='$exam' AND exm_lock=0 AND exm_annual=1")){
        if(mysqli_num_rows($pt_exm_allowed) > 0){
    ?>
    <?php // heading of Page
                $Company = mysqli_query($link, "SELECT * FROM company_info");
                while($row = mysqli_fetch_array($Company)){?>
    
    <div class="table-responsive">
        <table class="table table-condensed">
            <tr>
                <td class="col-sm-2" style="vertical-align:middle;">
                    <img src="../images/logo.jpg" alt="Cinque Terre" width="60" height="60"><br>
                    <?php echo $row['co_estd'];?>
                </td >
                <td class="col-sm-8" style="vertical-align:middle;">
                    <h3 class="text-center"><?php echo $row['co_name'];?></h3><br>
                    <p class="text-center"><?php echo $row['co_address'];?><br>
            www.abedalihighschool.com</p>
                </td>
                <td class="col-sm-2" style="vertical-align:middle;">
                    <p class="text-left"><?php echo "<br> EIIN : ".$row['co_code1']."<br> CODE : ".$row['co_code2'];}?></p>
                </td>
            
            </tr>
        </table>

    <div class="table-responsive">
        <table class="table-bordered">
            <?php
                $i=1;
                if($resultstud = mysqli_query($link, "SELECT * FROM student_info, st_session, result_summary WHERE result_summary.rs_exm_id='$exam' AND  student_info.st_id=result_summary.rs_st_id AND ss_st_id=st_id AND st_session.ss_class_id='$pclass' AND st_status='0' AND ss_year='$psession' AND rs_position BETWEEN '$ptrangeStart' AND '$ptrangeEnd'")){
                    if(mysqli_num_rows($resultstud) > 0){
                        while($row = mysqli_fetch_array($resultstud)){
                            $studentid =  $row ['rs_st_id']; 
                            $ssRoll =  $row ['rs_position']; 
                            $pgroup =  $row ['ss_group_id']; 
                            
                            if($newStudent = mysqli_query($link, "SELECT * FROM st_session WHERE ss_st_id='$studentid' AND ss_year='$ptsession'")){
                                if(mysqli_num_rows($newStudent) > 0){
                                    
                                    mysqli_query($link, "UPDATE st_session SET ss_class_id='$ptclass', ss_group_id='$pgroup', ss_section_id='0', ss_roll='$ssRoll' WHERE ss_st_id='$studentid' AND ss_year='$ptsession'");
                                    //update data to st_session table
                                }else{
                                    mysqli_query($link, "INSERT INTO st_session (ss_st_id, ss_class_id, ss_group_id, ss_section_id, ss_roll, ss_year) VALUES('$studentid','$ptclass','$pgroup','$ptsection','$ssRoll','$ptsession')"); 
                                //insert data to st_session table
                                }
                                /* free result set*/
                                $newStudent->close();
                                
                            }
                        }
                    }
                    /* free result set*/
                    $resultstud->close();
            ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;" hidden="hidden" ><?php echo $i++;?></td>
            </tr>
            <?php }
            // exam locking annual
            //mysqli_query($link, "UPDATE exm_mst SET exm_annual='0' WHERE exm_id='$exam' ");
            
            ?>
        </table>
        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead><h2 class="text-center">Promotion List</h2></thead>
            <tr>
                <th class="text-center" style="vertical-align:middle;">Student ID</th>
                <th class="text-center" style="vertical-align:middle;">Roll</th>
                <th class="text-center" style="vertical-align:middle;">Name</th>
                <th class="text-center" style="vertical-align:middle;">Class</th>
                <th class="text-center" style="vertical-align:middle;">Group</th>
                <th class="text-center" style="vertical-align:middle;">Subject Status</th>
            </tr>
            <?php 
            if($resultstud = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group, result_summary WHERE rs_exm_id='$exam' AND st_id=rs_st_id AND ss_st_id=st_id AND st_session.ss_class_id='$ptclass' AND st_session.ss_group_id=sg_id AND ss_year='$ptsession' AND ss_class_id=sc_id AND ss_group_id=sg_id ORDER BY ss_roll ASC")){
                    if(mysqli_num_rows($resultstud) > 0){
                        while($row = mysqli_fetch_array($resultstud)){
            ?>
            
            
            
            <tr>                
                <td class="text-center" style="vertical-align:middle;" ><?php echo $row ['st_code'];?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $row ['ss_roll'];?></td>
                <td class="text-left" style="vertical-align:middle;" ><?php echo $row ['st_name'];?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $row ['sc_name'];?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php echo $row ['sg_group'];?></td>
                <td class="text-center" style="vertical-align:middle;" ><?php $rs_stat=$row ['rs_status']; if($rs_stat==0){}else{echo "Fail- ".$rs_stat ; }  }?></td>
            </tr>
            <?php
                        }
                    }
            ?>
        </table>
    </div>
    <?php }else{?>
        <div class="alert alert-success fade in">
        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
        <strong>Notice!</strong> Exam not Allowed!
    </div>
        <?php     }
            }
            
        }
    /* Close $Link set*/
    mysqli_close($link);
    ?>
    
</div>