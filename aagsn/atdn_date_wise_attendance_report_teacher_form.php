<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <div class="row">
        <h2 align="center">Attendance Report</h2>
        <hr>
    </div>
    <form class="form-horizontal" action="atdn_date_wise_attendance_report_teacher.php" role="form" method="post">  
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="date" class="col-md-4 control-label">Date :</label>
                    <div class="col-md-6">
                        <input class="form-control input-group date" id="date" type="date" name="date" value="<?php echo date('Y-m-d');?>">
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