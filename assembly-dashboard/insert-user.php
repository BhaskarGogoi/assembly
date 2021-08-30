<?php
	include 'includes/header.php';
	echo "<title>Insert Users</title>";

?>

<script type="text/javascript">
	function pwGenerate(length) {
		var result = '';
		var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		var charactersLength = characters.length;
		for (var i = 0; i < length; i++) {
			result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		document.getElementById("password").value = result;


	}
</script>

</head>

<body>
	<?php
		include 'includes/nav.php';

		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'error=empty')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Fill out all the fields! 
				 </div>";
		}
		elseif (strpos($url, 'email=invalid')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Invalid Email! 
				 </div>";
		}
		elseif (strpos($url, 'error=username')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Username already exists! 
				 </div>";
		}
		elseif (strpos($url, 'input=invalid')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Invalid Department Name! 
				 </div>";
		}
		elseif (strpos($url, 'error=email')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Email Alreday Exists! 
				 </div>";
		}
		elseif (strpos($url, 'insert=success')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					User Added Successfully!
				 </div>";
		}
		elseif (strpos($url, 'register=error')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Registration Failed!
				 </div>";
		}
	?>
	<?php
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
								<a href="insert-user">
									<li class="active">Insert User</li>
								</a>
								<a href="view-users">
									<li>View Users</li>
								</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-12">
						<div class="raiseQueston">
							<form class='form-horizontal' role="form" action='includes/add-user.inc.php' method='POST'>
								<br>

								<div class='form-group'>
									<label class="col-sm-2 control-label">Department<span
											class="asterisk">*</span></label>
									<div class='col-sm-10'>
										<select class="form-control" id='to' name='department' required="required">
											<option value="">SELECT</option>
											<?php
												$sql = "SELECT * FROM departments";
												//Create a prepared statement
												$stmt = mysqli_stmt_init($conn);
												//Prepare the prepared statement
												if (!mysqli_stmt_prepare($stmt, $sql)) {
													echo "Error Loading The Data.";
												} else {
													//Bind parameters to the placeholder
													mysqli_stmt_bind_param($stmt);
													//Run parameters inside database
													mysqli_stmt_execute($stmt);
													$result = mysqli_stmt_get_result($stmt);
													while($row = mysqli_fetch_assoc($result)) {
														echo "<option value='$row[dept_id]'>$row[dept_name]</option>";}
												}
												?>
										</select>
									</div>
								</div>
								<div class='form-group'>
									<label class="col-sm-2 control-label">District <span
											class="asterisk">*</span></label>
									<div class='col-sm-10'>
										<select class="form-control" id='to' name='district' required="required">
											<option value="">SELECT</option>
											<?php
												$sql = "SELECT * FROM district";
												//Create a prepared statement
												$stmt = mysqli_stmt_init($conn);
												//Prepare the prepared statement
												if (!mysqli_stmt_prepare($stmt, $sql)) {
													echo "Error Loading The Data.";
												} else {
													//Bind parameters to the placeholder
													mysqli_stmt_bind_param($stmt);
													//Run parameters inside database
													mysqli_stmt_execute($stmt);
													$result = mysqli_stmt_get_result($stmt);
													while($row = mysqli_fetch_assoc($result)) {
														echo "<option value='$row[district_id]'>$row[district_name]</option>";}
												}
												?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Email <span class="asterisk">*</span></label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id='email' name='email'
											required="required" autofocus />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Username <span
											class="asterisk">*</span></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id='username' name='username'
											required="required" autofocus />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Password <span
											class="asterisk">*</span></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id='password' name='password'
											required="required" readonly="readonly" autofocus />
									</div>
									<div class="col-sm-2">
										<button onclick='return pwGenerate(8)'
											class='btn btn-default inline'>Generate</button>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Phone No <span
											class="asterisk">*</span></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id='phNo' name='ph_no'
											required="required" autofocus />
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-2'></div>
									<div class='col-sm-2'>
										<button type='submit' name='submit' class='btn btn-primary inline'>Send</button>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-2'></div>
									<div class='col-sm-2'>
										<span class="asterisk">* fields are required.</span>
									</div>
								</div>
							</form>
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