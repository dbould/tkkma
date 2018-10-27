<?php
include_once 'header.php';
require_once 'class/Login.php';

if (!login::isLoggedIn()) {
    login::redirectTo('index');
}

?>
<a href="logout.php">Logout</a>
<div id="accordion">
	<h3>Attendance</h3>
	<div>		
		<a href="add_attendance.php">Add Attendance</a><br /><br />
        <script>
            $(document).ready(function() {
                $('#attendance').DataTable();
            } );
        </script>
		<?php	

		$dateDetails = studentClass::getTrainingDate();

        echo "<table id='attendance' class='display' cellspacing='1'>";
        echo "<thead>
            <tr>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>";
        echo "<tfoot>
            <tr>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>";
        echo "<tbody>";
        
		foreach ($dateDetails as $date){         
            echo "<tr>";
			echo "<td>" . $date['att_date'] . "</td>";
			echo "<td><a href='edit_attendance.php?date=".$date['att_date']."&training=".$date['att_date_id']."'>Edit</a></td>";
			echo "<td><a href='delete_attendance.php?date=".$date['att_date']."&training=".$date['att_date_id']."'>Delete</a></td>";
            echo "</tr>";
		}
        
        echo "</tbody>
                </table>"; 
		?>
	</div>
	<h3>Pay</h3>
	<div>
		<a href="paid.php">Add Paid Months</a><br /><br />
        <script>
            $(document).ready(function() {
                $('#paid').DataTable();
            } );
        </script>
		<?php 

		$paidDetails = studentClass::getPaidDetails();
        
        echo "<table id='paid' class='display' cellspacing='1'>";
        echo "<thead>
            <tr>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>";
        echo "<tfoot>
            <tr>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>";
        echo "<tbody>";

		foreach ($paidDetails as $paid){
            echo "<tr>";
			echo "<td>" . $paid['paid_month']. "  ".$paid['paid_year'] . "</td>";
			echo "<td><a href='edit_paid.php?paidMonth=".$paid['paid_date_id']."&month=".$paid['paid_month']."&year=".$paid['paid_year']."'>Edit</a></td>";
			echo "<td><a href='delete_paid.php?paidMonth=".$paid['paid_date_id']."&month=".$paid['paid_month']."&year=".$paid['paid_year']."'>Delete</a></td>";
			echo "</tr>";
		} 
         echo "</tbody>
                </table>"; 
		?>
	</div>
	<h3>Outstanding Payments</h3>
	<div>
		<?php echo studentClass::outstandingPaidMonths(); ?>
	</div>
	<h3>Current Students</h3>
	<div>
        <script>
            $(document).ready(function() {
                $('#students').DataTable();
            } );
        </script>
        <?php
		$studentDetails = studentClass::getAllStudentDetails();

        echo "<table id='students' class='display' cellspacing='1'>";
        echo "<thead>
            <tr>
                <th>Name</th>
                <th>Belt</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>City</th>
                <th>Home</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Medical</th>
                <th>Live</th>
                <th>Options</th>
            </tr>
        </thead>";
        echo "<tfoot>
            <tr>
                <th>Name</th>
                <th>Belt</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>City</th>
                <th>Home</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Medical</th>
                <th>Live</th>
                <th>Options</th>
            </tr>
        </tfoot>";
        echo "<tbody>";
        
		foreach ($studentDetails as $details){
            $studentId = $details['student_id'];
            echo "<tr>";
			echo "<td>" . $details['student_firstname'] . ' ' . $details['student_lastname'] .'</td>';
			echo "<td>" . $details['student_belt'] .' </td>';
			echo "<td>" . $details['student_gender'] .' </td>';
			echo "<td>" . $details['student_dob'] .' </td>';
			echo "<td>" . $details['student_address1'] .' </td>';
			echo "<td>" . $details['student_address2'] .' </td>';
			echo "<td>" . $details['student_city'] .' </td>';
			echo "<td>" . $details['student_postcode'] .' </td>';
			echo "<td>" . $details['student_home'] .' </td>';
			echo "<td>" . $details['student_mobile'] .' </td>';
			echo "<td>" . $details['student_email'] .' </td>';
			echo "<td>" . $details['student_medical'] .' </td>';
            if ($details['student_live'] == 1) {
                $studentLive = "Live";
            } else {
                $studentLive = "Not Live";
            }
			echo "<td>" . $studentLive .' </td>';
			echo "<td><a href='edit_student.php?editId=$studentId'>Edit</a></td>";
            echo "</tr>";
		}
        
        echo "</tbody>
                </table>";     
	echo "<a href='newStudent.php'>Add a student</a>";
        ?>

	</div>
	<h3>Days Attended This Month</h3>
	<div>
		<a href="days_attendance.php">Days Attended This Month</a><br />
	</div>
</div>

<?php include_once 'footer.php'; ?>
