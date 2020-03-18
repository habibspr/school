<?php include "header.php" ;?>
<?php include "nav-bar.php" ;?>

<div class="container contentlogin">
    
    <form class="form-horizontal"  name="form_login" method="post" action="adm_print_class_wise_student_list.php" role="form">        
        <div class="page-header text-center"><h3 class="text-center">STUDENT LIST</h3></div>
        
        <div class="row">
            <div class="form-group">                   
                <div class="input-group input-group-lg">
                    <span for="session" class="input-group-addon" id="sizing-addon1">Session :</span>
                    <select  class="form-control" id="session" data-mobile="true" name="session" aria-describedby="sizing-addon1">
                        <?php
    $sql="SELECT distinct aui_session FROM adm_user_info order by aui_session DESC"; 
    foreach ($link->query($sql) as $row){
        echo "<option value='$row[aui_session]'>$row[aui_session]</option>"; } ?>      
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">                   
                <div class="input-group input-group-lg">
                    <span for="adclass" class="input-group-addon" id="sizing-addon1">Class  :</span>
                    <select  class="form-control" id="adclass" data-mobile="true" name="adclass" aria-describedby="sizing-addon1">
                        <?php
    $sql="SELECT * FROM adm_class_mst"; 
    foreach ($link->query($sql) as $row){
        echo "<option value='$row[acm_id]'>$row[acm_name]</option>"; } ?>      
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">                   
                <div class="input-group input-group-lg">
                    <span for="adfmayment" class="input-group-addon" id="sizing-addon1">Payment :</span>
                    <select class="form-control" id="adfmayment" name="adfmayment" aria-describedby="sizing-addon1">
                        <option value="1">Paid</option>
                        <option value="0">Un Paid</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">          
                <button type="submit" name="Submit" class="btn btn-lg btn-block btn-primary glyphicon glyphicon-check"> Submit</button>
            </div>
        </div>
    </form>
    
</div>