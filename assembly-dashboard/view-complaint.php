<?php
	include 'includes/header.php';
	echo "<title>View Complaints</title>";

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
									<a href="complaints"><li>Complaints</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<?php
									$c_id = $_POST['submit'];
									$sql = "SELECT * FROM complaint INNER JOIN departments ON complaint.complaint_id = departments.dept_id WHERE complaint.complaint_id = '$c_id'";
			                        $result = $conn->query($sql);
			                        $row = mysqli_fetch_assoc($result);
			                        echo "
										<div class='row'>
											<div class='col-sm-2'><b>Complaint ID</b></div> 
											<div class='col-sm-10'>
												$row[complaint_id]
											</div> 
										</div><br>
										<div class='row'>
											<div class='col-sm-2'><b>Subject</b></div> 
											<div class='col-sm-10'>
												<p style='line-height: 1.9em;'>$row[complaint_subject]</p>
											</div> 
										</div><br>
										<div class='row'>
											<div class='col-sm-2'><b>Complaint</b></div> 
											<div class='col-sm-10'>
												<p style='line-height: 1.9em;'>$row[complaint_details]</p>
											</div> 
										</div><br>
										<div class='row'>
											<div class='col-sm-2'><b>Department</b></div> 
											<div class='col-sm-10'>
												$row[dept_name]
											</div> 
										</div><br>
										<div class='row'>
											<div class='col-sm-2'><b>Date</b></div> 
											<div class='col-sm-10'>
												$row[complaint_date]
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
			header ("Location: //localhost/assembly/department-login?error=login");
		}
	?>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/footer.php');
	?>
</body>