<?php
include_once 'header.php';
require_once 'class/Login.php';
require_once 'studentClass.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}
$studentDetailsClass = new studentClass();
$dateID = $_GET['training'];
$date = $_GET['date'];

if (isset($_POST['submitAttendance'])) { // inserting information into form
	if(!isset($_POST['studentID'])) {
		echo '<p>No Student Selected. Please Select a student</p>';
	}
	if(!isset($_POST['date'])) {
		echo '<p>No Date selected. You must enter a date</p>';
	}
	if(isset($_POST['studentID']) && isset($_POST['date'])) {

		if(studentClass::checkDateisCurrentDate($date ) == $_POST['date']) {
			$addAttendance = $studentDetailsClass->editStudentAttendance($_POST['attended'], $_POST['studentID'], $_POST['date'], $dateID);
			echo "updated";
			header("Location: index.php");
		}
		if (studentClass::checkDateExist($_POST['date']) == true) {
				echo "Sorry this date already exists";
		} else {
				$addAttendance = $studentDetailsClass->editStudentAttendance($_POST['attended'], $_POST['studentID'], $_POST['date'], $dateID);
				echo "updated";
				header("Location: index.php");
			}
	}
}
?>

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

<h1>Edit Attendance</h1>
    <?php
	$studentDetails = $studentDetailsClass->getStudentAttendance($dateID);

	echo "<a href='index.php' >Home</a>";
    echo "<form method='post' id='stats' action='edit_attendance.php?date=".$date."&training=".$dateID."'>";
	?>
        <br /><table class='player-stats-table' style="border: none;">
            <thead>
                <tr class='player-stats-head'>
                    <th>Student Name</th>
                    <th>Attended</th>
                </tr>
            </thead>
            <tbody>
				<tr>
					<p>Date: <input type="text" id="datepicker" name="date" value="<?php echo $date; ?>"></p>
            <?php
			$selectedText = ' selected="selected"';

            foreach ($studentDetails as $details){

				   echo '<td>'.$details['student_firstname'].' ' .$details['student_lastname'].'</td>
					<td><select name="attended[]">';
					?>
						<option value="0" <?php if ($details['attendance'] == 0) { echo $selectedText; } ?>>No</option>
						<option value="1" <?php if ($details['attendance'] == 1) { echo $selectedText; } ?>>Yes</option>
					<?php
					echo'</select></td>
					<td><input type="hidden" name="studentID[]" value="'.$details['student_id'].'"/></td>
			  </tr></tbody>'."\n";
            }
            ?>
            <tr>
                <br /><td colspan="2"><input type="submit" name="submitAttendance" value="Update Attendance" /></td></tr>
        </table>
    </form>
	<?php include_once 'footer.php'; ?>
