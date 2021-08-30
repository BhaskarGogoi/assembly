<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');

	if(isset($_POST['submit'])) {

		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$dept_name =  strtoupper("$department");
		$inserted_date = date("d-m-Y");
		

		//-----Check if form datas are not filled-----
		if (empty($department)) {
			header ("Location: //localhost/assembly/assembly-dashboard/index?error=empty");
			exit();
		}

		//-----Check if form datas are not filled-----

		else {

			//-----inserting question into database-----
			$sql = "INSERT INTO departments (dept_name, inserted_date)
			VALUES ('$dept_name', '$inserted_date')";
			$result = $conn->query($sql);

			if($result) {
				//-----redirecting to home page-----
				header ("Location: //localhost/assembly/assembly-dashboard/departments?insert=success");
				exit();
			} else {
				header ("Location: //localhost/assembly/assembly-dashboard/departments?insert=fail");
				exit();
			}

			
		}
	}	
?>