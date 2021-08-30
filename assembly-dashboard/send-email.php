<?php

	include 'includes/header.php';
	echo "<title>Send Email</title>";

?>

</head>
<body>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/nav.php');

		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'error=empty')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Enter Email Address!
				 </div>";
		} elseif (strpos($url, 'email=sent')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Email Successfully Sent!
				 </div>";
		} elseif (strpos($url, 'email=not-sent')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Email not sent. Please Try Again!
				 </div>";
		} elseif (strpos($url, 'email=invalid')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Invalid email!
				 </div>";
		}
		elseif (strpos($url, 'error=db')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Something went wrong. Try Again!
				 </div>";
		}

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
									<a href="index"><li>Raise a question</li></a>
									<a href="questions"><li>Questions</li></a>
									<a href="answers"><li>View Answers</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<?php
									$sql = "SELECT * FROM questions WHERE q_id = '$_SESSION[s_q_id]'";
			                        $result = $conn->query($sql);
			                        $row = mysqli_fetch_assoc($result);
			                        $status = $row['status'];	
			                        echo "<form class='form-horizontal' role='form' action='includes/send-mail-inc.php' method='POST'><br>
										<div class='form-group'>
											<label class='col-sm-2 control-label'>Email</label> 
											<div class='col-sm-10'>
												<input type='email' name='email' class='form-control' placeholder='you@example.com' required='required'/>
											</div> 
										</div>
										<div class='form-group'> 
											<div class='col-sm-offset-2 col-sm-10'> 
												<button type='submit' name='q_id' value='$_SESSION[s_q_id]' class='btn btn-primary'>Send</button> 
											</div> 
										</div>
									</form>";
				                ?>								
							</div>
						</div>
					</div>
				</div>
			</section>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="back-button">
								<?php
									$Q_ID =  $_SESSION['s_q_id'];
									echo"
									<form action='view-question' method='POST'>
										<button type='submit' name='submit' value='$Q_ID'><i class='fas fa-arrow-circle-left'></i> Back</button>";
								?>
								</form>
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