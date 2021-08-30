<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');
	if (isset($_POST['user'])) {

		$username = mysqli_real_escape_string($conn, $_POST['user']);

		$sql = "DELETE FROM department_login WHERE Username= '$username'";
		$result = $conn->query($sql);
		if ($result) {

			$sql = "DELETE FROM department_profile_settings WHERE dept_username = '$username'";
			$result = $conn->query($sql);

			if(result) {
				header ("Location:../view-users?delete=success");
				exit();
			} else {
				header ("Location:../view-user-details.php?error=delete");
				exit();
			}
			
		} else {
			header ("Location:../view-user-details.php?error=delete");
			exit();
		}		
	} else {
		header ("Location:../view-user-details.php?error=delete");
		exit();
	}	
?>