<?php
include_once 'database.php';
require_once 'studentClass.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

$dateID = $_GET['training'];
$date = $_GET['date'];

if(isset($date) && isset($dateID)) {
	studentClass::deleteAttendance($dateID, $date);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>