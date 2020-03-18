<?php include "header.php" ;?>
<?php include 'nav-bar.php';?>

<div class="container">
    
    <div class="page-header text-center"><h2>Admission test result publish</h2></div>
    <?php 
    include "adm_database_status.php";
    if($General_Security_Status or $Result_Security_Status){?>
    <div class="alert alert-success fade in">
        <strong>Permission ! </strong> You are not permitted !
    </div> 
    <?php die(); } ?>
    
    
    <form class="form-horizontal" action="adm_print_result_publish.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" id="session" data-mobile="true" name="session">
                            <?php
                            $sql="SELECT distinct aui_session FROM adm_user_info ORDER BY aui_session DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[aui_session]'>$row[aui_session]</option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-sm-6 col-lg-12">
                <div class="form-group">
                    <label for="adclass" class="col-md-4 control-label">Class</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" id="adclass" data-mobile="true" name="adclass">
                            <?php
                            $sql="SELECT * FROM adm_class_mst"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[acm_id]'>$row[acm_name]</option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="form-group">
                    <label for="maritrange" class="col-md-4 control-label">Marit Range</label>
                    <div class="col-md-4">
                        <input class="form-control" id="maritrange" type="text" name="maritrange" value="" >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="form-group">
                    <label for="waitingrange" class="col-md-4 control-label">Waiting Range</label>
                    <div class="col-md-4">
                        <input class="form-control" id="waitingrange" type="text" name="waitingrange" value="" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-12">
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-lg btn-block btn-primary"><span class="glyphicon glyphicon-check"> Submit</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div><!--end Container -->