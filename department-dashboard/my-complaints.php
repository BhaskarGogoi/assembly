<?php
	include 'includes/header.php';
	echo "<title>My Complaints</title>";

?>

</head>
<body>
	<?php
		include('includes/nav.php');

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
									<a href="register-complaint"><li>Register Complaint</li></a>
									<a href="my-complaints"><li class="active">My Complaints</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<h4>Complaints</h4><br>
								<?php
									$sql = "SELECT * FROM complaint INNER JOIN departments ON complaint.department_id = departments.dept_id WHERE username = '$_SESSION[department_username]' ORDER BY complaint_id desc ";
									$result = $conn->query($sql);
									if (mysqli_num_rows($result) > 0) {
										echo"
										<table class='table table-bordered table-striped'>
											<thead>
												<tr>
													<th>ID</th>
													<th>Subject</th>
													<th>Department</th>
													<th>Date</th>
													<th>Action</th>
												</tr>
											</thead>    
											<tbody>";												
												while($row = mysqli_fetch_assoc($result)) {
													echo "<tr>          
														<td>$row[complaint_id]</td> 
														<td>$row[complaint_subject]</td>
														<td>$row[dept_name]</td>      
														<td>$row[complaint_date]</td>      
														<td>
						                        			<form action='//localhost/assembly/department-dashboard/view-complaint' method='POST'>
						                        				<button type='submit' class='btn btn-default' name='submit' value='$row[complaint_id]'>View</button>
						                        			</form>
						                        		</td>     
													</tr>";
												}
												echo" 
											</tbody> 
										</table>";
									} else {
										echo "
											<h2>No Complaints Available!</h2>
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