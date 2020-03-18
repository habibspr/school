<?php include "header.php" ;?>
<?php include 'nav-bar.php';?>

<div class="container">
    
    <div class="page-header text-center">
        <h2>Admisstion test merit list</h2>
    </div>
    
    <form class="form-horizontal" action="adm_print_marit_list.php" role="form" method="post">        
        <input type="hidden" name="action" value="submit">
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session</label>
                    <div class="col-md-4">
                        <select  class="form-control custom-select" id="session" data-mobile="true" name="session">
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
                        <select  class="form-control custom-select" id="adclass" data-mobile="true" name="adclass">
                            <?php
                            $sql="SELECT * FROM adm_class_mst ORDER BY acm_id ASC"; 
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
                    <label for="marit_waiting" class="col-md-4 control-label">Marit Range</label>
                    <div class="col-md-4">
                        <select  class="form-control custom-select " id="marit_waiting" data-mobile="true" name="marit_waiting">
                            <?php
                            $sql="SELECT distinct am_status FROM adm_marks ORDER BY am_status ASC"; 
                            foreach ($link->query($sql) as $row){
                                $result=$row['am_status'];
                                // Result Status
                                switch ($result) {
                                    case "0": $rStatus="NOT ASSIGNED"; break;
                                    case "1": $rStatus="ALLOWED"; break;
                                    case "2": $rStatus="WAITING"; break;
                                    case "3": $rStatus="NOT ALLOWED"; break;
                                }
                                echo "<option value='$result'>$rStatus</option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                         <button type="submit" class="btn btn-lg btn-block btn-primary"><span class="glyphicon glyphicon-check"> Submit</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div><!--end Container -->