<?php
//start session 
session_start(); 

//Create constant to store non repeating values
define('SITEURL', 'http://localhost/hotpot/user/index.php');
define('LOCALHOST', 'localhost'); 
define('DB_EMAIL', 'root'); 
define('DB_PASSWORD', '');
define('DB_NAME', 'hotpot'); 


$conn = mysqli_connect(LOCALHOST, DB_EMAIL, DB_PASSWORD, DB_NAME) or die('Could not connect: ' . mysqli_connect_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Pass $conn as an argument to mysqli_error()

?>