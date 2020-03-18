<?php include 'header.php';?>
<?php include 'nav-bar.php';?>
<script type="text/javascript">
    function PrintPage() {
        document.getElementById('print').style.display = 'none';
        window.resizeTo(960, 600);
        document.URL = "";
        window.location.href = "";
        window.print();
    }
</script>

<?php 
if(isset($_POST['adclass'])){ // Fetching variables of the form which travels in URL     
    $session = isset($_POST['session']) ? $_POST['session'] : '';
    $adclass = isset($_POST['adclass']) ? $_POST['adclass'] : '';
    $maritrange = isset($_POST['maritrange']) ? $_POST['maritrange'] : '';
    $waitingrange = isset($_POST['waitingrange']) ? $_POST['waitingrange'] : '';    
}

// class name searching
	$resultClassName = mysqli_query($link,  "SELECT * FROM adm_class_mst WHERE acm_id='$adclass' ");
                        while($row = mysqli_fetch_array($resultClassName)){
                            $ClassName = $row['acm_name'];
                        }    
    ?>
    <div class="container">
        <?php include "adm_database_status.php" ;?>
        
        <div class="page-header">
            <h2 class="text-center"> Admission test Result- <?php echo "$session";?> </h2>            
            <p class="text-center">Published : <?php echo date(' F d, Y L H:s:m A');?></p>
        </div>
        
        
        <div class="col-sm-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">  
                        <?php 
        $i=1; 
        $formid=0;
        $maritstatus=0;
		$resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_class_mst, adm_marks WHERE aui_id=am_form_id AND acm_id=aui_class_id AND aui_class_id='$adclass' AND aui_session='$session'  ORDER BY am_mark DESC, am_form_id ASC ");
            while($row = mysqli_fetch_array($resultprint)){
                $formid=$row['aui_id'];
                $maritstatus=$row['am_position'];
                // position
                $result=mysqli_query($link,"SELECT * FROM adm_marks WHERE am_form_id='$formid' ");
                if(mysqli_num_rows($result)>0){
                    mysqli_query($link, "UPDATE adm_marks SET am_position='$i' WHERE am_form_id='$formid' "); // update position
                    $i++;
                }
				
				mysqli_query($link, "UPDATE adm_marks SET am_status='0' ");// not assigned
				mysqli_query($link, "UPDATE adm_marks SET am_status='1' WHERE am_position <= $maritrange"); // Allowed
				mysqli_query($link, "UPDATE adm_marks SET am_status='2' WHERE (am_position > $maritrange AND am_position <= $waitingrange)");// waittinging
				mysqli_query($link, "UPDATE adm_marks SET am_status='3' WHERE am_position > $waitingrange"); // Not Allowed
				
            }?> 
                        </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped table-hover">  
                        <thead>
                            
                            <tr>
                                <th class="text-right" style="vertical-align:middle;">Session </th>
                                <th class="text-center" style="vertical-align:middle;">: </th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo "$session";?> </td>
                                <th class="text-right" style="vertical-align:middle;">Class </th>
                                <th class="text-center" style="vertical-align:middle;">: </th>
                                <td class="text-left" style="vertical-align:middle;"><?php echo "$ClassName";?> </td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align:middle;">SL No.</th>
                                <th class="text-center" style="vertical-align:middle;">Form No.</th>
                                <th class="text-center" style="vertical-align:middle;">Name</th>
                                <th class="text-center" style="vertical-align:middle;">Marks</th>
                                <th class="text-center" style="vertical-align:middle;">Position</th>
                                <th class="text-center" style="vertical-align:middle;">Status</th>
                            </tr>
                        </thead>
                        <?php 
        $i=1; 
        $formid=0;
        $resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_marks WHERE aui_id=am_form_id AND aui_class_id='$adclass' AND aui_session='$session' ORDER BY am_position ASC");
        while($row = mysqli_fetch_array($resultprint)){
                $formid=$row['aui_id'];
                $result=$row['am_status'];
                // Result Status
                switch ($result) {
                    case "0":
                        $rStatus="NOT ASSIGNED";
                        break;
                    case "1":
                        $rStatus="ALLOWED";
                        break;
                    case "2":
                        $rStatus="WAITING";
                        break;
                    case "3":
                        $rStatus="NOT ALLOWED";
                        break;
                }
                ?>
                        <tr>
                            <td class="text-center" style="vertical-align:middle;" ><?php echo $i++;?></td>
                            <td class="text-center" style="vertical-align:middle;" ><?php echo $row['aui_form_no'];?></td>
                            <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_name'];?></td>
                            <td class="text-center" style="vertical-align:middle;" ><?php echo $row['am_mark'];?></td>
                            <td class="text-center" style="vertical-align:middle;" ><?php echo $row['am_position'];?></td>
                            <td class="text-center" style="vertical-align:middle;" ><?php echo "$rStatus";}?></td>
                        </tr>
                        <tfoot><th  class="text-center page-number" style="vertical-align:middle;" colspan="6"></th></tfoot>          
                    </table>
                </div>
            </div>
            <p class="text-left"><br> Head Master: </p>
        </div>
</div><!--end Container -->
