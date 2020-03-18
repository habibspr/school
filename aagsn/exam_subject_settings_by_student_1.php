<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
<h2>Subject Settings</h2>
    <form class="form-horizontal" action="exam_subject_settings_by_student_2.php" role="form" method="get">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-4">
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
                    <div class="col-md-6">
                        <select id="class" class="form-control selectpicker" data-mobile="true" name="class">
                            <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value = '$row[sc_id]' > $row[sc_name] </option>";
                            } ?>            
                        </select>
                    </div>
                </div>
            </div> 
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="group" class="col-md-4 control-label">Group :</label>
                    <div class="col-md-6">
                        <select id="group" class="form-control selectpicker" data-mobile="true" name="group">
                            <?php 
                            $sql="SELECT * FROM st_group"; 
                            foreach ($link->query($sql) as $row){ 
                                echo "<option value= '$row[sg_id]' > $row[sg_group] </option>" ;
                            }?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="roll" class="col-md-4 control-label">Roll :</label>
                    <div class="col-md-4">
                        <input  class="form-control" id="roll" type="text" name="roll" <?php if (isset($_POST['roll'])) echo 'value="'.$_POST['roll'].'"';?> required>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <div class="col-md-2">
                        <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Next</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form><!-- End Form-->    
</div><!--end Container -->
<?php 
session_start();
if(isset($_POST["session"])){
    $_SESSION["session"] = $session ;
    $_SESSION["class"] = $class ;
    $_SESSION["group"] = $group ;
    $_SESSION["roll"] = $roll ;
    }

?>
<?php include 'footer.php';?>