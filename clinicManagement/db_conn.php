<?php  

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "db_clinique";
$conn = mysqli_connect($sname, $uname, $password, $db_name);
if (!$conn) {
	echo "Connection Failed!";
	exit();
}

$user = 'root';
$password = '';
$connection = new PDO( 'mysql:host=localhost;dbname=db_clinique', $user, $password );

?>