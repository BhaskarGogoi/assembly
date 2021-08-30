<?php
	session_start();

	if (isset($_POST['q_id'])) {

		include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/db_connect.php');

		$answer = mysqli_real_escape_string($conn, $_POST['answer']);
		$q_id = mysqli_real_escape_string($conn, $_POST['q_id']);

		$submit_date = date("d-m-Y");

		//-----Check if form datas are not filled-----

		if (empty($answer)) {
			header ("Location:../view-question.php?error=empty");

			exit();
		}

		//-----End Check if form datas are not filled-----

		else {
			$sql = "INSERT INTO answers (q_id, answer, answer_type, submit_date)
			VALUES ('$q_id', '$answer', 'Text', '$submit_date')";
			$result = $conn->query($sql);

			$sql = "UPDATE questions SET status = 'Yes' WHERE q_id = '$q_id'";
			$result = $conn->query($sql);			

			header ("Location:../index.php?submit=success");
		}
					
			
			
	} else {
		header ("Location:../index.php");
		exit();
	}	
?>