<?php
// initialize session
session_start(); 
setcookie("PHPSESSID", " ", time() - 3600);
setcookie('phpsessid','value',time()- 1);
setcookie ("PHPSESSID", "", time() - 3600, "/", ".www.bristolbilbao.co.uk", 1);
header('Location: index.php');
// enough for FF
session_unset(); 
// IE needs both unset and destroy
session_destroy(); 
?>