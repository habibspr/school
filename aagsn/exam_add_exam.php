<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h2>Exam Settings</h2>
    <hr>
    <form class="form-horizontal" action="" role="form" method="post">
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="exam_name" class="col-md-4 control-label">Name </label>
                    <div class="col-md-8">
                        <input class="form-control" id="exam_name" style="text-transform:uppercase" name="exam_name" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="category" class="col-md-4 control-label">Category</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" data-mobile="true" id="category" name="category">
                            <option selected>Select</option>
                            <option value="0">Single</option>
                            <option value="1">Multiple</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h4 class="">Marks Distribution</h4>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="exam_1" class="col-md-4 control-label">1st Exam id</label>
                    <div class="col-md-4">
                        <input class="form-control" id="exam_1" name="exam_1" value="0" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="exam_2" class="col-md-4 control-label">2nd Exam id</label>
                    <div class="col-md-4">
                        <input class="form-control" id="exam_2" name="exam_2" value="0" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="exam_3" class="col-md-4 control-label">3rd Exam id</label>
                    <div class="col-md-4">
                        <input class="form-control" id="exam_3" name="exam_3" value="0" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="extpercent" class="col-md-4 control-label">Extra Exam Percent</label>
                    <div class="col-md-4">
                        <input class="form-control" id="extpercent" name="extpercent" value="0" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="resultpdate" class="col-md-4 control-label">Result publish Date:</label>
                    <div class="col-md-4">
                        <input type="date" class="form-control" id="resultpdate" name="resultpdate">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="resultptime" class="col-md-4 control-label">Result publish Time:</label>
                    <div class="col-md-4">
                        <input type="time" class="form-control" id="resultptime" name="resultptime">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" align="center">
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-check"></span> Add Exam</button>
                <a href="exam_settings.php">
                    <button type = "button" class = "btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-plus-sign"></span>  Cencel</button>
                </a>
            </div>
        </div>
    </form><!-- End Form-->  
    
     <?php
        if(isset($_POST['exam_name'])){ // Fetching variables of the form which travels in URL
            $exam_name = $_POST['exam_name'];
            $category = $_POST['category'];
            $exam_1 = $_POST['exam_1'];
            $exam_2 = $_POST['exam_2'];
            $exam_3 = $_POST['exam_3'];
            $extpercent = $_POST['extpercent'];
            $resultpdate = $_POST['resultpdate'];
            $resultptime = $_POST['resultptime'];
            $currpercent = 100-$extpercent;
            
            
            // Exam Id
            $examid=0;
            $resulexamid = mysqli_query($link, "SELECT exm_mst.exm_id FROM exm_mst WHERE exm_name='$exam_name'");
            while($row = mysqli_fetch_array($resulexamid)){
                $examid=$row['exm_id'];
            }
            
            
            // examlocking
            $exmlock=0;
            $resultexmlock = mysqli_query($link, "SELECT exm_lock, exm_year FROM exm_mst WHERE  exm_mst.exm_id='$examid'");
            while($row = mysqli_fetch_array($resultexmlock)){
                $exmlock=$row['exm_lock'];
                $exam_year=$row['exm_year'];
                
            }
            if($exmlock==1 && $category==""){
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Warning!</strong> Time Out The <?php echo $exam_name, $exam_year;?> ....... this Exam Is locked.
            </div>
        </div>
    </div>
    <?php }else{
                $result = mysqli_query($link,"SELECT * FROM exm_mst WHERE exm_mst.exm_id='$examid' AND exm_name='$exam_name'");
                if( mysqli_num_rows($result) > 0){
                    mysqli_query($link,"UPDATE exm_mst SET exm_cat='$category', exm_ex_mark1='$exam_1', exm_ex_mark2='$exam_2', exm_ex_mark3='$exam_3', exm_extra_percent='$extpercent', exm_current_percent='$currpercent' WHERE exm_name='$exam_name' AND exm_mst.exm_id=$examid");
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Notice!</strong> .....Successfully Updated.
            </div>
        </div>
    </div>
    <?php
            }else{
                    mysqli_query($link, "INSERT INTO exm_mst (exm_name, exm_year, exm_cat, exm_ex_mark1, exm_ex_mark2, exm_ex_mark3, exm_extra_percent, exm_current_percent ) VALUES (UPPER('$exam_name'), CURRENT_DATE(), '$category','$exam_1','$exam_2','$exam_3','$extpercent', '$currpercent')");
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Notice!</strong> .....Successfully Inserted.
            </div>
        </div>
    </div>
</div>

<?php }
            }
        }        
?>
<?php include 'footer.php';?>
