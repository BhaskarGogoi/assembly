<?php
	session_start();
	include 'db_connect.php';

	if(isset($_POST['phChange'])) {

		$ph_no = mysqli_real_escape_string($conn, $_POST['ph_no']);	
		$username = mysqli_real_escape_string($conn, $_POST['phChange']);	


		//-----Check if form datas are not filled-----
		if (empty($username)) {
			header ("Location: //localhost/assembly/department-dashboard/account?error=empty");
			exit();
		}
		if (empty($ph_no)) {
			header ("Location: //localhost/assembly/department-dashboard/account?error=empty");
			exit();
		}

		//-----Check if form datas are not filled-----

		else {

			$sql = "UPDATE department_login SET ph_no = '$ph_no' WHERE Username = '$username'";
			$result = $conn->query($sql);


			if($result) {
				//-----redirecting to home page-----
				header ("Location: //localhost/assembly/department-dashboard/account?ph-Changed");
				exit();
			} else {
				header ("//localhost/assembly/department-dashboard/settings?ph-Change-Error");
				exit();
			}			
		}
	}	
?>