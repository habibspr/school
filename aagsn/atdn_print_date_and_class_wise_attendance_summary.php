<!-- attendance report by students -->
<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <?php
    if(isset($_POST['session'])){ // Fetching variables of the form which travels in URL
        $session = $_POST['session'];//Year
        $class=$_POST['class']; 
        $group=$_POST['group']; 
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        
        //Working Days
        $resultworkingdays = mysqli_query($link, "SELECT DISTINCT at_date FROM st_attendance WHERE at_date BETWEEN '$startdate' AND '$enddate'");
        $workingdays = mysqli_num_rows($resultworkingdays);
        
        // Class Name
        $classname=0;
        $resultClassName=mysqli_query($link, "SELECT * FROM st_class WHERE st_class.sc_id='$class'");
        while($row = mysqli_fetch_array($resultClassName)){
           $classname=$row['sc_name'];              
        }
        
        $groupname=0;
        $resultGroupName=mysqli_query($link, "SELECT * FROM st_group WHERE sg_id='$group'");
        while($row = mysqli_fetch_array($resultGroupName)){
           $groupname=$row['sg_group'];              
        }
    ?>
<h1 align="center">Attendance Report </h1>
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                    General Info: 
                </div>
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                                <th class="text-center" style="vertical-align:middle;">Session</th>
                                <th class="text-center" style="vertical-align:middle;">Class</th>
                                <th class="text-center" style="vertical-align:middle;">Group</th>
                                <th class="text-center" style="vertical-align:middle;">Between</th>
                                <th class="text-center" style="vertical-align:middle;">Working Days</th>
                            </tr>
                            
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $session; ?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $classname;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $groupname;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $startdate." To ".$enddate;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $workingdays;?></td>
                            </tr>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                    Details:
                </div>
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <tr>
                            <th class="text-center" style="vertical-align:middle;">No.</th>
                            <th class="text-center" style="vertical-align:middle;">Name</th>
                            <th class="text-center" style="vertical-align:middle;">Class</th>
                            <th class="text-center" style="vertical-align:middle;">Group</th>
                            <th class="text-center" style="vertical-align:middle;">Roll</th>
                            <th class="text-center" style="vertical-align:middle;">Status</th>
                            <th class="text-center" style="vertical-align:middle;">Attendance</th>
                        </tr>
                            
                            <?php  
        $i=1; ///// student search 
            if($resultat = mysqli_query($link, "SELECT * FROM st_attendance WHERE st_attendance.at_date BETWEEN '$startdate' AND  '$enddate' AND st_attendance.at_year='$session' ")){
                
                if(mysqli_num_rows($resultat) > 0){
                    
                    if($result = mysqli_query($link, "SELECT * FROM student_info, st_session, st_class, st_group WHERE st_id=ss_st_id AND ss_class_id=sc_id AND sc_id='$class' AND ss_year='$session' AND ss_group_id=sg_id AND sg_id='$group' ORDER BY ss_roll ASC ")){
                        
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                $studentid=$row['st_id'];
                                $ClassName=$row['sc_name'];
                                $GroupName=$row['sg_group'];
                                
                                //Attendance Count 
                                    $resultattendance = mysqli_query($link, "SELECT * FROM st_attendance WHERE at_date BETWEEN '$startdate' AND '$enddate' AND at_st_id='$studentid' AND at_year='$session'AND at_intime<='12:00:00'");
                                    $attendancecount = mysqli_num_rows($resultattendance);                            
                            ?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $i++; ?></td>
                                <td class="text-left" style="vertical-align:middle;"><?php echo $row['st_name'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $ClassName;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $GroupName;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['ss_roll'];?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php $StudentStatus=$row['st_status']; if($StudentStatus){ ?><p style="color:red;">Inactive</p><?php }else{?><p style="color:green;">Active</p> <?php }?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $attendancecount;} ?></td>
                            </tr>
                            <?php }}}}}?>
                        </table><!-- End Table Students Attendance Details-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end Container -->
<?php include 'footer.php';?>
