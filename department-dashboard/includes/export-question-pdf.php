
<?php
	session_start();
	if(isset($_SESSION['department_username'])) {
		
			require($_SERVER['DOCUMENT_ROOT'].'/assembly/fpdf/fpdf.php');

			include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/db_connect.php');

			if(isset($_POST['submit'])) {
				$q_id = $_POST['q_id'];
			}

            $image1 = $_SERVER['DOCUMENT_ROOT']."/assembly/img/logoLarge.png";


			$pdf = new FPDF();
			$pdf -> AddPage();
			$pdf -> Image($image1, $pdf->GetX(), $pdf->GetY(), 10.78);
			$pdf -> SetFont("Arial", "BU", 13);
			$pdf -> Cell(0, 10, "Assembly Question",0,1,"C");
			
			$pdf -> Ln( 10 );

			$sql = "SELECT * FROM questions INNER JOIN departments ON questions.department = departments.dept_id WHERE q_id= '$q_id'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);

        	$q_id         = $row['q_id'];
        	$assembly_question_no         = $row['assembly_question_no'];
        	$file_no         = $row['file_no'];
        	$date         = $row['askedOn'];
        	$department         = $row['department'];
        	$member_name         = $row['member_name'];

        	$sql2 = "SELECT * FROM member WHERE member_id= $member_name";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);

			$pdf -> SetFont("Arial", "B", 11);
			$pdf -> Cell(85, 7,"To (Department) : $row[dept_name]  ",0,0, "B");
			$pdf -> Cell(160, 7,"Date: $date ",0,1, "C");
			$pdf -> Cell(160, 7,"Asked By: $row2[firstname] $row2[lastname] - $row2[member_type] - $row2[assembly_constituency_name]",0,1);
			$pdf -> Cell(160, 7,"Assembly Question No.: $assembly_question_no ",0,1);
			$pdf -> Cell(160, 7,"File No.: $file_no ",0,1);
			$pdf -> Ln( 5 );
			$pdf -> Cell(190, 7,"Subject:",0, 1);
			$pdf -> SetFont("Arial", "", 10);
			$pdf -> MultiCell(190, 7,"$row[subject]",0);
			$pdf -> Ln( 10);
			$pdf -> SetFont("Arial", "B", 11);
			$pdf -> Cell(190, 7,"Question:", 0, 1);
			$pdf -> SetFont("Arial", "", 10);
			$pdf -> MultiCell(190, 7,"$row[question]", 0);
			$pdf -> Ln( 10);
			$pdf -> Cell(190, 7,"Reference Number: $q_id", 0, 1);

			$pdf -> Ln( 10);
			$pdf -> SetFont("Arial", "", 15);
			$pdf -> Cell(190, 7,"- - - - - - X X X - - - - - -", 0, 1, "C");

			
		
			$pdf -> output();
		
	} else {
		header ("Location:../index?error");
		exit();
	}
?>