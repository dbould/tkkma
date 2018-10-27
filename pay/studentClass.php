<?php
require 'database.php';

class studentClass {

	public static function getAllStudentDetails()
    {
        $studentDetails = array();

        $sql = mysql_query("SELECT student_id, student_firstname, student_lastname, student_belt,
                            student_gender, student_dob, student_address1, student_address2,
                            student_city, student_postcode, student_home, student_mobile,
                            student_email, student_medical, student_live FROM students
                            ORDER BY student_firstname") or die(mysql_error());

        while ($studentRow = mysql_fetch_assoc($sql)) {
            $studentDetails[] = array(
                'student_id' => $studentRow['student_id'],
                'student_firstname' => $studentRow['student_firstname'],
                'student_lastname' => $studentRow['student_lastname'],
                'student_belt' => $studentRow['student_belt'],
                'student_gender' => $studentRow['student_gender'],
                'student_dob' => $studentRow['student_dob'],
                'student_address1' => $studentRow['student_address1'],
                'student_address2' => $studentRow['student_address2'],
                'student_city' => $studentRow['student_city'],
                'student_postcode' => $studentRow['student_postcode'],
                'student_home' => $studentRow['student_home'],
                'student_mobile' => $studentRow['student_mobile'],
                'student_email' => $studentRow['student_email'],
                'student_medical' => $studentRow['student_medical'],
                'student_live' => $studentRow['student_live']
            );
        }
        return $studentDetails;
    }

	public static function addStudentAttendance($attended, $studentId, $date, $ID)
	{
		//$newDate = str_replace("/", "-", $date);
		//$newDate2 = self::reverse_date($newDate);

        for ($i = 0; $i < count($attended); $i++) {
            $selectsql = "INSERT INTO attendance(att_date, student_id, att_attendance, att_date_id) VALUES ('".$date."', $studentId[$i], $attended[$i], $ID);";
              mysql_query($selectsql) or die(mysql_error());
        }
    }

	public static function reverse_date($date)
	{
		return implode('-', array_reverse(
			explode('-', $date)
		));
	}

	public static function datepicker_date($date)
	{
		$newDate = str_replace("-", "/", $date);

		return implode('/', array_reverse(
			explode('/', $newDate)
		));
	}

	public function editStudentAttendance($attended, $studentId, $date, $dateID)
	{
        for ($i = 0; $i < count($studentId); $i++) {

					$studentExists = false;

					if ($attended[$i] == 1) {
							$studentExists = $this->checkEditStudent($studentId[$i], $dateID, $attended[$i]);
					}

					if ($studentExists) {
							$selectsql = "INSERT INTO attendance(att_date, student_id, att_attendance, att_date_id) VALUES ('".$date."', $studentId[$i], $attended[$i], $dateID);";
							mysql_query($selectsql) or die(mysql_error());
					} else {
							$selectsql = "UPDATE attendance SET att_date = '".$date."', student_id = $studentId[$i], att_attendance = $attended[$i] WHERE att_date_id = $dateID AND student_id = $studentId[$i]";
							mysql_query($selectsql);
					}
        }
  }

  private function checkEditStudent($studentId, $dateID, $attended)
  {
			$studentArray = array();
			$sql = mysql_query("SELECT count(students.student_id) as Count FROM students LEFT JOIN attendance ON(attendance.student_id = students.student_id) WHERE student_live = 1 AND students.student_id = ".$studentId." AND att_date_id = '".$dateID."'
															AND att_live = 1 ORDER BY students.student_firstname") or die(mysql_error());

					while ($studentRow = mysql_fetch_assoc($sql)) {
						$count = $studentRow['Count'];
					}

					if ($count == 0) {
							$studentArray['count'] = $count;
					}
      return $studentArray;
  }

	public function editPaid($month, $year, $dateID, $studentId, $paid)
	{
        for ($i = 0; $i < count($studentId); $i++) {

						$studentExists = false;

						if ($paid[$i] == 1) {
								$studentExists = $this->checkPaidStudent($studentId[$i], $dateID, $paid[$i]);
						}

						if ($studentExists) {
								$selectsql = "INSERT INTO paid(student_id, paid_month, paid_year, paid, paid_date_id) VALUES ($studentId[$i], '".$month."', '".$year."', $paid[$i], $dateID);";
								mysql_query($selectsql) or die(mysql_error());
						} else {
								$selectsql = "UPDATE paid SET student_id = $studentId[$i], paid_month = '".$month."', paid_year = '".$year."', paid = $paid[$i] WHERE paid_date_id = $dateID AND student_id = $studentId[$i]";
									mysql_query($selectsql);
						}
        }
  }

	private function checkPaidStudent($studentId, $dateID, $paid)
	{
			$studentArray = array();
			$sql = mysql_query("SELECT count(students.student_id) as Count FROM students LEFT JOIN paid ON(paid.student_id = students.student_id) WHERE student_live = 1 AND students.student_id = ".$studentId." AND paid_date_id = '".$dateID."'
															AND paid_live = 1 ORDER BY students.student_firstname") or die(mysql_error());

					while ($studentRow = mysql_fetch_assoc($sql)) {
						$count = $studentRow['Count'];
					}

					if ($count == 0) {
							$studentArray['count'] = $count;
					}
			return $studentArray;

	}

	public function getStudentAttendance($ID)
	{
		$attendanceDetails = array();
		$studentIDs = array();

		$sql = mysql_query("SELECT students.student_id, student_firstname, student_lastname, att_attendance, att_date, att_date_id
						FROM students LEFT JOIN attendance ON(attendance.student_id = students.student_id)
                    WHERE student_live = 1 AND att_date_id = '".$ID."' AND att_live = 1 ORDER BY students.student_firstname");

		while ($studentRow = mysql_fetch_assoc($sql)) {
		    $attendanceDetails[] = array(
		        'att_id' => $studentRow['student_id'],
		        'date' => $studentRow['att_date'],
			'dateId' => $studentRow['att_date_id'],
			'student_firstname' => $studentRow['student_firstname'],
			'student_lastname' => $studentRow['student_lastname'],
			'student_id' => $studentRow['student_id'],
		        'attendance' => $studentRow['att_attendance']
		    );
				$date = $studentRow['att_date'];
				$dateId = $studentRow['att_date_id'];
			$studentId[] = $studentRow['student_id'];
        	}

		$studentId = implode(",",$studentId);

		$sql = mysql_query("SELECT students.student_id, student_firstname, student_lastname
		FROM students WHERE student_live = 1 AND students.student_id NOT IN(".$studentId.") ORDER BY students.student_firstname");

		while ($studentRowNoDate = mysql_fetch_assoc($sql)) {
		    $attendanceDetails[] = array(
		        'att_id' => $studentRowNoDate['student_id'],
		        'date' => $date,
			'dateId' => $dateId ,
			'student_firstname' => $studentRowNoDate['student_firstname'],
			'student_lastname' => $studentRowNoDate['student_lastname'],
			'student_id' => $studentRowNoDate['student_id'],
		        'attendance' => "0"
		    );
		}

        return $attendanceDetails;
    }

	public static function getStudentPaid($ID)
	{
		$attendanceDetails = array();
		$studentIDs = array();

        $sql = mysql_query("SELECT students.student_id, student_firstname, student_lastname, paid, paid_month, paid_year
							FROM students JOIN paid ON(paid.student_id = students.student_id)
                            WHERE student_live = 1 AND paid_date_id = '".$ID."' AND paid_live = 1 ORDER BY students.student_firstname") or die(mysql_error());

        while ($studentRow = mysql_fetch_assoc($sql)) {
            $attendanceDetails[] = array(
                'att_id' => $studentRow['student_id'],
                'month' => $studentRow['paid_month'],
								'year' => $studentRow['paid_year'],
								'student_firstname' => $studentRow['student_firstname'],
								'student_lastname' => $studentRow['student_lastname'],
								'student_id' => $studentRow['student_id'],
                'paid' => $studentRow['paid']
            );
						$month = $studentRow['paid_month'];
						$year = $studentRow['paid_year'];
						$studentId[] = $studentRow['student_id'];
        }

					$studentId = implode(",",$studentId);

					$sql = mysql_query("SELECT students.student_id, student_firstname, student_lastname
					FROM students WHERE student_live = 1 AND students.student_id NOT IN(".$studentId.") ORDER BY students.student_firstname");

					while ($studentRowNoDate = mysql_fetch_assoc($sql)) {
							$attendanceDetails[] = array(
									'att_id' => $studentRowNoDate['student_id'],
									'month' => $month,
						'year' => $year,
						'student_firstname' => $studentRowNoDate['student_firstname'],
						'student_lastname' => $studentRowNoDate['student_lastname'],
						'student_id' => $studentRowNoDate['student_id'],
									'paid' => "0"
							);
					}

        return $attendanceDetails;
    }

	public static function getTrainingDate()
	{
		$dateDetails = array();

		$statement = mysql_real_escape_string($statement);
		$query = mysql_query("SELECT DISTINCT(att_date_id) as att_date_id, att_date FROM attendance ORDER BY att_date DESC") or die(mysql_error());

		while ($dateRow = mysql_fetch_assoc($query)) {
		   $dateDetails[] = array(
		        'att_date_id' => $dateRow['att_date_id'],
                'att_date' => $dateRow['att_date']
		   );
		}

		if (mysql_num_rows($query) == 0) {
		    echo 'No Dates created yet.';
		} else if (!$dateDetails) {
		    echo 'The date could not be displayed, please try again later.';
		} else {
		    return $dateDetails;
		}
	}


	public static function addPaid($month,$year,$ID,$studentId,$paid)
	{
        for ($i = 0; $i < count($paid); $i++) {
            $selectsql = "INSERT INTO paid(student_id, paid_month, paid_year, paid_date_id, paid) VALUES ($studentId[$i], '".$month."', '".$year."', $ID, $paid[$i]);";
              mysql_query($selectsql) or die(mysql_error());
        }

	}

	public static function getPaidDetails()
	{
		$paidDetails = array();

		$sql = mysql_query("SELECT DISTINCT(paid_date_id) as paid_date_id, paid_month, paid_year FROM paid WHERE paid_live = 1") or die(mysql_error());

        while ($paidRow = mysql_fetch_assoc($sql)) {
            $paidDetails[] = array(
			'paid_date_id' => $paidRow['paid_date_id'],
                'paid_month' => $paidRow['paid_month'],
				'paid_year' => $paidRow['paid_year']
            );
        }
        return $paidDetails;

	}

	public static function outstandingPaidMonths()
	{
		$html = "";

		$sql = mysql_query("SELECT student_firstname, student_lastname, paid_year, paid_month FROM students
					LEFT JOIN paid ON(paid.student_id = students.student_id) WHERE students.student_live = 1 AND paid.paid = 0 AND paid_live = 1 ORDER BY paid_year,paid_month");

		$html .="<h2>Outstanding Payments</h2>";

		while ($studentRow = mysql_fetch_assoc($sql)) {
			$html .= $studentRow['paid_month'] . " " . $studentRow['paid_year'] . ": " . $studentRow['student_firstname'] . " " . $studentRow['student_lastname'] . "<br />";
        }
		$html .= "<hr>";
		return $html;
	}

	public static function checkDateExist($date)
	{
		$sql = mysql_query("SELECT att_date FROM attendance WHERE att_date = '$date' AND att_live = 1");

		if(mysql_num_rows($sql) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public static function checkDateisCurrentDate($date)
	{
		$sql = mysql_query("SELECT att_date FROM attendance WHERE att_date = '$date' AND att_live = 1 LIMIT 1");

		while ($dateRow = mysql_fetch_assoc($sql)) {
				$dateDetails = $dateRow['att_date'];
        }
        return $dateDetails;
	}

	public static function deleteAttendance($dateId, $actualDate)
	{
		$dateId = (int)$dateId;
		$sql = mysql_query("UPDATE attendance SET att_live = 0 WHERE att_date_id = '$dateId' AND att_date = '$actualDate'");
	}

	public static function deletePaid($dateId, $month, $year)
	{
		$dateId = (int)$dateId;
		// update live column to 0 instead of delete, change other queries to checkIfDate exists to cjheck live = 1
		$sql = mysql_query("UPDATE paid SET paid_live = 0 WHERE paid_date_id = $dateId AND paid_month = '$month' AND paid_year = '$year'") or die(mysql_error());

	}

	public static function checkPaidDateExist($month, $year)
	{
		$sql = mysql_query("SELECT paid_id FROM paid WHERE paid_month = '$month' AND paid_year = '$year' AND paid_live = 1")  or die(mysql_error());

		if(mysql_num_rows($sql) > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function addStudent($firstname, $lastname, $belt, $gender, $dob, $address1, $address2, $city, $postcode, $home, $mobile, $email, $medical)
	{
		 mysql_query(
			"INSERT INTO students (student_firstname, student_lastname, student_belt, student_gender, student_dob,
			student_address1, student_address2, student_city, student_postcode, student_home, student_mobile,
			student_email, student_medical) VALUES ('" . $firstname . "', '" . $lastname . "', '
			" . $belt . "', '" . $gender . "', '" . $dob . "', '" . $address1 . "',
			'" . $address2 . "', '" . $city . "', '" . $postcode . "', '" . $home . "',
			'" . $mobile . "', '" . $email. "', '" . $medical . "')"
		);
	}

    public function editStudent($id, $firstname, $lastname, $belt, $gender, $dob, $address1, $address2, $city, $postcode, $home, $mobile, $email, $medical, $live)
    {
        mysql_query(
			"UPDATE students
                SET
                    student_firstname = '" . $firstname . "',
                    student_lastname = '" . $lastname . "',
                    student_belt = '" . $belt . "',
                    student_gender = '" . $gender . "',
                    student_dob = '" . $dob . "',
                    student_address1 = '" . $address1 . "',
                    student_address2 = '" . $address2 . "',
                    student_city = '" . $city . "',
                    student_postcode = '" . $postcode . "',
                    student_home = '" . $home . "',
                    student_mobile = '" . $mobile . "',
                    student_email = '" . $email . "',
                    student_medical = '" . $medical . "',
                    student_live = " . $live . "
                WHERE
                    student_id = $id"
		) or die(mysql_error());
    }

    public function getStudentDetails($id)
    {
        $studentDetails = array();

        $sql = mysql_query("SELECT
                                student_firstname,
                                student_lastname,
                                student_belt,
                                student_gender,
                                student_dob,
                                student_address1,
                                student_address2,
                                student_city,
                                student_postcode,
                                student_home,
                                student_mobile,
                                student_email,
                                student_medical,
                                student_live
							FROM
                                students
                            WHERE student_id = $id");

        while ($studentRow = mysql_fetch_assoc($sql)) {
            $studentDetails[] = array(
                'student_firstname' => $studentRow['student_firstname'],
                'student_lastname' => $studentRow['student_lastname'],
				'student_belt' => $studentRow['student_belt'],
				'student_gender' => $studentRow['student_gender'],
				'student_dob' => $studentRow['student_dob'],
				'student_address1' => $studentRow['student_address1'],
                'student_address2' => $studentRow['student_address2'],
                'student_city' => $studentRow['student_city'],
                'student_postcode' => $studentRow['student_postcode'],
                'student_home' => $studentRow['student_home'],
                'student_mobile' => $studentRow['student_mobile'],
                'student_email' => $studentRow['student_email'],
                'student_medical' => $studentRow['student_medical'],
                'student_live' => $studentRow['student_live']
            );
        }
        return $studentDetails;
    }
}




?>
