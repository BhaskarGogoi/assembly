<?php
	include 'includes/header.php';
	echo "<title>View User Details</title>";

?>

</head>
<body>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/nav.php');

		if(isset($_SESSION['username'])) { ?>
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
									<a href="insert-user"><li>Insert User</li></a>
									<a href="view-users"><li class="active">View Users</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<?php
									$user = $_GET['user'];
									$sql = "SELECT * FROM department_login  INNER JOIN departments ON department_login.Dept_ID = departments.dept_id  INNER JOIN district ON district.district_id = department_login.District WHERE department_login.Username = ?;";
									//Create a prepared statement
									$stmt = mysqli_stmt_init($conn);
									//Prepare the prepared statement
									if (!mysqli_stmt_prepare($stmt, $sql)) {
										echo "Error loading the data.";
									} else {
										//Bind parameters to the placeholder
										mysqli_stmt_bind_param($stmt, "s", $user);
										//Run parameters inside database
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);

										$row = mysqli_fetch_assoc($result);
				                     
				                        echo "
											<div class='row'>
												<div class='col-sm-2'><b>User Id</b></div> 
												<div class='col-sm-10'>
													$row[ID]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Department</b></div> 
												<div class='col-sm-10'>
													$row[dept_name]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Username</b></div> 
												<div class='col-sm-10'>
													$row[Username]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Email</b></div> 
												<div class='col-sm-10'>
													$row[Email]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>District</b></div> 
												<div class='col-sm-10'>
													$row[district_name]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Phone No</b></div> 
												<div class='col-sm-10'>
													$row[ph_no]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Registered Date</b></div> 
												<div class='col-sm-10'>
													$row[registered_date]
												</div> 
											</div><br>
											<form action='includes/delete-user.php' method='POST'>
												<button type='submit' class='btn btn-default' name='user' value='$user'>Delete</button>
											</form>
											";
									}
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