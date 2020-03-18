<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container small">
    <div class="row">
        <h2 align = "center">Exam Settings</h2>
        <div class="table responsive">
            <table class="table table-bordered table-condensed table-striped table-hover">
                <tr>
                    <th rowspan="2" class="text-center" style="vertical-align:middle;">Sl. No.</th>
                    <th rowspan="2" class="text-center" style="vertical-align:middle;">Name</th>
                    <th rowspan="2" class="text-center" style="vertical-align:middle;">Session</th>
                    <th rowspan="2" class="text-center" style="vertical-align:middle;">Category</th>
                    <th colspan="4" class="text-center" style="vertical-align:middle;">Extra Mark From Previous Exams</th>
                    <th colspan="2" class="text-center" style="vertical-align:middle;">Percentage</th>
                </tr>
                <tr>
                    <th class="text-center" style="vertical-align:middle;">1st</th>
                    <th class="text-center" style="vertical-align:middle;">2nd</th>
                    <th class="text-center" style="vertical-align:middle;">3rd</th>
                    <th class="text-center" style="vertical-align:middle;">Extra Exam Percent</th>
                    <th class="text-center" style="vertical-align:middle;">Current Exam Percent</th>
                </tr>
                
                <?php
                $i=1;
                if($result = mysqli_query($link,  "SELECT * FROM exm_mst WHERE exm_year=CURDATE() ORDER BY exm_id ASC")){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){ ?>
                <tr>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_id'];?></td>
                    <td class="text-left" style="vertical-align:middle;"><a href="exam_update_exam.php"><?php echo $row['exm_name'];?></a></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_year'];?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php $excat=$row['exm_cat']; 
                                                                  if($excat==0){
                                                                      echo "Single";
                                                                  }else{
                                                                      echo "Multiple";
                                                                  }?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_ex_mark1'];?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_ex_mark2'];?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_ex_mark3'];?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_extra_percent'];?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['exm_current_percent'];}?></td>
                </tr>
            </table>
            <?php }} ?>
        </div>
        
    </div>
    <div class="row" align="center">
        <a href="exam_add_exam.php">
            <button type = "button" class = "btn btn-primary btn-lg">
            <span class="glyphicon glyphicon-plus-sign"></span>  Add Exam
            </button>
        </a>
        <a href="exam_update_exam.php">
            <button type = "button" name="update" class = "btn btn-success btn-lg">
                <span class="glyphicon glyphicon-ok-sign"></span> Update Exam
            </button>
        </a>
    </div>
    </div>
    <?php include 'footer.php';?>
