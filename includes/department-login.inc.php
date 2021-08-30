<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/db_connect.php');


	if(isset($_POST['submit'])) {
		//-----Captcha-----
		$code = $_SESSION['captcha_word'];
		if ($_POST['captcha_word'] != $code) {
			header ("Location:../department-login?error=captcha");
			exit();
		} 
		//------End Captcha------

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn ,$_POST['password']);
		//-----Check if form datas are not filled-----

		if (empty($username)) {
			header ("Location:../department-login?error=empty");
			exit();
		}
		if (empty($password)) {
			header ("Location:../department-login?error=empty");
			exit();
		} 
		//-----Check if form datas are not filled-----

		//-----Check For Hash Password and Dehash-----

		$sql = "SELECT * FROM department_login WHERE Username = '$username'";
		$result = $conn->query($sql);
		$row = mysqli_fetch_assoc($result);
		$hash_password = $row['Password'];
		$dehash = password_verify($password, $hash_password);
		if ($dehash == 0) {
			header ("Location:../department-login?error=username-or-password");
			exit();
		}
		//-----End Check For Hash Password and Dehash-----

		else {

			//getting user-details
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			function getOS() { 
			    global $user_agent;
			    $os_platform  = "Unknown OS Platform";
			    $os_array     = array(
			                          '/windows nt 10/i'      =>  'Windows 10',
			                          '/windows nt 6.3/i'     =>  'Windows 8.1',
			                          '/windows nt 6.2/i'     =>  'Windows 8',
			                          '/windows nt 6.1/i'     =>  'Windows 7',
			                          '/windows nt 6.0/i'     =>  'Windows Vista',
			                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			                          '/windows nt 5.1/i'     =>  'Windows XP',
			                          '/windows xp/i'         =>  'Windows XP',
			                          '/windows nt 5.0/i'     =>  'Windows 2000',
			                          '/windows me/i'         =>  'Windows ME',
			                          '/win98/i'              =>  'Windows 98',
			                          '/win95/i'              =>  'Windows 95',
			                          '/win16/i'              =>  'Windows 3.11',
			                          '/macintosh|mac os x/i' =>  'Mac OS X',
			                          '/mac_powerpc/i'        =>  'Mac OS 9',
			                          '/linux/i'              =>  'Linux',
			                          '/ubuntu/i'             =>  'Ubuntu',
			                          '/iphone/i'             =>  'iPhone',
			                          '/ipod/i'               =>  'iPod',
			                          '/ipad/i'               =>  'iPad',
			                          '/android/i'            =>  'Android',
			                          '/blackberry/i'         =>  'BlackBerry',
			                          '/webos/i'              =>  'Mobile'
			                    );

			    foreach ($os_array as $regex => $value)
			        if (preg_match($regex, $user_agent))
			            $os_platform = $value;

			    return $os_platform;
			}

			function getBrowser() {
			    global $user_agent;
			    $browser        = "Unknown Browser";
			    $browser_array = array(
			                            '/msie/i'      => 'Internet Explorer',
			                            '/firefox/i'   => 'Firefox',
			                            '/safari/i'    => 'Safari',
			                            '/chrome/i'    => 'Chrome',
			                            '/edge/i'      => 'Edge',
			                            '/opera/i'     => 'Opera',
			                            '/netscape/i'  => 'Netscape',
			                            '/maxthon/i'   => 'Maxthon',
			                            '/konqueror/i' => 'Konqueror',
			                            '/mobile/i'    => 'Handheld Browser'
			                     );

			    foreach ($browser_array as $regex => $value)
			        if (preg_match($regex, $user_agent))
			            $browser = $value;

			    return $browser;
			}

			$user_os        = getOS();
			$user_browser   = getBrowser();

			// Function to get the client IP address
			function get_client_ip() {
			    $ipaddress = '';
			    if (getenv('HTTP_CLIENT_IP'))
			        $ipaddress = getenv('HTTP_CLIENT_IP');
			    else if(getenv('HTTP_X_FORWARDED_FOR'))
			        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			    else if(getenv('HTTP_X_FORWARDED'))
			        $ipaddress = getenv('HTTP_X_FORWARDED');
			    else if(getenv('HTTP_FORWARDED_FOR'))
			        $ipaddress = getenv('HTTP_FORWARDED_FOR');
			    else if(getenv('HTTP_FORWARDED'))
			       $ipaddress = getenv('HTTP_FORWARDED');
			    else if(getenv('REMOTE_ADDR'))
			        $ipaddress = getenv('REMOTE_ADDR');
			    else
			        $ipaddress = 'UNKNOWN';
			    return $ipaddress;
			}

			$clientIP = get_client_ip();
			$login_date = date("d-m-Y");

			//getting time
			date_default_timezone_set("Asia/Kolkata");
			$login_time = date("h:i:s a");


			//Create a template
			$sql = "SELECT * FROM department_login WHERE Username = ?  AND Password = ?; ";
			//Create a prepared statement
			$stmt = mysqli_stmt_init($conn);
			//Prepare the prepared statement
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header ("Location:../index?error=database");
					exit();
			} else {
				//Bind parameters to the placeholder
				mysqli_stmt_bind_param($stmt, "ss", $username, $hash_password);
				//Run parameters inside database
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);


				if (!$row = $result->fetch_assoc()) {
					header ("Location:../department-login?error=username-or-password");
					exit();
				} else {


					$sql = "INSERT INTO department_login_details (username, ip, operating_system, browser, date, time)
					VALUES ('$username', '$clientIP', '$user_os', '$user_browser', '$login_date', '$login_time')";
					$result = $conn->query($sql);

					if ($result) {
						$_SESSION['department_username'] = $row['Username'];
						$_SESSION['dept_id'] = $row['Dept_ID'];
						header ("Location: //localhost/assembly/department-dashboard/");
					} else {
						header ("Location: ../department-login?error=getting-login-details");
						exit();
					}
				}
			}
		}
	}
?>