<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
<h2>Student Searching</h2>
    <form class="form-horizontal" action="atdn_print_class_wise_parents_attendance_sheet.php" role="form" method="get">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-8">
                        <select id="session" class="form-control selectpicker" data-mobile="true" name="session">
                            <?php 
                            $sqlyear="SELECT distinct ss_year FROM st_session"; 
                            foreach ($link->query($sqlyear) as $row){
                                echo "<option value='$row[ss_year]'>$row[ss_year] </option>";
                            }
                            ?>            
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
                                echo "<option value = '$row[sc_id]' > $row[sc_name] </option>";
                            } ?>            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="group" class="col-md-4 control-label">Group :</label>
                    <div class="col-md-8">
                        <select id="group" class="form-control selectpicker" data-mobile="true" name="group">
                            <?php 
                            $sql="SELECT * FROM st_group"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value = '$row[sg_id]' > $row[sg_group] </option>";
                            } ?>            
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-1">
                <div class="form-group">
                    <div class="col-md-2">
                        <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Search</span></button>
                    </div>
                </div>
            </div>    
    </form> 
</div><!--end Container -->
<?php 
session_start();
if(isset($_POST["session"])){
    $_SESSION["session"] = $session ;
    $_SESSION["class"] = $class ;
    $_SESSION["group"] = $group ;
    }

?>
<?php include 'footer.php';?>