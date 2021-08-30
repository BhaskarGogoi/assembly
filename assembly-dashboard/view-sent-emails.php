<?php

	include 'includes/header.php';
	echo "<title>Sent Emails</title>";

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
									<a href="answers"><li>View Answers</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<h4>Sent Emails ID(s)</h4><br>

								<?php
									$sql = "SELECT * FROM sent_email WHERE q_id = '$_SESSION[s_q_id]'";
			                        $result = $conn->query($sql);
			                        if (mysqli_num_rows($result) > 0) {
				                        echo"	
				                        <table class='table table-bordered table-striped'>
											<thead>
												<tr>
													<th>Question ID</th>
													<th>Email</th>
													<th>Sent Date</th>
												</tr>
											</thead>    
											<tbody>"; 
												while($row = mysqli_fetch_assoc($result)) {
													echo "<tr>          
														<td>$row[q_id]</td> 
														<td>$row[email]</td>
														<td>$row[date]</td>          
													</tr>";
												} 
												echo"   
											</tbody> 
										</table>";
									} else {
										echo "No emails available";
									}
				                ?>								
							</div>
						</div>
					</div>
				</div>
			</section>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="back-button">
								<?php
									$Q_ID =  $_SESSION['s_q_id'];
									echo"
									<form action='view-question' method='POST'>
										<button type='submit' name='submit' value='$Q_ID'><i class='fas fa-arrow-circle-left'></i> Back</button>";
								?>
								</form>
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