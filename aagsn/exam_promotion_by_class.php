<?php include "header.php";?>
 <?php 
    if(empty($global_User)){    
        include_once "../authority_login.php";    
    }else{
    ?>
<?php include '../nav-bar.php';?>
<div class="container">
    <h2>Class wise Promotion</h2>
    <form class="form-horizontal" action="exam_print_promotion_by_class.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
           <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="exam" class="col-md-4 control-label">Exam :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="exam" data-mobile="true" name="exam">
                            <?php
                            $sqlexam="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                            foreach ($link->query($sqlexam) as $row){
                                echo "<option value='$row[exm_id]'>$row[exm_name] "," $row[exm_year] </option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h4>Promotion From</h4>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">                    
                    <label for="pSession" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="pSession" data-mobile="true" name="pSession">
                           <option selected value="2017">2017</option>
                            <option value="2018">2018</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="pclass" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="pclass" data-mobile="true" name="pclass">
                            <?php 
                            $sqlpclass="SELECT * FROM st_class"; 
                            foreach ($link->query($sqlpclass) as $row){
                                echo "<option value='$row[sc_id]'>$row[sc_name]</option>";
                                }
                            ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <h4>Promoted To</h4>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">                    
                    <label for="ptSession" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="ptSession" data-mobile="true" name="ptSession">
                            <option selected value="2018">2018</option>
                            <option value="2019">2019</option> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="ptclass" class="col-md-4 control-label">Class :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="ptclass" data-mobile="true" name="ptclass">
                            <?php 
                            $sqlptclass="SELECT * FROM st_class"; 
                            foreach ($link->query($sqlptclass) as $row){
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
                    <label for="ptgroup" class="col-md-4 control-label">Group :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="ptgroup" data-mobile="true" name="ptgroup">
                            <?php 
                            $sqlptgroup="SELECT * FROM st_group"; 
                            foreach ($link->query($sqlptgroup) as $row){
                                echo "<option value='$row[sg_id]'>$row[sg_group]</option>";
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
                    <label for="ptsection" class="col-md-4 control-label">Section :</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" id="ptsection" data-mobile="true" name="ptsection">
                            <?php 
                            $sqlptsection="SELECT * FROM st_section"; 
                            foreach ($link->query($sqlptsection) as $row){
                                echo "<option value='$row[ssec_id]'>$row[ssec_section]</option>";
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
                    <label for="ptrangeStart" class="col-md-4 control-label">Range Start :</label>
                    <div class="col-md-8">
                        <input class="form-control" id="ptrangeStart" type="text" name="ptrangeStart" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="ptrangeEnd" class="col-md-4 control-label">Range End :</label>
                    <div class="col-md-8">
                        <input class="form-control" id="ptrangeEnd" type="text" name="ptrangeEnd" value="" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Done</span></button>
                    </div>
                </div>
            </div>
        </div><!-- End Row Form-->
    </form><!-- End Form-->
</div><!--end Container -->
<?php } ?>
<?php include 'footer.php';?>