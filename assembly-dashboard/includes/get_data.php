<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');

	if(isset($_POST['askedBy'])) {

		$ab = $_POST["askedBy"];

		echo "Success";
	}	
?>