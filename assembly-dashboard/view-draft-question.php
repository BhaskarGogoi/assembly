<?php
	include 'includes/header.php';
	echo "<title>View Draft Question</title>";

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
									<a href="draft-questions"><li class="active">Draft Questions</li></a>
									<a href="answers"><li>View Answers</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<?php
									$q_id = $_POST['view'];
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
				                        	<form class='form-horizontal' action='includes/draft-question-send.php' method='POST' role='form'> 
				                        		<div class='form-group'> 
				                        			<label for='firstname' class='col-sm-2 control-label'>Subject <span class='asterisk'>*</span></label> 
				                        			<div class='col-sm-10'> 
				                        				<input type='text' class='form-control' id='subject' name='subject' autofocus value='$row[subject]'> 
				                        			</div> 
				                        		</div>
				                        		<div class='form-group'> 
				                        			<label for='firstname' class='col-sm-2 control-label'>Question <span class='asterisk'>*</span></label> 
				                        			<div class='col-sm-10'>
				                        				<textarea class='form-control' rows='7' id='question' name='question'>$row[question]</textarea>
				                        			</div> 
				                        		</div>
				                        		<div class='form-group'> 
				                        			<label for='firstname' class='col-sm-2 control-label'>Department <span class='asterisk'>*</span></label> 
				                        			<div class='col-sm-10'> 
				                        				<div class='form-control field-disable'>$row[dept_name]</div> 
				                        			</div> 
				                        		</div>
				                        		<div class='form-group'> 
				                        			<label for='firstname' class='col-sm-2 control-label'>District <span class='asterisk'>*</span></label> 
				                        			<div class='col-sm-10'> 
				                        				<div class='form-control field-disable'>$row[district_name]</div>
				                        			</div> 
				                        		</div>
				                        		<div class='form-group'> 
				                        			<label for='firstname' class='col-sm-2 control-label'>Asked By <span class='asterisk'>*</span></label> 
				                        			<div class='col-sm-10'>
				                        				<div class='form-control field-disable'>$row[firstname] $row[lastname]</div>
				                        			</div> 
				                        		</div>
				                        		<div class='form-group'> 
				                        			<label for='firstname' class='col-sm-2 control-label'>Assembly Session <span class='asterisk'>*</span></label> 
				                        			<div class='col-sm-10'>
				                        				<div class='form-control field-disable'>$row[session_title] - $row[session_year]</div>
				                        			</div> 
				                        		</div>
				                        		<div class='form-group'> 
				                        			<label class='col-sm-2 control-label'>Answer By <span class='asterisk'>*</span></label>
													<div class='col-sm-2'>          
														<select class='form-control' id='day' name='day' required='required'>
															<option value=''>Day</option>
															<option value='01'>01</option>
															<option value='02'>02</option>
															<option value='03'>03</option>
															<option value='04'>04</option>
															<option value='05'>05</option>
															<option value='06'>06</option>
															<option value='07'>07</option>
															<option value='08'>08</option>
															<option value='09'>09</option>
															<option value='10'>10</option>
															<option value='11'>11</option>
															<option value='12'>12</option>
															<option value='13'>13</option>
															<option value='14'>14</option>
															<option value='15'>15</option>
															<option value='16'>16</option>
															<option value='17'>17</option>
															<option value='18'>18</option>
															<option value='19'>19</option>
															<option value='20'>20</option>
															<option value='21'>21</option>
															<option value='22'>22</option>
															<option value='23'>23</option>
															<option value='24'>24</option>
															<option value='25'>25</option>
															<option value='26'>26</option>
															<option value='27'>27</option>
															<option value='28'>28</option>
															<option value='29'>29</option>
															<option value='30'>30</option>
															<option value='31'>31</option>											
														</select> 
													</div>
													<div class='col-sm-2'>          
														<select class='form-control' id='month' name='month' required='required'>
															<option value=''>Month</option>
															<option value='01'>Jan</option>
															<option value='02'>Feb</option>
															<option value='03'>Mar</option>
															<option value='04'>Apr</option>
															<option value='05'>May</option>
															<option value='06'>Jun</option>
															<option value='07'>Jul</option>
															<option value='08'>Aug</option>
															<option value='09'>Sep</option>
															<option value='10'>Oct</option>
															<option value='11'>Nov</option>
															<option value='12'>Dec</option>
														</select> 
													</div>
													<div class='col-sm-2'>          
														<select class='form-control' id='year' name='year' required='required'>
															<option value=''>Year</option>
															<option value='2019'>2019</option>
															<option value='2020'>2020</option>
															<option value='2021'>2021</option>
															<option value='2022'>2022</option>
															<option value='2023'>2023</option>
															<option value='2024'>2024</option>
															<option value='2025'>2025</option>
															<option value='2026'>2026</option>
															<option value='2027'>2027</option>
															<option value='2028'>2028</option>
															<option value='2029'>2029</option>
															<option value='2030'>2030</option>
															<option value='2031'>2031</option>
															<option value='2032'>2032</option>
															<option value='2033'>2033</option>
															<option value='2034'>2034</option>
															<option value='2035'>2035</option>										
														</select> 
													</div> 
							                    </div>
							                    <div class='form-group'>
													<div class='col-sm-2'></div>       
													<div class='col-sm-2'>          
														<button type='submit' name='send-draft' class='btn btn-primary inline' value='$q_id'>Send</button>    
													</div>    
												</div>
												<div class='form-group'>
													<div class='col-sm-2'></div>       
													<div class='col-sm-2'>          
														<span class='asterisk'>* fields are required.</span>											    
													</div>    
												</div>
				                        	</form>";
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