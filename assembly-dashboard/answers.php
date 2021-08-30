<?php
	include 'includes/header.php';
	echo "<title>Answers</title>";
	
	function get_row_count() {
		$conn = connect();
		$sql = "SELECT COUNT(*) as row FROM questions";
		$result = $conn->query($sql);
		$row = mysqli_fetch_assoc($result);
		return $row['row'];
	}

	function display_content($offset, $total){
		$conn = connect();
		$sql = "SELECT subject FROM questions LIMIT $offset, $total";
		$result = $conn->query($sql);
		$html = '<div class="content">';
		while ($row = mysqli_fetch_assoc($result)) {
			$html .= '<p>'.$row['subject'].'</p>';
 		}
 		$html .= '</div>';
 		echo $html;
	}

	function pagination () {		
		$page_number = (isset($_GET['page']) AND !empty($_GET['page'])) ? $_GET['page']:1;
		$per_page_records = 10;
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
					$pagination .= '<li class = "active"><a href = "questions.php?page='.$i.'">'.$i.'<span class = "sr-only">(current)</span></a></li>';
				} else {
					$pagination .= '<li><a href="questions.php?page='.$i.'">'.$i.'</a></li>';
				}
			}

			if ($last_page > $pagination_button) {
				$pagination .= '<li><a href = "questions.php?page='.($pagination_button+1).'">&raquo;</a></li>';
			}

		} elseif ($page_number >= $pagination_button AND $last_page > $pagination_button){

			if(($page_number+$half) >= $last_page) {

				$pagination .= '<li><a href = "questions.php?page='.($last_page - $pagination_button).'">&laquo;</a></li>'; //problem

				for ($i = ($last_page-$pagination_button)+1; $i<= $last_page; $i++){

					if ($i == $page_number) {
						$pagination .= '<li class="active"><a href = "questions.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
					} else {
						$pagination .= '<li><a href ="questions.php?page='.$i.'">'.$i.'</a></li>';
					}
				}
			} else if (($page_number+$half) < $last_page){
				$pagination .= '<li><a href = "questions.php?page='.(($page_number-$half)-1).'">&laquo;</a></li>';

				for($i=($page_number - $half); $i<=($page_number+ $half); $i++) {

					if($i == $page_number){

						$pagination .= '<li class="active"><a href ="questions.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
					} else {
						$pagination .= '<li><a href="answers.php?page='.$i.'">'.$i.'</a></li>';
					}
				}

				$pagination .= '<li><a href ="answers.php?page='.(($page_number+$half)+1).'">&raquo;</a></li>';
			}			
		}
		$pagination .= '</nav></ul>';
		echo $pagination;
	}
?>

</head>

<body>
	<?php
		include 'includes/nav.php';
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
								<a href="raise-question">
									<li>Raise a question</li>
								</a>
								<a href="questions">
									<li>Questions</li>
								</a>
								<a href="draft-questions">
									<li>Draft Questions</li>
								</a>
								<a href="answers">
									<li class="active">View Answers</li>
								</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-12">
						<div class="List1">
							<?php
									$sql = "SELECT * FROM questions INNER JOIN answers ON questions.q_id = answers.q_id  WHERE status = 'Yes' ORDER BY answers.q_id desc";
									$result = $conn->query($sql);
									if (mysqli_num_rows($result) > 0) {
										echo"
										<h4>Answers</h4><br>
										<table class='table table-bordered table-striped'>
											<thead>
												<tr>
													<th>ID</th>
													<th>Subject</th>
													<th>Asked On</th>
													<th>Replied</th>
													<th>View</th>
												</tr>
											</thead>    
											<tbody>"; 
												while($row = mysqli_fetch_array($result)) {
													echo "<tr>          
														<td>$row[q_id]</td> 
														<td>$row[subject]</td>    
														<td>$row[askedOn]</td>      
														<td>$row[submit_date]</td>       
														<td>
						                        			<form action='view-question' method='GET'>
						                        				<button type='submit' class='btn btn-default' name='q_id' value='$row[q_id]'>View</button>
						                        			</form>
						                        		</td>     
													</tr>";}
											echo
											"</tbody> 
										</table>";
									} else {
										echo "
											<h2>No New Answers Available!</h2>
											<h6><span class='fa fa-ban'></span></h6>";
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