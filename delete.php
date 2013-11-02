<?php
	include "link.php";

	$stdID = explode("-", $_POST['stdID']);
	$stdID	= $stdID[0];
	$courseID = $_GET['courseID'];

	echo $courseID;
	echo $stdID;

	$query = "DELETE FROM enroll WHERE stdID='$stdID' AND courseID='$courseID'";
	$result = $mysqli->query($query);
	
	echo "<script type='text/javascript'>";
	echo "alert('Success!');";
	echo "window.location.href='course.php?webNo=2';";
	echo "</script>";
?>
