<?php
include_once 'database.php';
require_once 'studentClass.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

$studentID = $_GET['editId'];

if (isset($_POST['submitStudent'])) { // inserting information into form
	
	studentClass::editStudent($studentID, $_POST['firstname'], $_POST['lastname'], $_POST['belt'], $_POST['gender'],
	$_POST['dob'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['postcode'], $_POST['home'],
	$_POST['mobile'], $_POST['email'], $_POST['medical'], $_POST['live']);
	echo "Updated";
	header("Location: index.php");		
}

$studentDetails = studentClass::getStudentDetails($studentID);
?>
  
<h1>Edit Student</h1>
    <?php 
    echo "<a href='index.php' >Home</a>";
    $selectedText = ' selected="selected"';
    ?>
    <form method="post" id="stats" action="edit_student.php?editId=<?php echo $studentID; ?>">

    <?php foreach ($studentDetails as $student) { ?>
        Firstname: <input type="text" name="firstname" value='<?php echo $student['student_firstname']; ?>' /><br />
        Lastname: <input type="text" name="lastname" value='<?php echo $student['student_lastname']; ?>' /><br />
        Belt: <input type="text" name="belt"  value='<?php echo $student['student_belt']; ?>' /><br />
        Gender: 
        <select name="gender">
            <option name="male" <?php if ($student['student_gender'] == 'male') { echo $selectedText; } ?> is="male">Male</option>
            <option name="female" <?php if ($student['student_gender'] == 'female') { echo $selectedText; } ?> is="female">Female</option>
        </select><br />
        D.O.B: <input type="text" name="dob" placeholder="2015-01-01" value='<?php echo $student['student_dob']; ?>' /><br />
        Address1: <input type="text" name="addsress1" value='<?php echo $student['student_address1']; ?>' /><br />
        Address2: <input type="text" name="address2" value='<?php echo $student['student_address2']; ?>' /><br />
        City: <input type="text" name="city" value='<?php echo $student['student_city']; ?>' /><br />
        Postcode: <input type="text" name="postcode" value='<?php echo $student['student_postcode']; ?>' /><br />
        Home Phone: <input type="text" name="home" value='<?php echo $student['student_home']; ?>' /><br />
        Mobie Phone: <input type="text" name="mobile" value='<?php echo $student['student_mobile']; ?>' /><br />
        Email: <input type="text" name="email" value='<?php echo $student['student_email']; ?>' /><br />
        Medical: <input type="text" name="medical" value='<?php echo $student['student_medical']; ?>' /><br />
        Live: 
        <select name="live">
            <option value='1' <?php if ($student['student_live'] == 1) { echo $selectedText; } ?> is="male">Yes</option>
            <option value='0' <?php if ($student['student_live'] == 0) { echo $selectedText; } ?> is="female">No</option>
        </select><br />
        <br /><input type="submit" name="submitStudent" value="Update Student" />
    <?php } ?>
    </form>
