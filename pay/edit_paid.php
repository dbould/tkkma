<?php
include_once 'header.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

$student = new studentClass();
$dateId = $_GET['paidMonth'];
$actualMonth = $_GET['month'];
$actualYear = $_GET['year'];

if (isset($_POST['submitPay'])) { // inserting information into form
	if(!isset($_POST['studentID'])) {
		echo '<p>No Student Selected. Please Select a student</p>';
	}
	if(isset($_POST['studentID']))
	{
        $student->editPaid($_POST['month'], $_POST['year'], $dateId, $_POST['studentID'], $_POST['paid']);
        echo "updated";
        header("Location: index.php");
	}
}


?>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

<h1>Edit Pay</h1>
    <?php

            $studentDetails = studentClass::getStudentPaid($dateId);
            echo "<a href='index.php' >Home</a>";
            ?>
			<?php echo "<form method='post' id='edit' action='edit_paid.php?paidMonth=".$dateId."&month=".$actualMonth."&year=".$actualYear."'>"; ?>
        <br /><table class='player-stats-table' style="border: none;">
            <thead>
                <tr class='player-stats-head'>
                    <th>Student Name</th>
                    <th>Attended</th>
                </tr>
            </thead>
            <tbody>
				<?php $months = array('Jan', 'Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec'); ?>
				<p>Month Year: </p>
					<select name="month">
						<?php
						foreach ($months as $month) {
                            $selectedMonth = ($month == $actualMonth ? "selected='selected'" : "");
							echo "<option $selectedMonth value='$month'>$month</option>";
						}
						?>
					</select>
					<select name="year">
						<?php
						for($i=2009;$i<=2100;$i++) {
							$year = $i;
                            $selectedYear = ($year == $actualYear ? "selected='selected'" : "");
							echo "<option $selectedYear value='$year'>$year</option>";
						}
						?>
					</select>
					</br>
            <?php

			$selectedText = ' selected="selected"';

            foreach ($studentDetails as $details){
				   echo '<td>'.$details['student_firstname'].' ' .$details['student_lastname'].'</td>
					<td><select name="paid[]">';
					?>
						<option value="0" <?php if ($details['paid'] == 0) { echo $selectedText; } ?>>No</option>
						<option value="1" <?php if ($details['paid'] == 1) { echo $selectedText; } ?>>Yes</option>
					<?php
					echo'</select></td>
					<td><input type="hidden" name="studentID[]" value="'.$details['student_id'].'"/></td>
			  </tr></tbody>'."\n";
            }
            ?>
            <tr>
                <br /><td colspan="2"><input type="submit" name="submitPay" value="Update Pay" /></td></tr>
        </table>
    </form>
	<?php include_once 'footer.php'; ?>
