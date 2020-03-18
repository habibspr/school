<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h2>Exam Settings</h2>
    <hr>
    <form class="form-horizontal" action="" role="form" method="post">
        <div class="row">
            <div class="col-sm-6 col-lg-8">
                <div class="form-group">
                    <label for="exam" class="col-md-4 control-label">Exam </label>
                    <div class="col-md-8">
                        <select id="exam" class="form-control selectpicker" data-mobile="true" name="exam">
                            <?php 
                            $sql="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value='$row[exm_id]'> $row[exm_name] "," $row[exm_year] </option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" align="center">
            <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" name="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check"> </span>
                        Delete
                        </button>
                        <a href="exam_settings.php">
                    <button type = "button" class = "btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-plus-sign"></span>  Cencel</button>
                </a>
                    </div>
                </div>
        </div>
    </form><!-- End Form-->  
    
     <?php
        if(isset($_POST['exam'])){ // Fetching variables of the form which travels in URL
            $exam = $_POST['exam'];
            if($exam!=''){
                $sqlDel="DELETE FROM exm_mst WHERE exm_id=$exam"; 
                if (mysqli_query($link, $sqlDel)) {?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Notice!</strong> .....Delete Successfully.
            </div>
        </div>
    </div>
</div>
<?php 
        }
            }
        }
?>

<?php include 'footer.php';?>
