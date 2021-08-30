<?php
	include 'includes/header.php';
	echo "<title>Dashboard</title>";

?>
</head>
<body id='active-dashboard'>
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
		elseif (strpos($url, 'error=sms')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Question Successfully Sent! <span style='color: red;'>But SMS Not Sent.</span>
				 </div>";
		}
		elseif (strpos($url, 'saved=draft')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Question Successfully Saved As Draft!
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
									<a href="raise-question"><li>Raise a question</li></a>
									<a href="questions"><li>Questions</li></a>
									<a href="draft-questions"><li>Draft Questions</li></a>
									<a href="answers"><li>View Answers</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">							
							<div class="card-strip">
								<div class="row">
									<div class="col-sm-3">
										<div class="card" style="background-color: #3498DB;">
											<h4>Questions Raised</h4>
											<?php
												$sql = "SELECT COUNT(*) as q_id FROM questions";
												$result = $conn->query($sql);
												$row = mysqli_fetch_assoc($result);
												echo "<h1>$row[q_id]</h1>";
											?>
											<div class="line"></div>
											<h5><a href="questions"> View Questions <i class="fas fa-arrow-circle-right"></i></a></h5>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-color: #EA7773;">
											<h4>Questions Answered</h4>
											<?php
												$sql = "SELECT COUNT(*) as ans_id FROM answers";
												$result = $conn->query($sql);
												$row = mysqli_fetch_assoc($result);
												echo "<h1>$row[ans_id]</h1>";
											?>
											<div class="line"></div>
											<h5><a href="answers"> View Answers <i class="fas fa-arrow-circle-right"></i></a></h5>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-color: #F3B431;">
											<h4>Unanswered Questions</h4>
											<?php
												$sql = "SELECT COUNT(*) as q_id FROM questions WHERE status = 'No'";
												$result = $conn->query($sql);
												$row = mysqli_fetch_assoc($result);
												echo "<h1>$row[q_id]</h1>";
											?>
											<div class="line"></div>
											<h5><a href="questions"> View Questions <i class="fas fa-arrow-circle-right"></i></a></h5>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-color: #F3B431;">
											<h4>Complaints</h4>
											<?php
												$sql = "SELECT COUNT(*) as complaint_id FROM complaint";
												$result = $conn->query($sql);
												$row = mysqli_fetch_assoc($result);
												echo "<h1>$row[complaint_id]</h1>";
											?>
											<div class="line"></div>
											<h5><a href="complaints"> View Complaints <i class="fas fa-arrow-circle-right"></i></a></h5>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="large-box">
										<h5>Top 5 Question Askers</h5>
										<ul>
											<?php
												$sql = "SELECT * FROM member ORDER BY questions_asked desc LIMIT 5";
												$result = $conn->query($sql);
												while($row = mysqli_fetch_assoc($result)) {
													echo "
													<li>
														$row[firstname] $row[lastname] <span>$row[questions_asked]</span><br>
														<h6>$row[member_type] - $row[assembly_constituency_name]</h6>
													</li>";
												}
											?>
										</ul>
									</div>								
								</div>
								<div class="col-sm-6">
									<div class="large-box">
										<h5>Member Wise Info</h5>
										<form class='form-horizontal' role='form' action='member-info.php' method='GET'><br>
										<div class='form-group'>            
											<div class='col-sm-12'>          
												<select class="form-control" id='askedBy' name='memberID' required="required">
												<option value="">SELECT</option>
												<?php
												$sql = "SELECT * FROM member";
												$result = $conn->query($sql);
												while($row = mysqli_fetch_assoc($result)) {
													echo "<option value='$row[member_id]'>$row[firstname] $row[lastname] - $row[member_type] - $row[assembly_constituency_name]</option>";}
												?>
											</select> 
											</div>   
										</div>
										<div class='form-group'> 
											<div class='col-sm-offset-2 col-sm-10'> 
												<button type='submit' name='memberInfo' class='btn btn-primary'>View</button> 
											</div> 
										</div>
									</form>
									</div>								
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