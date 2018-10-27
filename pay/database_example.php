<?php
ob_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
error_reporting(E_ALL ^ E_DEPRECATED);
$hostname_myconn = "localhost";
$database_myconn = "louandan_tkkma";
$username_myconn = "louandan_andy";
$password_myconn = "vkeKvVbAqvRb";
/*
try {
    $db = new PDO('mysql:host=localhost;dbname=louandan_tkkma', $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
*/


//$hostname_myconn = "192.168.20.50";
//$database_myconn = "andyels5_tkkma";
//$username_myconn = "root";
//$password_myconn = "";

// Create connection
$myconn = mysql_connect($hostname_myconn, $username_myconn, $password_myconn);

if ($myconn == FALSE) {
    echo 'Error connecting to database.';
    echo 'Reason: ' . mysql_error();
}
// Selects db
$db = mysql_select_db($database_myconn, $myconn);

if ($db == FALSE) {
    echo 'Error selecting the database.';
    echo 'Reason: ' . mysql_error();
}



?>