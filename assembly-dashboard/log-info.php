<?php
	include 'includes/header.php';
	echo "<title>Log Info</title>";


	function connect(){
		$conn = mysqli_connect("localhost", "root", "", "assembly");

		if (!$conn) {
			die("Connection Failed: ".mysqli_connect_error());
		}
		return $conn;
	} 
	

	function get_row_count() {
		$conn = connect();
		$sql = "SELECT COUNT(*) as row FROM assembly_login_details";
		$result = $conn->query($sql);
		$row = mysqli_fetch_assoc($result);
		return $row['row'];
	}

	function pagination () {
		
		$page_number = (isset($_GET['page']) AND !empty($_GET['page'])) ? $_GET['page']:1;
		$per_page_records = 20;
		$rows = get_row_count();
		$last_page = ceil($rows/$per_page_records); //round up
		$pagination_button = ceil($rows/$per_page_records);

		if ($pagination_button >= 10) {
			$pagination_button = 10;
		} else {
			$pagination_button = $pagination_button -1;
		}
		$pagination = '';
		$pagination .= '<nav arial-label="">';
		$pagination .= '<ul class = "pagination">';

		if ($page_number < 1) {
			$page_number = 1;
		} else if ($page_number > $last_page){
			$page_number = $last_page;
		}



		echo '<h3> Showing Page: '.$page_number.' / '.$last_page.'</h3>';
		

		$half = floor($pagination_button/2); 

		if ($page_number < $pagination_button AND ($last_page == $pagination_button OR $last_page > $pagination_button)) {

			for($i =1; $i<=$pagination_button; $i++) {

				if ($i == $page_number) {
					$pagination .= '<li class = "active"><a href = "log-info.php?page='.$i.'">'.$i.'<span class = "sr-only">(current)</span></a></li>';
				} else {
					$pagination .= '<li><a href="log-info.php?page='.$i.'">'.$i.'</a></li>';
				}
			}

			if ($last_page > $pagination_button) {
				$pagination .= '<li><a href = "log-info.php?page='.($pagination_button+1).'">&raquo;</a></li>';
			}

		} elseif ($page_number >= $pagination_button AND $last_page > $pagination_button){

			if(($page_number+$half) >= $last_page) {

				$pagination .= '<li><a href = "log-info.php?page='.($last_page - $pagination_button).'">&laquo;</a></li>'; //problem

				for ($i = ($last_page-$pagination_button)+1; $i<= $last_page; $i++){

					if ($i == $page_number) {
						$pagination .= '<li class="active"><a href = "log-info.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
					} else {
						$pagination .= '<li><a href ="log-info.php?page='.$i.'">'.$i.'</a></li>';
					}
				}
			} else if (($page_number+$half) < $last_page){
				$pagination .= '<li><a href = "log-info.php?page='.(($page_number-$half)-1).'">&laquo;</a></li>';

				for($i=($page_number - $half); $i<=($page_number+ $half); $i++) {

					if($i == $page_number){

						$pagination .= '<li class="active"><a href ="log-info.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
					} else {
						$pagination .= '<li><a href="log-info.php?page='.$i.'">'.$i.'</a></li>';
					}
				}

				$pagination .= '<li><a href ="log-info.php?page='.(($page_number+$half)+1).'">&raquo;</a></li>';
			}
			
		}

		$pagination .= '</nav></ul>';

		echo $pagination;
	}
?>

</head>

<body id='active-log-info'>
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
								<a href="account">
									<li>Account</li>
								</a>
								<a href="log-info">
									<li class="active">Log Info</li>
								</a>
								<a href="dept-log-info">
									<li>Department Log Info</li>
								</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-12">
						<div class="List1">
							<h4>Login Info</h4><br>
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Username</th>
										<th>IP</th>
										<th>Operating System</th>
										<th>Browser</th>
										<th>Date</th>
										<th>Time</th>
									</tr>
								</thead>
								<tbody>
									<?php
											$page_number = (isset($_GET['page']) AND !empty($_GET['page'])) ? $_GET['page']:1; //pagination
											$offset = $page_number -1;
											$per_page_records = 20; //pagination

											$sql = "SELECT * FROM assembly_login_details ORDER BY id desc LIMIT $offset , $per_page_records";
											//Create a prepared statement
											$stmt = mysqli_stmt_init($conn);
											//Prepare the prepared statement
											if (!mysqli_stmt_prepare($stmt, $sql)) {
												echo "Error loading the data.";
											} else {												
												//Run parameters inside database
												mysqli_stmt_execute($stmt);
												$result = mysqli_stmt_get_result($stmt);
												while($row = mysqli_fetch_assoc($result)) {
													echo "<tr>          
														<td>$row[id]</td> 
														<td>$row[username]</td>
														<td>$row[ip]</td>           
														<td>$row[operating_system]</td>           
														<td>$row[browser]</td>      
														<td>$row[date]</td>      
														<td>$row[time]</td>     
													</tr>";
												}

											}
										?>
								</tbody>
							</table>

						</div>
						<?php pagination(); ?>
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