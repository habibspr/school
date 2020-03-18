<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include '../aagsn/header.php';?>
<?php include '../nav-bar.php';?>
<script>
    function loadDoc(url, cFunction) {
        var xhttp;
        xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                cFunction(this);
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }
    function addSecurityFunction(xhttp) {
        document.getElementById("addSecurityDatafile").innerHTML =
            xhttp.responseText;
    }
    function updateSecurityFunction(xhttp) {
        document.getElementById("updateSecurityDatafile").innerHTML =
            xhttp.responseText;
    }
</script>

<div class="container">    
    <div id="addSecurityDatafile">
        <div id="updateSecurityDatafile">
            
            <div class="page-header text-center">
                <h2> Attendance Setup Panel </h2>
            </div>
            
            <div class="panel panel-default ">
                
                <div class="panel panel-heading">
                    <h2>
                        <button class="btn btn-primary" name="Add_Data" onclick="loadDoc('atdn_add_attendance_settings_form.php', addSecurityFunction)" >Add Data</button>
                        <button class="btn btn-primary pull-right" name="Update_Data" onclick="loadDoc('atdn_update_attendance_settings_form.php', updateSecurityFunction)" >Update Data</button>
                    </h2>
                </div>
                
                <div class="panel panel-body">            
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">   
                            <tr>
                                <th class="text-center" style="vertical-align:middle;"># Serial No. </th>
                                <th class="text-center" style="vertical-align:middle;" > Session </th>
                                <th class="text-center" style="vertical-align:middle;" > Category </th>
                                <th class="text-center" style="vertical-align:middle;" > Date From </th>
                                <th class="text-center" style="vertical-align:middle;" > In Time </th>
                                <th class="text-center" style="vertical-align:middle;" > Out Time </th>
                                <th class="text-center" style="vertical-align:middle;" > Fine </th>
                            </tr>
                            <?php
                            $Counter=1;
                            $Result_Security = mysqli_query($link, "SELECT * FROM attendance_settings_mst ORDER BY asm_session DESC, asm_start_date DESC");
                            while ($row = mysqli_fetch_array($Result_Security)){?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $Counter++;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['asm_session'];?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php $Security_Status=$row['asm_category']; if($Security_Status==0){ echo"Teacher"; }else{ echo "Student"; }?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php echo $row['asm_start_date']; ?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php echo $row['asm_intime']; ?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php echo $row['asm_outtime']; ?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php  echo "Tk. " .$row['asm_fine']; } ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
