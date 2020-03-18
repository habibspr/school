<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;

         $querystudent = mysqli_query($link, "SELECT * FROM st_attendance, student_info, st_session, st_class WHERE st_id=ss_st_id AND st_id=at_st_id AND ss_class_id=sc_id ORDER BY at_date DESC, at_timestamp DESC LIMIT 5 ");?>
            <h3 style="color:green;">Latest Records</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Roll</th>
                        <th>Time</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($querystudent)){  ?>
                    <tr>
                        <td><?php echo $row['st_name'];?></td>
                        <td><?php echo $row['sc_name'];?></td>
                        <td><?php echo $row['ss_roll'];?></td>
                        <td><?php echo date('h:i:s a');}?></td>
                    </tr>
                </table>
            </div>