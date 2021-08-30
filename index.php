<?php
	include 'includes/header.php';
	echo "<title>Home</title>";

?>
</head>

<body id="active-admin-login">
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/nav.php');
		include("captcha.php");

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
		elseif (strpos($url, 'error=username-or-password')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Username or password is incorrect! 
				 </div>";
		}
		elseif (strpos($url, 'error=login')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Please Login! 
				 </div>";
		}
		elseif (strpos($url, 'error=captcha')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Captcha Not Matched! 
				 </div>";
		}
		elseif (strpos($url, 'register=success')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Successfully Registered Please Login! 
				 </div>";
		}
		
	?>
	<?php
		if(isset($_SESSION['username'])) {
			header ("Location: //localhost/assembly/assembly-dashboard/");
		} elseif(isset($_SESSION['department_username'])) {
			header("Location: //localhost/assembly/department-dashboard/");
		}
	?>
	<div class="shape"></div>
	<div class="main ">
		<section style="margin-top: 5%;">
			<div class="container ">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="login">
							<h4>Assembly Login</h4>
							<form class='form-horizontal' role="form" action='includes/assembly-login.inc.php'
								method='POST'><br>
								<div class='form-group'>
									<label class="col-sm-2 control-label">Username</label>
									<div class='col-sm-10'>
										<input type='text' class='form-control' id='username' name='username'
											required='required' autofocus>
									</div>
								</div>
								<div class='form-group'>
									<label class="col-sm-2 control-label">Password</label>
									<div class='col-sm-10'>
										<div class='button-inside'>
											<input type='password' id='passwordView' class='form-control' id='password'
												name='password' required='required'>
											<button type='button' onclick='changePwdView()'><i class='fa fa-eye'
													aria-hidden='true'></i></button>
										</div>
									</div>
								</div>
								<div class='form-group'>
									<label class="col-sm-2 control-label">Captcha</label>
									<div class='col-sm-4'>
										<input type='text' class='form-control' id='code' name='captcha_word'
											required='required' autocomplete="off">
									</div>
									<div class='col-sm-2'>
										<img src="captcha.png">
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-2'></div>
									<div class='col-sm-2'>
										<button type='submit' name='submit' class='btn btn-primary '>Login</button>
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</section>
	</div>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/footer.php');
	?>
</body>