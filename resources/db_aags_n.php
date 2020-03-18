<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect(
    "localhost", 
    "lyceumsy_root", 
    "SJ.gKh*caI[f", 
    "lyceumsy_aags_n"
    );
// Check connection
if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET SESSION collation_connection ='utf8_general_ci'");
?>