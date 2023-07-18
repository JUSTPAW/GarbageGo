
<?php

$sname= "localhost";
$unmae= "root"; 
// u457140180_garbagego    
$password ="";
// Garbagego2023
$db_name = "u457140180_garbagego";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}