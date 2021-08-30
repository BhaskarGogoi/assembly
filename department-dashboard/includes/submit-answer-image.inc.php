<?php
	session_start();
	include 'db_connect.php';

	if (isset($_POST['q_id'])) {

		$q_id = mysqli_real_escape_string($conn, $_POST['q_id']);

		$file = $_FILES['ans_image'];
		$fileName = $_FILES['ans_image']['name'];
		$fileTmpName = $_FILES['ans_image']['tmp_name'];
		$fileSize = $_FILES['ans_image']['size'];
		$fileError = $_FILES['ans_image']['error'];
		$fileType = $_FILES['ans_image']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg','pdf');
		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 500000) {
					$fileNameNew = "Answer".$q_id.".".$fileActualExt;
					$fileLocation = $_SERVER['DOCUMENT_ROOT'].'/assembly/img/answer/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileLocation);

					$submit_date = date("Y-m-d");
					
					$sql = "INSERT INTO answers (q_id, answer_type, submit_date)
					VALUES ('$q_id', '$fileActualExt', '$submit_date')";
					$result = $conn->query($sql);

					$sql = "UPDATE questions SET status = 'Yes' WHERE q_id = '$q_id'";
					$result = $conn->query($sql);

					header ("Location:../index.php?submit=success");

				} else {
					
					header ("Location:../new-questions.php?error=fileSize");

				}

			} else{
					header ("Location:../new-questions.php?error=uploading");

			}
		}
		else {
				header ("Location:../new-questions.php?error=fileType");
		}
}
?>