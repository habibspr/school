<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
<h2>Marks Entry Page-1</h2>
    <form class="form-horizontal" action="exam_marks_entry_page2.php" role="form" method="get">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="exam" class="col-md-4 control-label">Exam :</label>
                    <div class="col-md-8">
                        <select id="exam" class="form-control selectpicker" data-mobile="true" name="exam">
                            <?php 
                            $sql="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[exm_id]'>$row[exm_name] "," $row[exm_year] </option>"; } ?>        
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-8">
                        <select id="session" class="form-control selectpicker" data-mobile="true" name="session">
                            <?php 
                            $sql="SELECT distinct ss_year FROM st_session ORDER BY ss_year DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[ss_year]'>$row[ss_year] </option>";
                            } ?>            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="class" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-8">
                        <select id="class" class="form-control selectpicker" data-mobile="true" name="class">
                            <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value = '$row[sc_id]' >$row[sc_name] </option>";
                            } ?>            
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="subject" class="col-md-4 control-label">Subject :</label>
                    <div class="col-md-8">
                        <select id="subject" class="form-control selectpicker" data-mobile="true" name="subject">
                            <?php 
                            $sql="SELECT * FROM exm_subject_mst ORDER BY exm_sub_id ASC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[exm_sub_id]'>$row[exm_sub_code] "," $row[exm_sub_name]  </option>";
                            }
                            ?>            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="stype" class="col-md-4 control-label">Mark Type :</label>
                    <div class="col-md-8">
                        <select id="stype" class="form-control selectpicker" data-mobile="true" name="stype">
                            <option selected>All</option>
                                <option value="cr">Creative</option>                            
                                <option value="obj">Creative and Objective</option>                            
                                <option value="prac">Creative and Practical</option>                            
                                <option value="ob">Objective</option>                            
                                <option value="pr">Practical</option>                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-1">
                <div class="form-group">
                    <div class="col-md-2">
                        <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Next</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->    
</div><!--end Container -->
<?php 
session_start();
if(isset($_POST["exam"])){
    $_SESSION["exam"] = $exam ;
    $_SESSION["session"] = $session ;
    $_SESSION["class"] = $class ;
    $_SESSION["subject"] = $subject;
    $_SESSION["stype"] = $stype;    
}
?>
<?php include 'footer.php';?>