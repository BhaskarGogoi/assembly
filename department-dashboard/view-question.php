<?php
	include 'includes/header.php';
	echo "<title>Question</title>";

?>
<script type="text/javascript">
	let viewPdf = false;

	function showInput() {
		if (viewPdf === false) {

			document.getElementById('inputfile').style.display = "block"; 
			document.getElementById('textinput').style.display = "none";
			viewPdf = true;

		} else if (viewPdf === true){
			document.getElementById('inputfile').style.display = "none"; 
			document.getElementById('textinput').style.display = "block";
			viewPdf = false;

		}


	}

	  function Validate()
	  {
	     var file =document.getElementById("ans_image").value;
	     var fileInput = document.getElementById('ans_image');
	     if(file!='')
	     {
	           var checkimg = file.toLowerCase();
	           if (!checkimg.match(/(\.jpg|\.JPG|\.jpeg|\.JPEG|\.pdf|\.PDF)$/)){ 
	              document.getElementById("error").innerHTML="This type of file is not allowed!";
	              fileInput.value = ''; 
	              return false;
	           } else {
	                document.getElementById("error").innerHTML="";
	                var img = document.getElementById("ans_image"); 
	                if(img.files[0].size >  500000) {
	                    document.getElementById("error").innerHTML="Max File Size 500 KB!";
	                    fileInput.value = '';
	                    return false;
	                } else{
	                    document.getElementById("error").innerHTML="";
	                    return true;
	                }
	            }
	      }
	  }
</script>
</head>
<body>
	<?php
		include 'includes/nav.php';

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
									<a href="new-questions"><li>New Questions</li></a>
									<a href="answered"><li> Answered</li></a>
									<a href="account"><li>Account</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<?php
									$q_id = $_POST['submit'];
									$sql = "SELECT * FROM questions INNER JOIN departments ON questions.department = departments.dept_id INNER JOIN assembly_session ON questions.session = assembly_session.session_id INNER JOIN member ON questions.member_name = member.member_id  WHERE q_id = '$q_id'";
			                        $result = $conn->query($sql);
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
											<div class='col-sm-2'><b>Asked By</b></div> 
											<div class='col-sm-10'>
												$row[firstname] $row[lastname]
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
										</div><br>
										<form action='includes/export-question-pdf' method='POST'  target='_blank'>
											<input type='text' name='q_id' value='$q_id' hidden='hidden'>
											<button type='submit' name='submit' class='btn btn-default'>Export to PDF</button>
										</form>";
				                ?>								
							</div>
						</div>
					</div>
				</div>
			</section>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="replySection">
								<?php
								if ($status == 'No') {
									echo"
									<form class='form-horizontal' role='form' action='includes/submit-answer.inc.php method='POST'>
										<div class='form-group'>
											<label class='col-sm-2 control-label'>Reply Via</label> 
											<div class='col-sm-10'> 
												<label class='checkbox-inline'> 
													<input type='radio' name='optionsRadiosinline' id='optionsRadios4' value='option2' checked onchange='showInput()'> Text 
												</label>
												<label class='checkbox-inline'>
													<input type='radio' name='optionsRadiosinline' id='optionsRadios3' value='option1' onchange='showInput()'> Upload Scanned Image
												</label>
											</div> 
										</div><br>
									</form>
									<form class='form-horizontal' role='form' action='includes/submit-answer.inc.php' method='POST' id='textinput'>
										<div class='form-group'>
											<label class='col-lg-2 control-label'>Reply <span class='asterisk'>*</span></label>
											<div class='col-sm-10'>
												<textarea class='form-control' rows='7' required='required' name='answer'></textarea>
											</div>
										</div>
										<div class='form-group'> 
											<div class='col-sm-offset-2 col-sm-10'> 
												<button type='submit' name='q_id' class='btn btn-primary' value='$row[q_id]'>Send</button>
											</div> 
										</div>
										<div class='form-group'>
											<div class='col-sm-2'></div>       
											<div class='col-sm-2'>          
												<span class='asterisk'>* fields are required.</span>											    
											</div>    
										</div>
									</form>
									<form class='form-horizontal' role='form' action='includes/submit-answer-image.inc.php' method='POST' enctype='multipart/form-data' id='inputfile'>
										<div class='form-group' >
											<label class='col-lg-2 control-label'>Reply <span class='asterisk'>*</span></label>
											<div class='col-sm-10'>
												<label for='inputfile' >File input</label> 
												<input type='file' name='ans_image' id='ans_image' required='required' onchange='return Validate()'><br>
												<b>Only .jpg or .jpeg or .pdf extensions are allowed!</b>
											</div>
										</div>
										<div class='form-group' >
											<label class='col-lg-2 control-label'></label>
											<div class='col-sm-10'>
												<b style='color: #ff0024'><div id='error'></div></b>
											</div>
										</div>
										<div class = 'form-group'> 
											<div class='col-sm-offset-2 col-sm-10'> 
												<button type='submit' name='q_id' class='btn btn-primary' value='$row[q_id]'>Send</button>
											</div> 
										</div>
										<div class='form-group'>
											<div class='col-sm-2'></div>       
											<div class='col-sm-2'>          
												<span class='asterisk'>* fields are required.</span>											    
											</div>    
										</div>
									</form>";
								} else {

									//getting anaswer form answer table

									$q_id = $_POST['submit'];
									$sql = "SELECT * FROM answers WHERE q_id = '$q_id'";
			                        $result = $conn->query($sql);
			                        $row = mysqli_fetch_assoc($result);

			                        $ans_type = $row['answer_type'];
			                        if ($ans_type == 'Image') {
			                        	echo "<b>Replied On: $row[submit_date]</b><br><br>
			                        		<div class = 'ans_image'>
												<img src='//localhost/assembly/img/answer/Answer$q_id.jpg'>
											</div><br><br>
											<a href='//localhost/assembly/img/answer/Answer$q_id.jpg'  target = '_blank'><button class='btn btn-primary'>Download</button></a>";
			                        }
			                        elseif ($ans_type == 'pdf') {
			                        	echo "<b>Replied On: $row[submit_date]</b><br><br>
			                        		<b>Answer Type: PDF</b><br><br>
											<a href='//localhost/assembly/img/answer/Answer303.pdf''  target = '_blank'><button class='btn btn-primary'>View</button></a>";
			                        } else {
									echo "<b>Answer:</b> $row[answer]<br><br>
										<b>Replied On: $row[submit_date]</b><br>";
									}
								}?>
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