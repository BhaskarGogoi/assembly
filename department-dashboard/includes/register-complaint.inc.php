<?php
	session_start();

	if (isset($_POST['submit'])) {

		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/db_connect.php');

		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$complaint = mysqli_real_escape_string($conn, $_POST['complaint']);
		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$submit_date = date("d-m-Y");

		$sql = "SELECT * FROM department_login WHERE username = '$_SESSION[department_username]' ";
		$result = $conn->query($sql);
		$row = mysqli_fetch_assoc($result);

		$username = $row['Username'];

		//-----Check if form datas are not filled-----

		if (empty($subject)) {
			header ("Location: ../register-complaint.php?error=empty");

			exit();
		}
		if (empty($complaint)) {
			header ("Location: ../register-complaint.php?error=empty");

			exit();
		}
		if (empty($department)) {
			header ("Location: ../register-complaint.php?error=empty");

			exit();
		}

		//-----End Check if form datas are not filled-----

		else {
			$sql = "INSERT INTO complaint (complaint_subject, complaint_details, department_id, username, complaint_date)
			VALUES ('$subject', '$complaint', '$department', '$username', '$submit_date')";
			$result = $conn->query($sql);

			if($result) {
				//-----redirecting to home page-----
				header ("Location: ../register-complaint?status=sent");
				exit();
			} else {
				header ("Location: ../register-complaint?status=not-sent");
				exit();
			}
		}
					
			
			
	} else {
		header ("Location: ../register-complaint.php?error=submit");
		exit();
	}	
?>