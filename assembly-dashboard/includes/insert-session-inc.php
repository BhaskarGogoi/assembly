<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');

	if(isset($_POST['insert'])) {

		$session = mysqli_real_escape_string($conn, $_POST['session']);
		$day = mysqli_real_escape_string($conn, $_POST['day']);
		$month = mysqli_real_escape_string($conn, $_POST['month']);
		$year = mysqli_real_escape_string($conn, $_POST['year']);
		$start_date = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$session_title =  strtoupper("$session");	


		//-----Check if form datas are not filled-----
		if (empty($session)) {
			header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
			exit();
		} 
		if (empty($day)) {
			header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
			exit();
		}
		if (empty($month)) {
			header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
			exit();
		}
		if (empty($year)) {
			header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
			exit();
		}

		//-----Check if form datas are not filled-----

		else {

			//-----inserting question into database-----
			$sql = "INSERT INTO assembly_session (session_year, session_title, session_start_date)
			VALUES ('$year', '$session_title', '$start_date')";
			$result = $conn->query($sql);

			if($result) {
				//-----redirecting to home page-----
				header ("Location: //localhost/assembly/assembly-dashboard/sessions?insert=success");
				exit();
			} else {
				header ("Location: //localhost/assembly/assembly-dashboard/sessions?insert=fail");
				exit();
			}

			
		}
	} else {
		if(isset($_POST['end-session'])) {

			$session_id = mysqli_real_escape_string($conn, $_POST['session_id']);
			$day = mysqli_real_escape_string($conn, $_POST['day']);
			$month = mysqli_real_escape_string($conn, $_POST['month']);
			$year = mysqli_real_escape_string($conn, $_POST['year']);
			$end_date = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];

			//-----Check if form datas are not filled-----
			if (empty($session_id)) {
				header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
				exit();
			} 
			if (empty($day)) {
				header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
				exit();
			}
			if (empty($month)) {
				header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
				exit();
			}
			if (empty($year)) {
				header ("Location: //localhost/assembly/assembly-dashboard/sessions?error=empty");
				exit();
			}

			//-----Check if form datas are not filled-----

			else {

				//-----updating database-----

				$sql = "UPDATE assembly_session SET session_end_date = '$end_date' WHERE session_id = '$session_id'";
				$result = $conn->query($sql);

				if($result) {
					//-----redirecting to home page-----
					header ("Location: //localhost/assembly/assembly-dashboard/sessions?insert=success");
					exit();
				} else {
					header ("Location: //localhost/assembly/assembly-dashboard/sessions?insert=fail");
					exit();
				}

				
			}
		}
	}	
?>