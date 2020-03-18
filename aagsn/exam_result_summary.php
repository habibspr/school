<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h2>Result Summary</h2>
    <form class="form-horizontal" action="exam_print_result_summary.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
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
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Search</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->
</div><!--end Container -->
<?php include 'footer.php';?>