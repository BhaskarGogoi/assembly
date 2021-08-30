<?php
	include 'includes/header.php';
	echo "<title>Sessions</title>";

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
		}  elseif (strpos($url, 'insert=fail')!== false) {
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
									<a href="departments"><li>Departments</li></a>
									<a href="sessions"><li class="active">Session</li></a>
								</ul>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12">
							<div class="List1">
								<h4>Insert New Session</h4><br>
								<form class='form-horizontal' role='form' action='includes/insert-session-inc.php' method='POST'><br>
									<div class='form-group'>
										<label class='col-sm-2 control-label'>Session Title</label> 
										<div class='col-sm-10'>
											<input type='text' name='session' class='form-control' required='required' placeholder="Eg: Budget Session" autocomplete="off" />
										</div>
									</div>
									<div class='form-group'>  
										<label class="col-sm-2 control-label">Start Date</label>            
										<div class='col-sm-2'>          
											<select class="form-control" id='day' name='day' required="required">
												<option>01</option>
												<option>02</option>
												<option>03</option>
												<option>04</option>
												<option>05</option>
												<option>06</option>
												<option>07</option>
												<option>08</option>
												<option>09</option>
												<option>10</option>
												<option>11</option>
												<option>12</option>
												<option>13</option>
												<option>14</option>
												<option>15</option>
												<option>16</option>
												<option>17</option>
												<option>18</option>
												<option>19</option>
												<option>20</option>
												<option>21</option>
												<option>22</option>
												<option>23</option>
												<option>24</option>
												<option>25</option>
												<option>26</option>
												<option>27</option>
												<option>28</option>
												<option>29</option>
												<option>30</option>
												<option>31</option>											
											</select> 
										</div>
										<div class='col-sm-2'>          
											<select class="form-control" id='month' name='month' required="required">
												<option>01</option>
												<option>02</option>
												<option>03</option>
												<option>04</option>
												<option>05</option>
												<option>06</option>
												<option>07</option>
												<option>08</option>
												<option>09</option>
												<option>10</option>
												<option>11</option>
												<option>12</option>
											</select> 
										</div>
										<div class='col-sm-2'>          
											<select class="form-control" id='year' name='year' required="required">
												<option>2019</option>
												<option>2020</option>
												<option>2021</option>
												<option>2022</option>
												<option>2023</option>
												<option>2024</option>
												<option>2025</option>
												<option>2026</option>
												<option>2027</option>
												<option>2028</option>
												<option>2029</option>
												<option>2030</option>
												<option>2031</option>
												<option>2035</option>
												<option>2033</option>
												<option>2034</option>
												<option>2035</option>										
											</select> 
										</div>    
									</div>
									<div class='form-group'> 
										<div class='col-sm-offset-2 col-sm-10'> 
											<button type='submit' name='insert' class='btn btn-primary'>Insert</button> 
										</div> 
									</div>
								</form>
							</div><br>
							<div class="List1">
								<h4>Sessions</h4><br>
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Session Year</th>
											<th>Title</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Action</th>
											
										</tr>
									</thead>    
									<tbody> 
										<?php
											$sql = "SELECT * FROM assembly_session ORDER BY session_id desc";
											$result = $conn->query($sql);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<tr>          
													<td>$row[session_year]</td>      
													<td>$row[session_title]</td>      
													<td>$row[session_start_date]</td>      
													<td>$row[session_end_date]</td>";

													if ($row['session_end_date'] !== "Live" ) {
														echo "<td>Ended</td>";
													} else {
														echo "<td><form action='session-end' method='POST'>
						                        				<button type='submit' class='btn btn-default' name='end' value='$row[session_id]'>End Now</button>
						                        			</form></td>";
													}

													     
												echo"	     
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