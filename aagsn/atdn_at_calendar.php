<?php
if(isset($_POST['date'])){ // Fetching variables of the form which travels in URL
    $date = $_POST['date'];
    $des = $_POST['des'];
    $status = $_POST['status'];
    if($date !=''){
        // Attempt select query execution
        $sql = "SELECT * FROM at_calendar WHERE atc_year='$date=Y' ORDER BY atc_date ASC";
        $result = mysqli_query($link, $sql);
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-calendar"> Academic Calendar  <?php $thisdate = new DateTime($date); echo $thisdate->format('Y');?>
            <span class="badge">
                <?php
        // Rows Count
        $rows = mysqli_num_rows($result);
        echo "" . $rows ." ";
                ?>
            </span>
            </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th class="text-center" style="vertical-align:middle;">Sl. No.</th>
                <th class="text-center" style="vertical-align:middle;">Date</th>
                <th class="text-center" style="vertical-align:middle;">Day</th>
                <th class="text-center" style="vertical-align:middle;">Description</th>
                <th class="text-center" style="vertical-align:middle;">Type</th>
            </tr>
            <?php 
        $i=1;
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){?>
            <tbody>
                <tr>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['atc_date']; ?></td>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $row['atc_day'];?></td>
                    <td class="text-left" style="vertical-align:middle;"><?php echo $row['atc_des'];?></td>
                        <td class="text-center" style="vertical-align:middle;"><?php $atstatus=$row['atc_status']; if($atstatus==1){echo "On Day";}else echo "Off Day";}   ?></td>
                    <?php  
                // Close result set
                mysqli_free_result($result);
            }else{
                echo "No records matching";
            }
            mysqli_close($link);
        }
    }
}
    ?>
                </tr>
            </tbody>
        </table>
    </div>