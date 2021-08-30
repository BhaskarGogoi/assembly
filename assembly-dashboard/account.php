<?php
	include 'includes/header.php';
	echo "<title>Account</title>";
?>
</head>

<body id='active-account'>
	<?php
		include 'includes/nav.php';

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
								<a href="account">
									<li class='active'>Account</li>
								</a>
								<a href="log-info">
									<li>Log Info</li>
								</a>
								<a href="dept-log-info">
									<li>Department Log Info</li>
								</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-12">
						<div class="List1">
							<?php
									$sql = "SELECT * FROM assembly_login WHERE username = '$_SESSION[username]' ";
									$result = $conn->query($sql);
									$row = mysqli_fetch_assoc($result);

									echo "
									
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b>Username:</b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>
											$row[username]
										</div>
									</div><br>
									<div class='row'>
										<div class='col-lg-2 col-md-2 col-sm-2'>
											<b>E-mail:</b>
										</div>
										<div class='col-lg-8 col-md-8 col-sm-8'>
											$row[email]
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