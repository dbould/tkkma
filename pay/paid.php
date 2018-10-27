<?php
include_once 'header.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

if (isset($_POST['submitPaid'])) { // inserting information into form
	if(!isset($_POST['studentID'])) {
		echo '<p>No Student Selected. Please Select a student</p>';
	}
	if(isset($_POST['studentID']))
	{
		$ID = time();
		
		if (studentClass::checkPaidDateExist($_POST['month'], $_POST['year']) == true) {
			echo "Sorry this date already exists";
		} else {
			studentClass::addPaid($_POST['month'], $_POST['year'], $ID, $_POST['studentID'], $_POST['paid']);
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
  
<h1>Choose Team</h1>
    <?php
            $studentDetails = studentClass::getAllStudentDetails();
            echo "<a href='index.php' >Home</a>";	
            ?>
    <form method="post" id="stats" action="paid.php">
        <br /><table class='player-stats-table' style="border: none;">
            <thead>
                <tr class='player-stats-head'>
                    <th>Student Name</th>
                    <th>Paid</th>
                </tr>
            </thead>
            <tbody>
				<?php $months = array('Jan', 'Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec'); ?>
				<p>Month Year: </p>
					<select name="month">
						<?php
						foreach($months as $month)
						{
							echo "<option value='$month'>$month</option>";
						}
						?>
					</select>
					<select name="year">
						<?php 
						for($i=2009;$i<=2100;$i++)
						{
							$day = $i;
							echo "<option value='$day'>$day</option>";
						}
						?>
					</select>
					</br>
            <?php
            foreach ($studentDetails as $details){
				   echo '<td>'.$details['student_firstname'].' ' .$details['student_lastname'].'</td>
				   
					<td><select name="paid[]">
						<option value="0"></option>
						<option value="1">Yes</option>
					</select></td>
					
					
					<td><input type="hidden" name="studentID[]" value="'.$details['student_id'].'"/></td>
			  </tr></tbody>'."\n";
            }
            ?>
            <tr>
                <br /><td colspan="2"><input type="submit" name="submitPaid" value="Add Paid Month" /></td></tr>
        </table>
    </form>
	<?php include_once 'footer.php'; ?>