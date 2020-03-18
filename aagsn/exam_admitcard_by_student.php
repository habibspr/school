<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<div class="container">
<h2>Admit Card Print</h2>
    <form class="form-horizontal" action="exam_print_admitcard_by_student.php" role="form" method="post"> 
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <label for="exam" class="col-md-3 control-label">Exam</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" data-mobile="true" name="exam">
                            <?php
                            $sql="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value=$row[exm_id]>$row[exm_name] "," $row[exm_year] </option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-4">
                        <select id="session" class="form-control selectpicker" data-mobile="true" name="session">
                            <?php 
                            $sql="SELECT distinct ss_year FROM st_session"; 
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
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="section" class="col-md-4 control-label">Section :</label>
                    <div class="col-md-4">
                        <select id="section" class="form-control selectpicker" data-mobile="true" name="section">
                            <?php 
                            $sql="SELECT * FROM st_section"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[ssec_id]'>$row[ssec_section] </option>";} ?>            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="stroll" class="col-md-4 control-label">Roll :</label>
                    <div class="col-md-4">
                        <input  class="form-control" id="stroll" type="stroll" name="stroll" <?php if (isset($_POST['stroll'])) echo 'value="'.$_POST['stroll'].'"';?> required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-1">
                <div class="form-group">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Search</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->
</div><!--end Container -->
<?php include 'footer.php';?>