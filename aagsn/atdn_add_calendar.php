<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "header.php"; ?>
<?php include "../nav-bar.php"; ?>


<div class="container">
    <div class="row">
        <h2 class="text-center"> Academic Calendar <small>Settings</small> </h2>
        <hr>
        <form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" role="form" method="post">
            <input type="hidden" name="action" value="submit">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="date" class="col-md-4 control-label">Date :</label>
                    <div class="col-md-8">
                        <input  class="form-control" id="date" type="date" name="date" <?php if (isset($_POST['date'])) echo 'value="'.$_POST['date'].'"';?> autofocus required>
                        <span class="help-block"><?php echo date('Y-m-d');?> </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="des" class="col-md-4 control-label">Details :</label>
                    <div class="col-md-8">
                        <input class="form-control" id="des" type="text" name="des" value="" placeholder="Description Here">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="des" class="col-md-4 control-label">Status :</label>
                    <div class="col-md-4">
                        <select  class="form-control selectpicker" data-mobile="true" name="status">
                            <option selected value="1">On Day</option>
                            <option value="0">Off Day</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-check"> Add </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
</div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
    
    <?php
    if(isset($_POST['date'])){ // Fetching variables of the form which travels in URL
        $date = $_POST['date'];
        $des = $_POST['des'];
        $status = $_POST['status'];
        $datei = strtotime($date);
        $day = date("l", $datei);
        if($date !=''){
            $result = mysqli_query($link, "SELECT * FROM at_calendar WHERE atc_date='$date'");
            if( mysqli_num_rows($result) > 0) {
                mysqli_query($link, "UPDATE at_calendar SET atc_year='$date=Y', atc_day='$day', atc_des='$des',atc_status='$status' WHERE atc_date='$date'");
        ?>
    <div class="alert alert-success fade in">
        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
        <strong>Notice!</strong> ............ Updated!
    </div>
    <?php }else{
                mysqli_query($link, "INSERT INTO at_calendar (atc_year, atc_date, atc_day, atc_des, atc_status) VALUES ('$date=Y','$date','$day', '$des', '$status')");
    ?>
    <div class="alert alert-success fade in">
        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
        <strong>Notice!</strong> ............ Inserted!
    </div>
    <?php 
            }
        }
    }
    ?>
    <?php include 'atdn_at_calendar.php'; //for showing calendar?>
</div>
<?php include 'footer.php';?>