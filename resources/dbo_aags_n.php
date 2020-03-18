<?Php
$host_name = "localhost";
$database = "lyceumsy_aags_n";		// Change your database nae
$username = "lyceumsy_root";		// Your database user id 
$password = "SJ.gKh*caI[f";			// Your password

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
$dbo -> exec('SET CHARACTER SET utf8');
$dbo -> exec('SET time_zone = \''.date_default_timezone_get().'\'');
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}


?>