<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <div class="row">
        <h2 align="center">Date wise Attendance Summary</h2>
        <hr>
    </div>
    <form class="form-horizontal" action="atdn_print_date_wise_attendance_summary_teacher.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="studentid" class="col-md-4 control-label">Year:</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" id="session" data-mobile="true" name="session">
                               <?php 
                            $sql="SELECT distinct ta_year FROM teach_attendance ORDER BY ta_year DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value=$row[ta_year]>$row[ta_year] </option>";
                                }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="startdate" class="col-md-4 control-label">From :</label>
                    <div class="col-md-8">
                        <input class="form-control" id="startdate" type="date" name="startdate" value="<?php echo "".date('Y-m')."-01" ;?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="enddate" class="col-md-4 control-label">To :</label>
                    <div class="col-md-8">
                        <input class="form-control" id="enddate" type="date" name="enddate" value="<?php echo date('Y-m-d');?>">
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