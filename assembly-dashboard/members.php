<?php
	include 'includes/header.php';
	echo "<title>Members</title>";

?>

</head>
<body id='active-assembly-members'>
	<?php
		include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/nav.php');


		if(isset($_SESSION['username']) || isset($_SESSION['department_username'])) { ?>
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
						<div class="col-lg-12 col-md-12">
							<div class="List1">
								<h4>SPEAKER</h4><br>
									<h5 style="font-weight: bold; text-align: center; font-size: 16px;">Hitendra Nath Goswami</h5>
							</div>
						</div>
					</div>
				</div>
			</section><br><br>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="List1">
								<h4>BHARATIYA JANATA PARTY (BJP)</h4><br>
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Firstname</th>
											<th>Lastname</th>
											<th>Party Affiliation</th>
											<th>Constituency No</th>
											<th>Constituency Name</th>
											<th>Member Type</th>
										</tr>
									</thead>    
									<tbody> 
										<?php
											$sql = "SELECT * FROM member WHERE party_affiliation = 'BHARATIYA JANATA PARTY'";
											$result = $conn->query($sql);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<tr>          
													<td>$row[firstname]</td>          
													<td>$row[lastname]</td>          
													<td>$row[party_affiliation]</td>      
													<td>$row[assembly_constituency_no]</td>      
													<td>$row[assembly_constituency_name]</td>      
													<td>$row[member_type]</td>      
												</tr>";
											}
										?>    
									</tbody> 
								</table>
							</div>
						</div>
					</div>
				</div>
			</section><br><br>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="List1">
								<h4>INDIAN NATIONAL CONGRESS (INC)</h4><br>
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Firstname</th>
											<th>Lastname</th>
											<th>Party Affiliation</th>
											<th>Constituency No</th>
											<th>Constituency Name</th>
											<th>Member Type</th>
										</tr>
									</thead>    
									<tbody> 
										<?php
											$sql = "SELECT * FROM member WHERE party_affiliation = 'INDIAN NATIONAL CONGRESS'";
											$result = $conn->query($sql);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<tr>          
													<td>$row[firstname]</td>          
													<td>$row[lastname]</td>          
													<td>$row[party_affiliation]</td>      
													<td>$row[assembly_constituency_no]</td>      
													<td>$row[assembly_constituency_name]</td>      
													<td>$row[member_type]</td>      
												</tr>";
											}
										?>    
									</tbody> 
								</table>
							</div>
						</div>
					</div>
				</div>
			</section><br><br>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="List1">
								<h4>ASOM GANA PARISHAD (INC)</h4><br>
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Firstname</th>
											<th>Lastname</th>
											<th>Party Affiliation</th>
											<th>Constituency No</th>
											<th>Constituency Name</th>
											<th>Member Type</th>
										</tr>
									</thead>    
									<tbody> 
										<?php
											$sql = "SELECT * FROM member WHERE party_affiliation = 'ASOM GANA PARISHAD'";
											$result = $conn->query($sql);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<tr>          
													<td>$row[firstname]</td>          
													<td>$row[lastname]</td>          
													<td>$row[party_affiliation]</td>      
													<td>$row[assembly_constituency_no]</td>      
													<td>$row[assembly_constituency_name]</td>      
													<td>$row[member_type]</td>      
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