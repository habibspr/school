<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <div class="row">
        <h2 align="center">Attendance Report</h2>
        <hr>
    </div>
    <form class="form-horizontal" action="atdn_print_student_wise_attendance_report.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="studentid" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" data-mobile="true" name="session">
                            <?php 
                            $sql="SELECT distinct ss_year FROM st_session"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value=$row[ss_year]>$row[ss_year]</option>";
                            }
                            ?>            
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="studentid" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" data-mobile="true" name="class">
                            <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value=$row[sc_id]>$row[sc_name] </option>";
                            }
                            ?>            
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="roll" class="col-md-4 control-label">Roll :</label>
                    <div class="col-md-4">
                        <input class="form-control" id="roll" type="text" name="roll" placeholder="Roll" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="startdate" class="col-md-4 control-label">From :</label>
                    <div class="col-md-6">
                        <input class="form-control input-group date" id="startdate" type="date" name="startdate" value="<?php echo "".date('Y')."-01-01" ;?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="enddate" class="col-md-4 control-label">To :</label>
                    <div class="col-md-6">
                        <input class="form-control input-group date" id="enddate" type="date" name="enddate" value="<?php echo date('Y-m-d');?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"> Show</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->
</div><!--end Container -->
<?php include 'footer.php';?>