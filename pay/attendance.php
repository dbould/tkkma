<?php
include_once 'database.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

$query =  mysql_query("SELECT * FROM students");

$row=mysql_fetch_assoc($query);
echo $row['student_firstname'];

?>

