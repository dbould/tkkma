<?php
include_once 'database.php';
require_once 'studentClass.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

if (isset($_POST['submitAttendance'])) { // inserting information into form
	if(!isset($_POST['studentID'])) {
		echo '<p>No Student Selected. Please Select a student</p>';
	}
	if(!isset($_POST['date'])) {
		echo '<p>No Date selected. You must enter a date</p>';
	}
	if(isset($_POST['studentID']) && isset($_POST['date']))
	{
		$ID = time();
		
		if (studentClass::checkDateExist($_POST['date']) == true) {
			echo "Sorry this date already exists";
		} else {
			$addAttendance = studentClass::addStudentAttendance($_POST['attended'], $_POST['studentID'], $_POST['date'], $ID);
			echo "updated";
			header("Location: index.php");		
		}
	}
}



?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="jquery-1.9.1.js"></script>
<script src="jquery-ui.js"></script>

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  
<h1>Add Attendance</h1>
    <?php
            $studentDetails = studentClass::getAllStudentDetails();
            echo "<a href='index.php' >Home</a>";	
            ?>
    <form method="post" id="stats" action="add_attendance.php">
        <br /><table class='player-stats-table' style="border: none;">
            <thead>
                <tr class='player-stats-head'>
                    <th>Student Name</th>
                    <th>Attended</th>
                </tr>
            </thead>
            <tbody>
				<tr>
					<p>Date: <input type="text" id="datepicker" name="date"></p>
            <?php
            foreach ($studentDetails as $details){
				   echo '<td>'.$details['student_firstname'].' ' .$details['student_lastname'].'</td>
					<td><select name="attended[]">
						<option value="0"></option>
						<option value="1">Yes</option>
					</select></td>
					<td><input type="hidden" name="studentID[]" value="'.$details['student_id'].'"/></td>
			  </tr></tbody>'."\n";
            }
            ?>
            <tr>
                <br /><td colspan="2"><input type="submit" name="submitAttendance" value="Add Attendance" /></td></tr>
        </table>
    </form>