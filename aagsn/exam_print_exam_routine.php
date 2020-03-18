<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container small">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <?php     
            if(isset($_POST['exam'])){ // Fetching variables of the form which travels in URL 
                $exam = isset($_POST['exam']) ? $_POST['exam'] : '';
                $date = isset($_POST['date']) ? $_POST['date'] : '';
                $time = isset($_POST['time']) ? $_POST['time'] : '';
                $class = isset($_POST['class']) ? $_POST['class'] : '';
                $Subject = isset($_POST['Subject']) ? $_POST['Subject'] : '';

                // Day count
                $dateday = strtotime($date);
                $day = date("l", $dateday);
                
                //Class Searching  //////////////////////////////////////////////////
                $classname=0;
                $resultclass = mysqli_query($link, "SELECT * FROM st_class WHERE st_class.sc_id='$class' ");
                while ($row = mysqli_fetch_array($resultclass)){
                    $classname= $row['sc_name'];
                }
                
                $i=1;


            $Qexam = "SELECT * FROM exm_mst WHERE exm_id='$exam'";
                $resultexam = mysqli_query($link, $Qexam);
                if($resultexam = mysqli_query($link, $Qexam)){
                    if(mysqli_num_rows($resultexam) > 0){
                        while($row = mysqli_fetch_array($resultexam)){?>
                            <h2 align="center"> <?php echo $row['exm_name']." - ".$row['exm_year'];?> </h2>
                            <h3 align="center"> TIME TABLE </h3>
                            <h4 align="center"> Class: <?php echo $classname;?> </h4>

                        <?php }}}
            ?>    

            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <tr>
                        <th class="text-center" style="vertical-align:middle;">Sl. No.</th>
                        <th class="text-center" style="vertical-align:middle;">Date - Day</th>
                        <th class="text-center" style="vertical-align:middle;">Time</th>
                        <th class="text-center" style="vertical-align:middle;">Class</th>
                        <th class="text-center" style="vertical-align:middle;">Subject</th>
                    </tr>
                    <?php
                    if($result = mysqli_query($link,  "SELECT * FROM exm_routine_mst, exm_subject_mst, st_class WHERE  erm_exam_id='$exam' AND sc_id='$class' AND erm_class_id=sc_id AND erm_sub_id=exm_sub_id ORDER BY erm_date ASC, erm_time ASC")){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){                    
                    ?>
                    <tbody>
                        <tr>
                            <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                            <td class="text-center" style="vertical-align:middle;"><?php echo $row['erm_date']. "<br>".$row['erm_day'] ;?></td>
                            <td class="text-center" style="vertical-align:middle;"><?php echo $row['erm_time'];?></td>
                            <td class="text-center" style="vertical-align:middle;"><?php echo $row['sc_name'];?></td>
                            <td class="text-left" style="vertical-align:middle;"><?php echo $row['exm_sub_code']."-".$row['exm_sub_name'];?></td>
                            <?php
                                                                     }
                        }
                    } 
                }
            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end Container -->
<?php include 'footer.php';?>