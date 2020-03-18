<?php include "../resources/db_aags_w.php" ;?>


<?php 
mysqli_query($link,  "INSERT INTO adm_security_mst (asec_session, asec_general_status, asec_mark_status, asec_result_status) VALUES ('2020' , '0', '1', '1', '1') ");
?>
