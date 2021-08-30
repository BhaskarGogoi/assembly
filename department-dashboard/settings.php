<?php
	include 'includes/header.php';
	echo "<title>Account</title>";

?>

</head>

<body>
	<?php
		include 'includes/nav.php';

		if(isset($_SESSION['department_username'])) { ?>
	<div class="main">
		<section>
			<div class="container">
				<div class="row">

				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2">
						<div class="asideMenuLeft">
							<h5>Menu <i class='fas fa-chevron-circle-down'></i></h5>
							<ul>
								<a href="account">
									<li>Account</li>
								</a>
								<a href="settings">
									<li class="active">Settings</li>
								</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-12">
						<div class="List1">
							<h4>Notification Settings</h4><br>
							<?php
									$dept_id = $_SESSION['dept_id'];
									$sql = "SELECT * FROM department_login INNER JOIN departments ON department_login.Dept_ID = departments.dept_id WHERE username = '$_SESSION[department_username]' ";
									$result = $conn->query($sql);
									$row = mysqli_fetch_assoc($result);

									$sql2 = "SELECT * FROM department_profile_settings WHERE dept_username = '$_SESSION[department_username]' ";
									$result2 = $conn->query($sql2);
									$row2 = mysqli_fetch_assoc($result2);

									echo "									
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b><i class='far fa-envelope'></i> &nbsp; Email Notification: </b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>";											
											if ($row2['email_notification'] == 'Off') {
												echo "
													<form action='includes/settings-change-inc.php' method = 'POST'> <b>Off</b> - 
														<button type='submit' name='emailOn' class='settings_button1' value='$row[Username]'>Turn On</button>
													</form>";
											} else {
												echo "
													<form action='includes/settings-change-inc.php' method = 'POST'> <b>On</b> -
														<button type='submit' name='emailOff' class='settings_button1' value='$row[Username]'>Turn Off</button>
													</form>";
											}
										echo"
										</div>
									</div><br>
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b><i class='fas fa-mobile-alt'></i> &nbsp; SMS Notification: </b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>";
											if ($row2['sms_notification'] == 'Off') {
												echo "
													<form action='includes/settings-change-inc.php' method = 'POST'> <b>Off</b> - 
														<button type='submit' name='smsOn' class='settings_button1' value='$row[Username]'>Turn On</button>
													</form>";
											} else {
												echo "
													<form action='includes/settings-change-inc.php' method = 'POST'> <b>On</b> - 
														<button type='submit' name='smsOff' class='settings_button1' value='$row[Username]'>Turn Off</button>
													</form>";
											}
										echo "
										</div>
									</div><br>";
								?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php
		} else{
			header ("Location: //localhost/assembly/index?error=login");
		}
	?>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/footer.php');
	?>
</body>