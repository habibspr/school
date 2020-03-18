<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php";?>
<?php include '../nav-bar.php';?>
<div class="container">
    <h2 class="text-center">Exam Routine Update</h2>
    <hr>    
    <form class="form-horizontal" action="exam_update_routine_page2.php" role="form" method="get">        
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <label for="exam" class="col-md-4 control-label">Exam</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" data-mobile="true" name="exam">
                            <?php
                            $sqlExam="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                            foreach ($link->query($sqlExam) as $row){
                                echo "<option value='$row[exm_id]'>$row[exm_name] "," $row[exm_year] </option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <label for="session" class="col-md-4 control-label">Session</label>
                    <div class="col-md-6">
                        <select  class="form-control selectpicker" data-mobile="true" name="session">
                            <?php
                            $sqlSession="SELECT distinct ss_year FROM st_session"; 
                            foreach ($link->query($sqlSession) as $row){
                                echo "<option value='$row[ss_year]'>$row[ss_year] </option>"; } ?>      
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <label for="class" class="col-md-4 control-label">Class</label>
                    <div class="col-md-8">
                        <select  class="form-control selectpicker" data-mobile="true" id="class" name="class">
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
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Next</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
     <?php 
    session_start();
    if(isset($_POST["exam"])){
        $_SESSION["exam"] = $exam ;
        $_SESSION["session"] = $session ;   
        $_SESSION["class"] = $class ;   
    }
    ?>
</div><!-- Container -->

<?php include 'footer.php';?>
