<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <div class="page-header text-center"><h3>Seat Plan</h3></div>
    <form class="form-horizontal" action="exam_print_seat_plan.php" role="form" method="post">   
        <div class="row">
           <div class="col-sm-6 col-lg-8">
                <div class="form-group">
                    <label for="exam" class="col-md-4 control-label">Exam</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="exam" data-mobile="true" name="exam">
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
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Search</span></button>
                    </div>
                </div>
            </div>
            
        </div><!-- End Row Form-->
        
    </form><!-- End Form-->
    <div class="row text-center" style="margin-top:100px;">
        <div class="col-sm-12">
            <div class="alert alert-info fade in">
                <strong>Notice!</strong> Select margin minimum in chrome
            </div>
        </div>
    </div>
</div><!--end Container -->