<?php
	include 'includes/header.php';
	echo "<title>Register Complaint</title>";

?>

</head>
<body id='active-complaint'>
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
		elseif (strpos($url, 'status=sent')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Question Successfully Sent! 
				 </div>";
		}
	?>
	<?php
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
									<a href="register-complaint"><li class="active">Register Complaint</li></a>
									<a href="my-complaints"><li>My Complaints</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="raiseQueston">
								<form class='form-horizontal' role="form" action='includes/register-complaint.inc.php' method='POST'><br>
									<div class="form-group">
										<label class="col-sm-2 control-label">Subject <span class="asterisk">*</span></label> 
										<div class="col-sm-10">
											<input type="text" class="form-control" id='subject' name='subject' required="required"/>
										</div> 
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Complaint <span class="asterisk">*</span></label> 
										<div class="col-sm-10">
											<textarea class="form-control" rows="10" id='complaint' name='complaint' required="required"></textarea>
										</div> 
									</div>
									<div class='form-group'>  
										<label class="col-sm-2 control-label">Department <span class="asterisk">*</span></label>      
										<div class='col-sm-10'> 
											<select class="form-control" id='to' name='department' required="required">
												<?php
													$sql = "SELECT * FROM departments WHERE dept_id = '$_SESSION[dept_id]'";
													$result = $conn->query($sql);
													$row = mysqli_fetch_assoc($result);
													echo "<option value='$row[dept_id]'>$row[dept_name]</option>";
												?>
											</select>        
										</div>    
									</div>
									<div class='form-group'>
										<div class='col-sm-2'></div>       
										<div class='col-sm-2'>          
											<button type='submit' name='submit' class='btn btn-primary'>Send</button>    
										</div>    
									</div>
									<div class='form-group'>
										<div class='col-sm-2'></div>       
										<div class='col-sm-2'>          
											<span class="asterisk">* fields are required.</span>											    
										</div>    
									</div>
								</form>


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