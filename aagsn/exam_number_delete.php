<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php";?>
<?php include '../nav-bar.php';?>
<div class="container">
<h2>Delete Subject Wise Number </h2>
    <form class="form-horizontal" action="" role="form" method="post">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="exam" class="col-md-4 control-label">Exam</label>
                    <div class="col-md-8">
                        <select id="exam" class="form-control selectpicker" data-mobile="true" name="exam">
                            <?php 
                            $sql="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[exm_id]'> $row[exm_name] "," $row[exm_year] </option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="subject" class="col-md-4 control-label">Subject</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" data-mobile="true" id="subject" name="subject">
                            <?php 
                            $sql="SELECT * FROM exm_subject_mst ORDER BY exm_sub_id ASC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value=$row[exm_sub_id]>$row[exm_sub_code] "," $row[exm_sub_name] </option>";
                                }
                            ?>            
                            
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="studentid" class="col-md-4 control-label">Student Id:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="roll" name="roll" maxlength="3" >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <div class="col-md-2">
                        <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Reset</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->    
</div><!--end Container -->
<?php     
    if(isset($_POST['exam'])){ // Fetching variables of the form which travels in URL 
        $exam = isset($_POST['exam']) ? $_POST['exam'] :'';
        $class = isset($_POST['class']) ? $_POST['class'] :'';
        $subject = isset($_POST['subject']) ? $_POST['subject'] :'';
        $roll = isset($_POST['roll']) ? $_POST['roll'] :'';
        
        if($roll!=''){
            
            $sqlDel="DELETE FROM exm_marks WHERE mrk_exam_id='$exam' AND mrk_subject_id=$subject AND mrk_st_id=$roll "; 
            if (mysqli_query($link, $sqlDel)) {
                ?>    
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Update!</strong> Data Deleted <?php echo "Exam: " .$exam. " Subject: " .$subject ;?>
            </div>
        </div>
    </div>
    <?php } } } ?>


<?php include 'footer.php';?>