<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h2>Number Sheet Print</h2>
    <form class="form-horizontal" action="exam_print_number_sheet.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
           <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="exam" class="col-md-4 control-label">Exam :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="exam" data-mobile="true" name="exam">
                            <?php
                            $sql="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[exm_id]'>$row[st_code] "," $row[exm_name] "," $row[exm_year] </option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="Session" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="Session" data-mobile="true" name="Session">
                            <?php 
                            $sql="SELECT distinct ss_year  FROM st_session ORDER BY ss_year DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[ss_year]'>$row[ss_year]</option>";
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
                    <label for="stClass" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="stClass" data-mobile="true" name="stClass">
                            <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[sc_id]'>$row[sc_name]</option>";
                                }
                            ?> 
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="Subjects" class="col-md-4 control-label">Subject :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="Subjects" data-mobile="true" name="Subjects">
                            <?php 
                            $sql="SELECT * FROM exm_subject_mst"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[exm_sub_id]'>$row[exm_sub_code]"," - $row[exm_sub_name]</option>";
                                }
                            ?> 
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