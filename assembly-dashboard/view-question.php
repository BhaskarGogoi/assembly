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
									$q_id = $_GET['q_id'];
									$_SESSION['s_q_id'] = $q_id;
									$sql = "SELECT * FROM questions INNER JOIN assembly_session ON questions.session = assembly_session.session_id INNER JOIN member ON member.member_id = questions.member_name INNER JOIN departments ON departments.dept_id = questions.department INNER JOIN district ON questions.district = district.district_id WHERE questions.q_id = ?;";
									//Create a prepared statement
									$stmt = mysqli_stmt_init($conn);
									//Prepare the prepared statement
									if (!mysqli_stmt_prepare($stmt, $sql)) {
										echo "Error loading the data.";
									} else {
										//Bind parameters to the placeholder
										mysqli_stmt_bind_param($stmt, "s", $_SESSION['s_q_id']);
										//Run parameters inside database
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);

										$row = mysqli_fetch_assoc($result);
				                        $status = $row['status'];
				                        echo "
											<div class='row'>
												<div class='col-sm-2'><b>Subject</b></div> 
												<div class='col-sm-10'>
													$row[subject]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Assembly Question No</b></div> 
												<div class='col-sm-10'>
													$row[assembly_question_no]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>File No</b></div> 
												<div class='col-sm-10'>
													$row[file_no]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Question</b></div> 
												<div class='col-sm-10'>
													<p style='line-height: 1.9em;'>$row[question]</p>
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>To Department</b></div> 
												<div class='col-sm-10'>
													$row[dept_name]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>District</b></div> 
												<div class='col-sm-10'>
													$row[district_name]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Asked By</b></div> 
												<div class='col-sm-10'>
													$row[firstname] $row[lastname] - $row[member_type] - $row[assembly_constituency_name]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Assembly Session</b></div> 
												<div class='col-sm-10'>
													$row[session_title] - $row[session_year]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Asked Date</b></div> 
												<div class='col-sm-10'>
													$row[askedOn]
												</div> 
											</div><br>
											<div class='row'>
												<div class='col-sm-2'><b>Reply By</b></div> 
												<div class='col-sm-10'>
													$row[due_date]
												</div> 
											</div>";
									}
										// <div class='export_button'>
										// 	<form action = 'includes/export-question-pdf.php' method='POST'>
										// 		<button type='submit' class='btn btn-default' name='submit'>Export to PDF</button>
										// 	</form>
										// </div><br>";
				                ?>								
							</div>
						</div>
					</div>
				</div>
			</section>
			<section>
			<?php
				if ($status == 'Yes') { //Yes = Question was answered.
					echo "
					<div class='container'>
						<div class='row'>
							<div class='col-lg-12 col-md-12 col-sm-12'>
								<div class='replySection'>";
									$q_id = $_GET['q_id'];
									$sql = "SELECT * FROM answers WHERE q_id = '$q_id'";
				                    $result = $conn->query($sql);
				                    $row = mysqli_fetch_assoc($result);

				                    $ans_type = $row['answer_type'];

				                    if ($ans_type == 'jpg') {
				                    	echo "<b>Replied On: $row[submit_date]</b><br><br>
				                    		<div class = 'ans_image'>
												<img src='//localhost/assembly/img/answer/Answer$q_id.jpg'>
											</div><br><br>
											<a href='//localhost/assembly/img/answer/Answer$q_id.jpg' target = '_blank'><button class='btn btn-primary'>Download</button></a>";
				                    } 
				                     elseif ($ans_type == 'pdf') {
			                        	echo "<b>Replied On: $row[submit_date]</b><br><br>
			                        		<b>Answer Type: PDF</b><br><br>
											<a href='//localhost/assembly/img/answer/Answer303.pdf''  target = '_blank'><button class='btn btn-primary'>View</button></a>";
			                        }else {
									echo "<b>Answer:</b> $row[answer]<br><br>
										<b>Replied On: $row[submit_date]</b>";
									}
									echo"
								</div>
							</div>
						</div>
					</div>";
				} else { 
					echo"
					<div class='container'>
						<div class='row'>
							<div class='col-lg-12 col-md-12 col-sm-12'>
								<div class='view-questions-additional'>
								<ul>
									<li><a href='send-email'><button type='button' class='btn btn-primary'>Send to an email</button></a></li>
									<li><a href='view-sent-emails'><button type='button' class='btn btn-info'>View sent email id(s)</button></a></li>
									<li><form action='includes/export-question-pdf' method='POST'  target='_blank'>
										<input type='text' name='q_id' value='$q_id' hidden='hidden'>
										<button type='submit' name='submit' class='btn btn-default'>Export to PDF</button>
									</form></li>
								</ul>
									
								</div>
							</div>
						<div>
					</div>";
				}?>
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