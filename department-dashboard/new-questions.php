<?php
	include 'includes/header.php';
	echo "<title>Questions</title>";

?>

</head>
<body>
	<?php
		include 'includes/nav.php';

		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'error=fileSize')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					File size too large!
				 </div>";
		}
		elseif (strpos($url, 'error=fileType')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					File type not allowed!
				 </div>";
		}
		elseif (strpos($url, 'error=uploading')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Error uploading the file!
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
									<a href="new-questions"><li class="active">New Questions</li></a>
									<a href="answered"><li>Answered</li></a>
									<a href="account"><li>Account</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<?php
									$dept_id = $_SESSION['dept_id'];
									$sql = "SELECT * FROM questions INNER JOIN member ON questions.member_name = member.member_id WHERE department  = '$dept_id' AND status = 'No' ORDER BY questions.q_id DESC";
									$result = $conn->query($sql);
									if (mysqli_num_rows($result) > 0) {
										echo"
										<h4>Questions</h4><br>
										<table class='table table-bordered table-striped'>
											<thead>
												<tr>
													<th>ID</th>
													<th>Subject</th>
													<th>Asked By</th>
													<th>Asked On</th>
													<th>Reply By</th>
													<th>View</th>
												</tr>
											</thead>    
											<tbody>"; 
												while($row = mysqli_fetch_assoc($result)) {
													echo "<tr>          
														<td>$row[q_id]</td> 
														<td>$row[subject]</td>     
														<td>$row[firstname] $row[lastname]</td>      
														<td>$row[askedOn]</td>      
														<td>$row[due_date]</td>       
														<td>
						                        			<form action='view-question' method='POST'>
						                        				<button type='submit' class='btn btn-default' name='submit' value='$row[q_id]'>View</button>
						                        			</form>
						                        		</td>     
													</tr>";}
											echo
											"</tbody> 
										</table>";
									} else {
										echo "
											<h2>No New Questions Available!</h2>
											<h6><span class='fa fa-ban'></span></h6>";
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