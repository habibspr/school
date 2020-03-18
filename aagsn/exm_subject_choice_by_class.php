<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h2>Subject Choice By Class</h2>
    <form class="form-horizontal" action="exm_print_subject_choice_by_class.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
           <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    
                    <label for="session" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="session" data-mobile="true" name="session">
                            <?php 
                            $sql="SELECT distinct ss_year FROM st_session ORDER BY ss_year DESC"; 
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
                    <label for="class" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="class" data-mobile="true" name="class">
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
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="Group" class="col-md-4 control-label">Group :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="Group" data-mobile="true" name="Group">
                            <?php 
                            $sql="SELECT * FROM st_group"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[sg_id]'>$row[sg_group]</option>";
                                }
                            ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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