<?php
	include 'includes/header.php';
	echo "<title>Departments</title>";

?>

</head>
<body>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/nav.php');
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'error=empty')!== false) {
			echo "
				<div class='alert  alert-danger alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Enter Department Name!
				 </div>";
		} elseif (strpos($url, 'insert=success')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Successfully Inserted!
				 </div>";
		} elseif (strpos($url, 'insert=fail')!== false) {
			echo "
				<div class='alert  alert-success alert-dismissable' style='width: 395px; margin: 0 auto; margin-top: 20px;'>    
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
						&times;
					</button>    
					Something Went Wrong!
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
								<h5>Insert <i class='fas fa-chevron-circle-down'></i></h5>
								<ul>
									<a href="index"><li>Assembly Member</li></a>
									<a href="departments"><li class="active">Departments</li></a>
									<a href="sessions"><li>Sessions</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<h4>Insert New Department</h4><br>
								<form class='form-horizontal' role='form' action='includes/insert-department-inc.php' method='POST'><br>
									<div class='form-group'>
										<label class='col-sm-2 control-label'>Department Name</label> 
										<div class='col-sm-10'>
											<input type='text' name='department' class='form-control' required='required' autocomplete="off" />
										</div> 
									</div>
									<div class='form-group'> 
										<div class='col-sm-offset-2 col-sm-10'> 
											<button type='submit' name='submit' class='btn btn-primary'>Insert</button> 
										</div> 
									</div>
								</form>
							</div><br>
							<div class="List1">
								<h4>Departments</h4><br>
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Department Name</th>
											<th>Inserted Date</th>
											
										</tr>
									</thead>    
									<tbody> 
										<?php
											$sql = "SELECT * FROM departments ORDER BY dept_name asc";
											$result = $conn->query($sql);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<tr>          
													<td>$row[dept_name]</td>      
													<td>$row[inserted_date]</td>													     
												</tr>";
											}
										?>    
									</tbody> 
								</table>
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