<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h2>Exam Settings</h2>
    <hr>
    <form class="form-horizontal" action="" role="form" method="post">
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="exam_name" class="col-md-4 control-label">Name </label>
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
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                    <label for="lockunlock" class="col-md-4 control-label">Lock/Unlock</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" data-mobile="true" id="lockunlock" name="lockunlock">
                            <option value="" selected>Select</option>
                            <option value="1">Lock</option>
                            <option value="0">Unlock</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" align="center">
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-check"></span> Update</button>
                <a href="exam_settings.php">
                    <button type = "button" class = "btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-plus-sign"></span>  Cencel</button>
                </a>
            </div>
        </div>
    </form><!-- End Form-->  
    
     <?php
        if(isset($_POST['exam'])){ // Fetching variables of the form which travels in URL
            $exam = $_POST['exam'];
            $lockunlock = $_POST['lockunlock'];
            
            if($lockunlock !=''){
                $result = mysqli_query($link,"SELECT * FROM exm_mst WHERE exm_mst.exm_id='$exam'");
                
                if(mysqli_num_rows($result)>0){
                    mysqli_query($link, "UPDATE exm_mst SET exm_mst.exm_lock=$lockunlock WHERE exm_mst.exm_id=$exam ");?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                Notice : <strong>  <?php echo $row['exm_id'].". " .$row['exm_name'];?></strong> .....Successfully <strong><?php if($lockunlock==1){echo "Locked";}else{echo "Unlocked"; }?></strong>
            </div>
        </div>
    </div>
    
    <?php
                } 
            }else{ 
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Notice!</strong> .....Please Select <strong>Lock</strong> or <strong>Unlock</strong>.
            </div>
        </div>
    </div>
</div>
<?php 
            }
            
        }
?>
<?php include 'footer.php';?>
