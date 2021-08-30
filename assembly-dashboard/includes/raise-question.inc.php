<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');

	if(isset($_POST['submit'])) {

		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$assembly_q_no = mysqli_real_escape_string($conn, $_POST['q_no']);
		$file_no = mysqli_real_escape_string($conn, $_POST['file_no']);
		$question = mysqli_real_escape_string($conn, $_POST['question']);
		$to = mysqli_real_escape_string($conn, $_POST['to']);
		$assembly_session = mysqli_real_escape_string($conn, $_POST['session']);
		$askedBy = mysqli_real_escape_string($conn, $_POST['askedBy']);

		$dueDate = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$askedOn = date("d-m-Y");
		

		//-----Check if form datas are not filled-----
		if (empty($subject)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}
		if (empty($assembly_q_no)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}
		if (empty($file_no)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		if (empty($question)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		if (empty($to)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		} 

		if (empty($askedBy)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		} 

		if (empty($dueDate)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}
		if (empty($assembly_session)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		if (empty($askedOn)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}
		if (empty($_POST['district'])) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		//-----Check if form datas are not filled-----

		else {

			foreach($_POST['district'] as $district) {

           		 //-----inserting question into database-----
				$sql = "INSERT INTO questions (subject, assembly_question_no, file_no, question, member_name, department, district, session, askedOn, due_date, status)
				VALUES ('$subject', '$assembly_q_no', '$file_no', '$question','$askedBy', '$to', '$district', '$assembly_session', '$askedOn', '$dueDate', 'No')";
				$result = $conn->query($sql);

				$sql2 = "SELECT * FROM member WHERE member_id = '$askedBy'";
				$result2 = $conn->query($sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $questions_asked = $row2['questions_asked'];

                $total_questions = $questions_asked + 1;

                $sql3 = "UPDATE member SET questions_asked ='$total_questions' WHERE member_id = '$askedBy'";
                $result3 = $conn->query($sql3);

    		}

    		if($result) {

    			$sql = "SELECT * FROM department_login WHERE Dept_ID = '$to' AND District = '$district'";
                $result = $conn->query($sql);
                $row = mysqli_fetch_assoc($result);
                $username = $row['Username'];
                $ph_no = $row['ph_no'];

                //check user notification settings
                $sql2 = "SELECT * FROM department_profile_settings WHERE dept_username = '$username'";
                $result2 = $conn->query($sql2);
                $row2 = mysqli_fetch_assoc($result2);

                if($row2['sms_notification'] == 'On') {
                	$field = array(
					    "sender_id" => "FSTSMS",
					    "language" => "english",
					    "route" => "qt",
					    "numbers" => $ph_no,
					    "message" => "7444"
					);

					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_SSL_VERIFYHOST => 0,
					  CURLOPT_SSL_VERIFYPEER => 0,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => json_encode($field),
					  CURLOPT_HTTPHEADER => array(
					    "authorization: YOT8Bn1zaKDEchSPJsmAfZ6ij3qQNCe2ypoVlrFu9dGw50UbLRwcsqoF9HMNDgAB2leOTpnQKm50PE1v",
					    "cache-control: no-cache",
					    "accept: */*",
					    "content-type: application/json"
					  ),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
					  header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=sms");
					  exit();
					} else {
						//-----redirecting to home page-----
					  header ("Location: //localhost/assembly/assembly-dashboard/raise-question?status=sent");
					  exit();
					}
                } else {
                	header ("Location: //localhost/assembly/assembly-dashboard/raise-question?status=sent");
					 exit();
                }				
				
			} else {
				header ("Location: //localhost/assembly/assembly-dashboard/raise-question?status=not-sent");
				exit();
			}
		}

	} elseif (isset($_POST['draft'])){

		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$question = mysqli_real_escape_string($conn, $_POST['question']);
		$to = mysqli_real_escape_string($conn, $_POST['to']);
		$assembly_session = mysqli_real_escape_string($conn, $_POST['session']);
		$askedBy = mysqli_real_escape_string($conn, $_POST['askedBy']);

		$dueDate = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$askedOn = date("d-m-Y");
		

		//-----Check if form datas are not filled-----
		if (empty($subject)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		if (empty($question)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		if (empty($to)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		} 

		if (empty($askedBy)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		} 

		if (empty($dueDate)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}
		if (empty($assembly_session)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		if (empty($askedOn)) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}
		if (empty($_POST['district'])) {
			header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=empty");
			exit();
		}

		//-----Check if form datas are not filled-----
		else {

			foreach($_POST['district'] as $district) {

           		 //-----inserting question into database-----
				$sql = "INSERT INTO questions (subject, question, member_name, department, district, session, askedOn, due_date, status)
				VALUES ('$subject', '$question','$askedBy', '$to', '$district', '$assembly_session', '$askedOn', '$dueDate', 'Draft')";
				$result = $conn->query($sql);
    		}

    		if ($result) {
				header ("Location: //localhost/assembly/assembly-dashboard/raise-question?saved=draft");
				exit();
			} else {
				header ("Location: //localhost/assembly/assembly-dashboard/raise-question?error=not-saved");
				exit();
			}
		}
	}	
?>