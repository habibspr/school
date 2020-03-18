<?php include "header.php"; ?>
<?php include "../nav-bar.php"; ?>


<div class="container">    
    <div class="row">
        <h2 align="center"> Date and Class wise Attend / Absent Report </h2>
        <hr>
    </div>
    <form class="form-horizontal" action="atdn_date_and_student_wise_attendance_and_absent.php" role="form" method="post">             <input type="hidden" name="action" value="submit">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="form-group">
                    <label for="class" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-6">
                        <select  class="form-control selectpicker" id="class" data-mobile="true" name="class">
                            <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value=$row[sc_id]>$row[sc_name] </option>";
                                }?>
                        </select>
                    </div>
                </div>
            </div> 
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="absent_attend" class="col-md-5 control-label">Absent / Attend :</label>
                    <div class="col-md-6">
                        <select  class="form-control selectpicker" id="absent_attend" data-mobile="true" name="absent_attend">
                            <option selected>Attend</option>
                            <option value="Absent">Absent</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="form-group">
                    <label for="date" class="col-md-4 control-label">Date :</label>
                    <div class="col-md-6">
                        <input class="form-control input-group date" id="date" type="date" name="date" value="<?php echo date('Y-m-d');?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
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