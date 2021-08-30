<?php
	include 'includes/header.php';
	echo "<title>Draft Questions</title>";
?>

</head>

<body>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/nav.php');

		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'delete=success')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Successfully deleted!
				 </div>";
		} elseif (strpos($url, 'delete=failed')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Unable to delete!
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
								<a href="raise-question">
									<li>Raise a question</li>
								</a>
								<a href="questions">
									<li>Questions</li>
								</a>
								<a href="draft-questions">
									<li class="active">Draft Questions</li>
								</a>
								<a href="answers">
									<li>View Answers</li>
								</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-12">
						<div class="List1">
							<?php

									$status = 'Draft'; //status: if answered or not or save as draft.
									$sql = "SELECT * FROM questions INNER JOIN departments ON questions.department = departments.dept_id INNER JOIN district ON questions.district = district.district_id WHERE status = ? ORDER BY q_id desc";
									//Create a prepared statement
									$stmt = mysqli_stmt_init($conn);
									//Prepare the prepared statement
									if (!mysqli_stmt_prepare($stmt, $sql)) {
										echo "Error loading the data.";
									} else {
										//Bind parameters to the placeholder
										mysqli_stmt_bind_param($stmt, "s", $status);
										//Run parameters inside database
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);

										if(mysqli_num_rows($result) > 0) {
											echo"
												<h4>Questions</h4><br>
												<table class='table table-bordered table-striped'>
													<thead>
														<tr>
															<th>ID</th>
															<th>Subject</th>
															<th>Department</th>
															<th>District</th>
															<th>Asked On</th>
															<th>Reply By</th>
															<th>Action</th>
														</tr>
													</thead>    
													<tbody>";
												
														while($row = mysqli_fetch_assoc($result)) {
															echo "<tr>          
																<td>$row[q_id]</td> 
																<td>$row[subject]</td>
																<td>$row[dept_name]</td>           
																<td>$row[district_name]</td>           
																<td>$row[askedOn]</td>      
																<td>$row[due_date]</td>      
																<td>
								                        			<form action='//localhost/assembly/assembly-dashboard/view-draft-question' method='POST' style = 'display: inline;'>
								                        				<button type='submit' class='btn btn-default' name='view' value='$row[q_id]'>View</button>
								                        			</form>
								                        			<form action='//localhost/assembly/assembly-dashboard/includes/draft-question-send.php' method='POST' style = 'display: inline;'>
								                        				<button type='submit' class='btn btn-danger' name='delete' value='$row[q_id]'>Delete</button>
								                        			</form>
								                        		</td>     
															</tr>";
														}
													echo"    
													</tbody> 
												</table>";
									} else {
										echo "
											<h2>No Draft Questions Available!</h2>
											<h6><span class='fa fa-ban'></span></h6>";
									} 
								}?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php
		} else {
			header ("Location: //localhost/assembly/index?error=login");
		}
	?>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/footer.php');
	?>
</body>