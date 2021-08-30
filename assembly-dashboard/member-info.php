<?php
	include 'includes/header.php';
	echo "<title>View Question</title>";

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
									<a href="index"><li>Raise a question</li></a>
									<a href="questions"><li>Questions</li></a>
									<a href="draft-questions"><li>Draft Questions</li></a>
									<a href="answers"><li>View Answers</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<?php
									$member_id = $_GET['memberID'];
									$sql = "SELECT * FROM member WHERE member_id = ?;";
									//Create a prepared statement
									$stmt = mysqli_stmt_init($conn);
									//Prepare the prepared statement
									if (!mysqli_stmt_prepare($stmt, $sql)) {
										echo "Error loading the data.";
									} else {
										//Bind parameters to the placeholder
										mysqli_stmt_bind_param($stmt, "s", $member_id);
										//Run parameters inside database
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);

										$row = mysqli_fetch_assoc($result);				 
				                        echo "
											<div class='row'>
												<div class='col-sm-2'><b>Name</b></div> 
												<div class='col-sm-10'>
													: $row[firstname] $row[lastname]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Party Affiliation</b></div> 
												<div class='col-sm-10'>
													: $row[party_affiliation] - $row[member_type]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Assembly Constituency Name</b></div> 
												<div class='col-sm-10'>
													: $row[assembly_constituency_name]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Total Questions Asked</b></div> 
												<div class='col-sm-10'>
													: $row[questions_asked]
												</div> 
											</div><br>";
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