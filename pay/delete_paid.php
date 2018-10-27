<?php
include_once 'database.php';
require_once 'studentClass.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

$paidMonthId = $_GET['paidMonth'];
$month = $_GET['month'];
$year = $_GET['year'];

if(isset($paidMonthId) && isset($month) && isset($year)) {
	studentClass::deletePaid($paidMonthId, $month, $year);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>