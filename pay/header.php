<?php
include_once 'database.php';
require_once 'studentClass.php';

?>
<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">  
<link rel="stylesheet" href="jquery.dataTables.css">  
<link rel="stylesheet" href="style.css"> 
<script src="jquery-1.11.1.min.js"></script>
<script src="jquery.dataTables.min.js"></script>

<script src="jquery-ui.js"></script>


<script>
  $(function() {
    $( "#accordion" ).accordion({
	active: false,
      collapsible: true
    });
  });
  </script>
  </head>
<body>

