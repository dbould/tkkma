<?php
include_once 'database.php';
require_once 'studentClass.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

if (isset($_POST['submitStudent'])) { // inserting information into form
	
	$addAttendance = studentClass::addStudent($_POST['firstname'], $_POST['lastname'], $_POST['belt'], $_POST['gender'],
	$_POST['dob'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['postcode'], $_POST['home'],
	$_POST['mobile'], $_POST['email'], $_POST['medical']);
	echo "Added";
	header("Location: index.php");		
}
?>
  
<h1>Add Student</h1>
    <?php echo "<a href='index.php' >Home</a>";	?>
    <form method="post" id="stats" action="newStudent.php">

        Firstname: <input type="text" name="firstname" /><br />
        Lastname: <input type="text" name="lastname" /><br />
        Belt: <input type="text" name="belt" /><br />
        Gender: 
        <select name="gender">
            <option name="male" is="male">Male</option>
            <option name="female" is="female">Female</option>
        </select><br />
        D.O.B: <input type="text" name="dob" placeholder="2015-01-01" /><br />
        Address1: <input type="text" name="addsress1" /><br />
        Address2: <input type="text" name="address2" /><br />
        City: <input type="text" name="city" /><br />
        Postcode: <input type="text" name="postcode" /><br />
        Home Phone: <input type="text" name="home" /><br />
        Mobie Phone: <input type="text" name="mobile" /><br />
        Email: <input type="text" name="email" /><br />
        Medical: <input type="text" name="medical" />
        <br /><input type="submit" name="submitStudent" value="Add Student" />

    </form>
