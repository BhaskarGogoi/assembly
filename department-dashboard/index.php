<?php
	include 'includes/header.php';
	echo "<title>Department Dashboard</title>";
?>

</head>
<body id="active-dashboard">
	<?php
		include('includes/nav.php');
	?>

	<?php		
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'submit=success')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 70px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Reply Successfully Sent!
				 </div>";
		}
	?>
	<?php
		if(isset($_SESSION['department_username'])) { ?>
		<div class="main">
			<section>
				<div class="container">
					<div class="row">
						<br><br>
					</div>
				</div>
			</section>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="dashboard_card">
									<div class="dashboard_card_icon">
				                      <span class="far fa-comment-alt"></span>
				                    </div>
				                    <h3><a href="new-questions">New Questions 
				                    		<div class="count">

				                    			<!--Question Count-->
				                    			<?php
				                    				$dept_id = $_SESSION['dept_id'];
				                    				$sql = "SELECT COUNT(*) as q_id FROM questions WHERE department  = '$dept_id' AND status = 'No'";
													$result = $conn->query($sql);
			                        				$row = mysqli_fetch_assoc($result);
			                        				echo $row['q_id'];
				                    			?>	
				                    			<!--End Question Count-->

				                    		</div>
				                    	</a>
				                    </h3>
			                    </div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="dashboard_card">
									<div class="dashboard_card_icon">
				                      <span class="fas fa-comment-alt"></span>
				                    </div>
				                    <h3><a href="answered">Answered</a></h3>
			                    </div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="dashboard_card">
									<div class="dashboard_card_icon">
				                      <span class="fa fa-desktop"></span>
				                    </div>
				                    <h3><a href="account">Account</a></h3>
			                    </div>
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