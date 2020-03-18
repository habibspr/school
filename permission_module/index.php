<?php include 'header.php';?>
<?php include 'nav-bar.php';?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="container">    
    <div id="addSecurityDatafile">
        <div id="updateSecurityDatafile">
            
            <div class="page-header text-center">
                <h2 style="color:red;"> Permission panel </h2>
            </div>
            
            <div class="panel panel-default ">
                
                <div class="panel panel-heading">
                    <h2>
                        <button class="btn btn-primary" name="Add_Data" onclick="loadDoc('permission_add_data_form.php', addSecurityFunction)" >Add Data</button>
                        <button class="btn btn-primary pull-right" name="Update_Data" onclick="loadDoc('permission_update_form.php', updateSecurityFunction)" >Update Data</button>
                    </h2>
                </div>
                
                <div class="panel panel-body">            
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">   
                            <tr>
                                <th class="text-center" style="vertical-align:middle;"># Serial no. </th>
                                <th class="text-center" style="vertical-align:middle;" > Module name </th>
                                <th class="text-center" style="vertical-align:middle;" > Permission Status </th>
                            </tr>
                            <?php
                            $Result_Security = mysqli_query($link, "SELECT * FROM permission_master ORDER BY pm_id ASC");
                            while ($row = mysqli_fetch_array($Result_Security)){?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?php echo $row['pm_id'];?></td>
                                <td class="text-left" style="vertical-align:middle;" ><?php echo $row['pm_module_name'];?></td>
                                <td class="text-center" style="vertical-align:middle;" >
                                    <?php $Permission_Status=$row['pm_permission']; if( $Permission_Status == 0 ) { $Permission_Status="Unlocked"; } else { $Permission_Status = "Locked"; } ?>
                                    <input data-toggle="toggle" data-on="<?php echo "$Permission_Status";?>" data-off="<?php echo "$Permission_Status";?>" data-onstyle="success" data-offstyle="danger" type="checkbox"></td>
                                
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
