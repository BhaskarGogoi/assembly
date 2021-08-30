<?php
	include 'includes/header.php';
	echo "<title>Account</title>";

?>

</head>
<body>
	<?php
		include 'includes/nav.php';
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'ph-Changed')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 70px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Phone Number Changed!
				 </div>";
		}
		if (strpos($url, 'ph-Change-Error')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 70px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Something Went Wrong!
				 </div>";
		}

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
									<a href="account"><li class="active">Account</li></a>
									<a href="settings"><li>Settings</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<h4>Account Info</h4>
								<?php
									$dept_id = $_SESSION['dept_id'];
									$sql = "SELECT * FROM department_login INNER JOIN departments ON department_login.Dept_ID = departments.dept_id INNER JOIN district on district.district_id = department_login.District WHERE username = '$_SESSION[department_username]' ";
									$result = $conn->query($sql);
									$row = mysqli_fetch_assoc($result);

									echo "
									
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b>Username:</b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>
											$row[Username]
										</div>
									</div><br>
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b>E-mail:</b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>
											$row[Email]
										</div>
									</div><br>
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b>Department:</b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>
											$row[dept_name]
										</div>
									</div><br>
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b>District:</b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>
											$row[district_name]
										</div>
									</div><br>
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b>Phone No:</b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>
											<form action='includes/ph-number-change.php' method='POST'>
												<input type='text' name='ph_no' value='$row[ph_no]'>
												<button type='submit' name='phChange' value='$row[Username]'>Change</button>
											</form>
										</div>
									</div><br><br>";
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