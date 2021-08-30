<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');

	if(isset($_POST['send-draft'])) {

		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$question = mysqli_real_escape_string($conn, $_POST['question']);
		$q_id = mysqli_real_escape_string($conn, $_POST['send-draft']);

		$dueDate = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$askedOn = date("d-m-Y");
		

		//-----Check if form datas are not filled-----
		if (empty($q_id)) {
			header ("Location: //localhost/assembly/assembly-dashboard/view-draft-question?error=something-went-wrong");
			exit();
		}
		if (empty($subject)) {
			header ("Location: //localhost/assembly/assembly-dashboard/view-draft-question?error=empty");
			exit();
		}

		if (empty($question)) {
			header ("Location: //localhost/assembly/assembly-dashboard/view-draft-question?error=empty");
			exit();
		}

		if (empty($dueDate)) {
			header ("Location: //localhost/assembly/assembly-dashboard/view-draft-question?error=empty");
			exit();
		}
		if (empty($askedOn)) {
			header ("Location: //localhost/assembly/assembly-dashboard/view-draft-question?error=empty");
			exit();
		}

		//-----Check if form datas are not filled-----

		else {

       		 //-----updating question in database-----
			$sql = "UPDATE questions SET subject='$subject', question = '$question', askedOn = '$askedOn', due_date = '$dueDate', status = 'No'  WHERE q_id= $q_id";
			$result = $conn->query($sql);

    		if($result) {
    			$sql = "SELECT * FROM questions WHERE q_id = '$q_id'";
                $result = $conn->query($sql);
                $row = mysqli_fetch_assoc($result);
                $department = $row['department'];
                $district = $row['district'];

    			$sql = "SELECT * FROM department_login WHERE Dept_ID = '$department' AND District = '$district'";
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
					  header ("Location: //localhost/assembly/assembly-dashboard/draft-questions?error=sms");
					  exit();
					} else {
						//-----redirecting to home page-----
					  header ("Location: //localhost/assembly/assembly-dashboard/draft-questions?status=sent");
					  exit();
					}
                } else {
                	header ("Location: //localhost/assembly/assembly-dashboard/draft-questions?status=sent");
					 exit();
                }				
				
			} else {
				header ("Location: //localhost/assembly/assembly-dashboard/view-draft-question?status=not-sent");
				exit();
			}
		}

	} elseif (isset($_POST['delete'])){

		$q_id = mysqli_real_escape_string($conn, $_POST['delete']);


		//-----Check if form datas are not filled-----
		if (empty($q_id)) {
			header ("Location: //localhost/assembly/assembly-dashboard/draft-questions?error=empty");
			exit();
		}

		else {

      		//-----inserting question into database-----
			$sql = "DELETE FROM questions WHERE q_id = $q_id";
			$result = $conn->query($sql);

    		if ($result) {
				header ("Location: //localhost/assembly/assembly-dashboard/draft-questions?delete=success");
			} else {
				header ("Location: //localhost/assembly/assembly-dashboard/index?delete=failed");
				exit();
			}
		}
	}	
?>