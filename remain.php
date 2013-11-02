<?php
	include "link.php";

	$stdID = explode("-", $_POST['stdID']);
	$stdID	= $stdID[0];
	$courseID = $_GET['courseID'];
	$courseName = $_GET['courseName'];

	echo $courseID;
	echo $courseName;
	echo $stdID;

	$notice = "$courseID-$courseName is deleted due to course!";
	$query = "INSERT INTO notice(stdID, notice)
	VALUES ('$stdID', '$notice')";
	$result = $mysqli->query($query);

	$query = "DELETE E.* 
	FROM enroll E
	WHERE E.courseID='$courseID'
	AND E.stdID = '$stdID'
	";
	$result = $mysqli->query($query);

	echo "<script type='text/javascript'>";
	echo "alert('Success!');";
	echo "window.location.href='courseEdit.php?webNo=5';";
	echo "</script>";
?>
