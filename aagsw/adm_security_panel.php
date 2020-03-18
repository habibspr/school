<?php include 'header.php';?>
<?php include 'nav-bar.php';?>
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

<?php 
    if(empty($global_User)){    
        include_once "../authority_login.php";    
    exit;
    }
    ?>

<div class="container">    
    <div id="addSecurityDatafile">
        <div id="updateSecurityDatafile">
            
            <div class="page-header text-center">
                <h2> Security Update Panel </h2>
            </div>
            
            <div class="panel panel-default ">
                
                <div class="panel panel-heading">
                    <h2>
                        <button class="btn btn-primary" name="Add_Data" onclick="loadDoc('adm_add_security_data_form.php', addSecurityFunction)" >Add Data</button>
                        <button class="btn btn-primary pull-right" name="Update_Data" onclick="loadDoc('adm_security_update_form.php', updateSecurityFunction)" >Update Data</button>
                    </h2>
                </div>
                
                <div class="panel panel-body">            
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">   
                            <tr>
                                <th class="text-center" style="vertical-align:middle;"># Serial No. </th>
                                <th class="text-center" style="vertical-align:middle;" > Session </th>
                                <th class="text-center" style="vertical-align:middle;" > General Security Status </th>
                                <th class="text-center" style="vertical-align:middle;" > Mark Security Status </th>
                                <th class="text-center" style="vertical-align:middle;" > Result Security Status </th>
                            </tr>
                            <?php
                            $Counter=1;
                            $Result_Security = mysqli_query($link, "SELECT * FROM adm_security_mst ORDER BY asec_session DESC");
                            while ($row = mysqli_fetch_array($Result_Security)){?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $Counter++;?></td>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['asec_session'];?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php $Security_Status=$row['asec_general_status']; if($Security_Status==0){echo"Unlocked"; }else{echo "Locked";}  ?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php $Security_Status=$row['asec_mark_status']; if($Security_Status==0){echo"Unlocked"; }else{echo "Locked";}  ?></td>
                                <td class="text-center" style="vertical-align:middle;" ><?php $Security_Status=$row['asec_result_status']; if($Security_Status==0){echo"Unlocked"; }else{echo "Locked";} } ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
