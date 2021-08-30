<?php
	include 'includes/header.php';
	echo "<title>Dashboard</title>";

?>

</head>
<body>
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
									<a href="raise-question"><li class="active">Raise a question</li></a>
									<a href="questions"><li>Questions</li></a>
									<a href="draft-questions"><li>Draft Questions</li></a>
									<a href="answers"><li>View Answers</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="raiseQueston">
								<form class='form-horizontal' role="form" action='includes/raise-question.inc.php' method='POST'><br>
									<div class="form-group">
										<label class="col-sm-2 control-label">Subject <span class="asterisk">*</span></label> 
										<div class="col-sm-10">
											<input type="text" class="form-control" id='subject' name='subject' required="required" autofocus/>
										</div> 
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Assembly Question No <span class="asterisk">*</span></label> 
										<div class="col-sm-10">
											<input type="text" class="form-control"  name='q_no' required="required" autofocus/>
										</div> 
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Related File No <span class="asterisk">*</span></label> 
										<div class="col-sm-10">
											<input type="text" class="form-control" name='file_no' required="required" autofocus/>
										</div> 
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Question <span class="asterisk">*</span></label> 
										<div class="col-sm-10">
											<textarea class="form-control" rows="5" id='question' name='question' required="required"></textarea>
										</div> 
									</div>
									<div class='form-group'>  
										<label class="col-sm-2 control-label">To (Department) <span class="asterisk">*</span></label>      
										<div class='col-sm-10'> 
											<select class="form-control" id='to' name='to' required="required">
												<option value="">SELECT</option>
												<?php
												$sql = "SELECT * FROM departments";
												//Create a prepared statement
												$stmt = mysqli_stmt_init($conn);
												//Prepare the prepared statement
												if (!mysqli_stmt_prepare($stmt, $sql)) {
													echo "Error Loading The Data.";
												} else {
													//Bind parameters to the placeholder
													mysqli_stmt_bind_param($stmt);
													//Run parameters inside database
													mysqli_stmt_execute($stmt);
													$result = mysqli_stmt_get_result($stmt);
													while($row = mysqli_fetch_assoc($result)) {
														echo "<option value='$row[dept_id]'>$row[dept_name]</option>";}
												}
												?>
											</select>        
										</div>    
									</div>
									<div class='form-group'>  
										<label class="col-sm-2 control-label">District <span class="asterisk">*</span></label>      
										<div class='col-sm-10'> 
												
												<?php
												$sql = "SELECT * FROM district";
												$result = $conn->query($sql);
												while($row = mysqli_fetch_assoc($result)) {
													echo "<label class='checkbox-inline'> 
														<input type='checkbox' id='inlineCheckbox3' name = 'district[]' value='$row[district_id]'> $row[district_name]
													</label>";}
												?>											      
										</div>    
									</div>
									<div class='form-group'>  
										<label class="col-sm-2 control-label">Asked By <span class="asterisk">*</span></label>            
										<div class='col-sm-10'>
											<select class="form-control" id='askedBy' name='askedBy' required="required">
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
									<h3 id="show_result"></h3>
									<div class='form-group'>  
										<label class="col-sm-2 control-label">Session <span class="asterisk">*</span></label>            
										<div class='col-sm-10'>
											<select class="form-control" id='session' name='session' required="required">
												<option value="">SELECT</option>
												<?php
												$session_end_date = 'Live';
												$sql = "SELECT * FROM assembly_session WHERE session_end_date = ?;";
												//Create a prepared statement
												$stmt = mysqli_stmt_init($conn);
												//Prepare the prepared statement
												if (!mysqli_stmt_prepare($stmt, $sql)) {
													echo "Error Loading The Data.";
												} else {
													//Bind parameters to the placeholder
													mysqli_stmt_bind_param($stmt,"s", $session_end_date);
													//Run parameters inside database
													mysqli_stmt_execute($stmt);
													$result = mysqli_stmt_get_result($stmt);
													while($row = mysqli_fetch_assoc($result)) {
														echo "<option value='$row[session_id]'>$row[session_year] - $row[session_title]</option>";
													}
												}
												?>
											</select>  
										</div>    
									</div>
									<div class='form-group'>  
										<label class="col-sm-2 control-label">Submission By <span class="asterisk">*</span></label>
										<div class='col-sm-2'>          
											<select class="form-control" id='day' name='day' required="required">
												<option value="">Day</option>
												<option value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>											
											</select> 
										</div>
										<div class='col-sm-2'>          
											<select class="form-control" id='month' name='month' required="required">
												<option value="">Month</option>
												<option value="01">Jan</option>
												<option value="02">Feb</option>
												<option value="03">Mar</option>
												<option value="04">Apr</option>
												<option value="05">May</option>
												<option value="06">Jun</option>
												<option value="07">Jul</option>
												<option value="08">Aug</option>
												<option value="09">Sep</option>
												<option value="10">Oct</option>
												<option value="11">Nov</option>
												<option value="12">Dec</option>
											</select> 
										</div>
										<div class='col-sm-2'>          
											<select class="form-control" id='year' name='year' required="required">
												<option value="">Year</option>
												<option value="2019">2019</option>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
												<option value="2022">2022</option>
												<option value="2023">2023</option>
												<option value="2024">2024</option>
												<option value="2025">2025</option>
												<option value="2026">2026</option>
												<option value="2027">2027</option>
												<option value="2028">2028</option>
												<option value="2029">2029</option>
												<option value="2030">2030</option>
												<option value="2031">2031</option>
												<option value="2032">2032</option>
												<option value="2033">2033</option>
												<option value="2034">2034</option>
												<option value="2035">2035</option>										
											</select> 
										</div>    
									</div>
									<div class='form-group'>
										<div class='col-sm-2'></div>       
										<div class='col-sm-2'>          
											<button type='submit' name='submit' class='btn btn-primary inline'>Send</button>&nbsp; 
											<button type='submit' name='draft' class='btn btn-default inline'>Draft</button>    
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