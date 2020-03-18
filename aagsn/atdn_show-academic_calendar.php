<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <?php
        if(isset($_POST['year'])){ // Fetching variables of the form which travels in URL
            $year = $_POST['year'];
            $status = $_POST['status'];
            if($year !=''){
                if($status!="allday"){
                    // Attempt select query execution
                    $sql = "SELECT * FROM at_calendar WHERE atc_year='$year' AND atc_status='$status' ORDER BY atc_date ASC ";
                    $result = mysqli_query($link, $sql);
                }else{
                    $sql = "SELECT * FROM at_calendar WHERE atc_year='$year' ORDER BY atc_date ASC ";
                    $result = mysqli_query($link, $sql);
                }
        ?>
    <h1 class="text-center">Academic Calendar : 
            <small>
                <?php echo "" . $year . "  - " ; 
                if($status ==''){ 
                    echo "All Days"; 
                }else{
                    if($status ==1){
                        echo "Working Days"; 
                    }else{
                        echo "Off Days";
                    }
                }
                ?>
            </small>
        </h1>        
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
                    Academic Calendar : <?php echo $year ;?>
                    <span class="badge">
                        <?php
                // Rows Count
                $rows = mysqli_num_rows($result);
                echo "" . $rows ."";
                        ?>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                                <th>Sl. No.</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Description</th>
                                <th>Type</th>
                            </tr>
                            <?php 
                $i=1;
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){?>
                            <tbody>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo ($row['atc_date']); ?></td>
                                    <td align="left"><?php echo ($row['atc_day']);?></td>
                                    <td><?php echo ($row['atc_des']);?></td>
                                    <td><?php $atstatus=$row['atc_status']; if($atstatus==1){echo "On Day";}elseif($atstatus==0){echo "Off Day";}else{echo "";} ?></td>
                                    <?php 
                                                                 }  // Close result set
                        mysqli_free_result($result);
                    } else{ ?>
                                    <div class="alert alert-info fade in">
                                        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Notice!</strong> ............... No records matching!
                                    </div>
                                    <?php }
                }
            }
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);    
            // Close connection
            mysqli_close($link);
        }
                                    ?>
                                </tr>
                            </tbody>  
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-sm-1"></div>
    </div>
</div><!--end Container -->
<?php include 'footer.php';?>