<?php
	session_start();

	if (isset($_POST['submit'])) {

		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/db_connect.php');

		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$district = mysqli_real_escape_string($conn, $_POST['district']);
		$ph_no = mysqli_real_escape_string($conn, $_POST['ph_no']);
		$registered_date = date("d-m-Y");

		//-----Check if form datas are not filled-----

		if (empty($department)) {
			header ("Location: ../insert-user.php?error=empty");

			exit();
		}
		if (empty($email)) {
			header ("Location: ../insert-user.php?error=empty");

			exit();
		} 
		if (empty($username)) {
			header ("Location: ../insert-user.php?error=empty");

			exit();
		} if (empty($password)) {
			header ("Location: ../insert-user.php?error=empty");

			exit();
		} if (empty($district)) {
			header ("Location: ../insert-user.php?error=empty");

			exit();
		}
		if (empty($ph_no)) {
			header ("Location: ../insert-user.php?error=empty");

			exit();
		}

		//-----End Check if form datas are not filled-----

		else {
			//check if the characters are valid
			if (!preg_match("/^[a-zA-Z0-9 ]*$/", $department)) {
				header ("Location: ../insert-user.php?input=invalid");

				exit();
			} else {
				//check if email is valid
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header ("Location: ../insert-user.php?email=invalid");
					exit();
				}
				else {
					//-----Check if email or username is already exists----- 
					$sql = "SELECT * FROM department_login WHERE Email = '$email'";
					$result = $conn->query($sql);
					$emailCheck = mysqli_num_rows($result);

					$sql = "SELECT * FROM department_login WHERE username = '$username'";
					$result = $conn->query($sql);
					$usernameCheck = mysqli_num_rows($result);

					if ($emailCheck > 0) {
						header ("Location: ../insert-user.php?error=email");
						exit();
					}
					elseif ($usernameCheck > 0) {
						header ("Location: ../insert-user.php?error=username");
						exit();

					}
					//-----End Check if email or username is already exists-----
					else {
							$encrypted_password = password_hash($password, PASSWORD_DEFAULT); //hashing password
							$sql = "INSERT INTO department_login (Dept_ID, Email, Username, Password,  ph_no, District, registered_date)
							VALUES ('$department', '$email', '$username', '$encrypted_password','$ph_no', '$district', '$registered_date')";
							$result = $conn->query($sql);

							if ($result) {
								$sql = "SELECT * FROM department_login WHERE Username = '$username'";
		                        $result2 = $conn->query($sql);
		                        $row = mysqli_fetch_assoc($result2);
		                        $username = $row['Username'];


								$sql3 = "INSERT INTO department_profile_settings (dept_username)
								VALUES ('$username')";
								$result3 = $conn->query($sql3);

								if ($result3) {
									header ("Location: ../insert-user.php?insert=success");
								} else {
									header ("Location: ../insert-user.php?register=error");
								}
							} else{
								header ("Location: ../insert-user.php?register=error");
							}
						}
					}
				}
			}
	} else {
		header ("Location:../insert-user.php");
		exit();
	}	
?>