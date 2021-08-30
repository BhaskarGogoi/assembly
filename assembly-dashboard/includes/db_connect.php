<?php

$conn = mysqli_connect("localhost", "root", "", "assembly");

if (!$conn) {
	die("Connection Failed: ".mysqli_connect_error());
}