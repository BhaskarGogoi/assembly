<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');

	if(isset($_POST['smsOn'])) {

		$username = mysqli_real_escape_string($conn, $_POST['smsOn']);	


		//-----Check if form datas are not filled-----
		if (empty($username)) {
			header ("Location: //localhost/assembly/department-dashboard/settings?error");
			exit();
		}

		//-----Check if form datas are not filled-----

		else {

			$sql = "UPDATE department_profile_settings SET sms_notification = 'On' WHERE dept_username = '$username'";
			$result = $conn->query($sql);


			if($result) {
				//-----redirecting to home page-----
				header ("Location: //localhost/assembly/department-dashboard/settings?SMS-Changed");
				exit();
			} else {
				header ("//localhost/assembly/department-dashboard/settings?SMS-Changed-Error");
				exit();
			}

			
		}
	} else {
		if (isset($_POST['smsOff'])) {

			$username = mysqli_real_escape_string($conn, $_POST['smsOff']);	


			//-----Check if form datas are not filled-----
			if (empty($username)) {
				header ("Location: //localhost/assembly/department-dashboard/settings?error");
				exit();
			}

			//-----Check if form datas are not filled-----

			else {

				$sql = "UPDATE department_profile_settings SET sms_notification = 'Off' WHERE dept_username = '$username'";
				$result = $conn->query($sql);


				if($result) {
					//-----redirecting to home page-----
					header ("Location: //localhost/assembly/department-dashboard/settings?SMS-Changed");
					exit();
				} else {
					header ("//localhost/assembly/department-dashboard/settings?SMS-Changed-Error");
					exit();
				}				
			}
		} else {
			if (isset($_POST['emailOff'])) {

				$username = mysqli_real_escape_string($conn, $_POST['emailOff']);	


				//-----Check if form datas are not filled-----
				if (empty($username)) {
					header ("Location: //localhost/assembly/department-dashboard/settings?error");
					exit();
				}

				//-----Check if form datas are not filled-----

				else {

					$sql = "UPDATE department_profile_settings SET email_notification = 'Off' WHERE dept_username = '$username'";
					$result = $conn->query($sql);


					if($result) {
						//-----redirecting to home page-----
						header ("Location: //localhost/assembly/department-dashboard/settings?email-Changed");
						exit();
					} else {
						header ("//localhost/assembly/department-dashboard/settings?email-Changed-Error");
						exit();
					}				
				}
			} else {
				if (isset($_POST['emailOn'])) {

					$username = mysqli_real_escape_string($conn, $_POST['emailOn']);	


					//-----Check if form datas are not filled-----
					if (empty($username)) {
						header ("Location: //localhost/assembly/department-dashboard/settings?error");
						exit();
					}

					//-----Check if form datas are not filled-----

					else {

						$sql = "UPDATE department_profile_settings SET email_notification = 'On' WHERE dept_username = '$username'";
						$result = $conn->query($sql);


						if($result) {
							//-----redirecting to home page-----
							header ("Location: //localhost/assembly/department-dashboard/settings?email-Changed");
							exit();
						} else {
							header ("//localhost/assembly/department-dashboard/settings?email-Changed-Error");
							exit();
						}				
					}
				}
			}
		}
	}	
?>