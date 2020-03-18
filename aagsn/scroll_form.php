<!-- Completed Scrolling Form -->
<?php include "header.php";?>
<?php include "scroll.php";?>
<?php include '../nav-bar.php';?>



<div class="container">
    <div class="row">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="hidden" name="action" value="submit">
            <hr>
            <div class="row">
                <div class="col-sm-6 col-lg-2">
                    <div class="form-group">
                        <label for="scrollno" class="col-md-4 control-label">NO.</label>
                        <div class="col-md-6">
                            <input class="form-control" id="scrollno" type="text" name="scrollno" value="<?php echo "  " ;?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="form-group">
                        <label for="des" class="col-md-4 control-label">Headline:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="headscroll" placeholder="Headline">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5">
                    <div class="form-group">
                        <label for="des" class="col-md-2 control-label">Contents:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="scrollcontent" placeholder="Content">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-1">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Add</span></button>
                        </div>
                    </div>
                </div>
            </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
        </form>
        <hr>
        <?php
        if(isset($_POST['scrollno'])){ // Fetching variables of the form which travels in URL
            $scrollno = $_POST['scrollno'];
            $headscroll = $_POST['headscroll'];
            $scrollcontent = $_POST['scrollcontent'];
            if($scrollno ==0){?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Worning!</strong> ..........Invalied Id!.
                </div>
            </div>
        </div>
        <?php 
            }else{
                $result = mysqli_query($link, "SELECT * FROM scroll WHERE srl_id='$scrollno'");
                if( mysqli_num_rows($result) > 0) {
                    mysqli_query($link, "UPDATE scroll SET srl_title='$headscroll', srl_desc='$scrollcontent' WHERE
                    srl_id='$scrollno'");
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-info fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Notice!</strong> ..............Updated!.
                </div>
            </div>
        </div>
        <?php }else{
                    mysqli_query($link, "INSERT INTO scroll (srl_title, srl_desc) VALUES ('$headscroll', '$scrollcontent')");?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Notice!</strong> .....Successfully Inserted.
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <?php 
                }
            }
        }
    ?>
    <?php
    // Attempt select query execution
    $sql = "SELECT * FROM scroll ORDER BY 'srl_id' ASC";
    $result = mysqli_query($link, $sql);    
    if($result = mysqli_query($link, $sql)){
    ?>

        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    NEWS
                    <span class="badge">
                        <?php
        // Rows Count
        $rows = mysqli_num_rows($result);
        echo "" . $rows ." ";
                        ?>
                    </span>
                </div>
                <div class="panel-body">  
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Head</th>
                                <th>Description</th>
                            </tr>
                            <?php  
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    ?>
                            <tr>
                                <td><?php echo ($row['srl_id']); ?></td>
                                <td><?php echo ($row['srl_title']); ?></td>
                                <td><?php echo ($row['srl_desc']);}?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <?php 
                // Close result set
                mysqli_free_result($result);
            }else{
                mysqli_close($link);
            }
    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- End containder -->
<?php include 'footer.php';?>