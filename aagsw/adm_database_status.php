<?php include "../resources/db_aags_w.php" ;?>
<script type = "text/javascript" src = "admission_java_script.js"></script>
<?php 

if(date('m')>6){ 
    
    $Security_Session= date('Y')+1; 
    
}else{ 
    
    $Security_Session= date('Y'); 
    
}
$Security_Session_database=0;
$resultStatus = mysqli_query($link,  "SELECT * FROM adm_security_mst WHERE asec_session='$Security_Session' ");
    while($row = mysqli_fetch_array($resultStatus)){
        
        $Security_Session_database=$row['asec_session'];
        $General_Security_Status=$row['asec_general_status'];
        $Mark_Security_Status=$row['asec_mark_status'];
        $Result_Security_Status=$row['asec_result_status'];
       
    }

if ($Security_Session_database!=$Security_Session){?>
<span class="align-middle">
    <div class="alert alert-danger fade in text-center">
        <strong># Session : </strong><?php echo "$Security_Session";?> Not found !
        <br> This session is not ready, please contact the Author..
    </div>
</span>

<?php exit;} ?>
