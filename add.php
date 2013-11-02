<?php
	include "link.php";

	$stdID = explode("-", $_POST['stdID']);
	$stdID	= $stdID[0];
	$courseID = $_GET['courseID'];

	echo $courseID;
	echo $stdID;

	//first check time conflict or not
	//get course year and time 
	$query = "SELECT * 
	FROM course 
	WHERE courseID='$courseID'";
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();

	$profID = $row['profID'];
	$courseYear = $row['courseYear'];
	$courseTime = $row['courseTime'];
	$backup = $courseTime;

	$courseTime = explode("-", $courseTime);
	//check conflict or not
	$conflict = false;
	foreach ($courseTime as $value){
		echo $value;
		$query = "SELECT C.courseTime 
		FROM enroll E, course C
		WHERE C.courseTime LIKE '%$value%' 
		AND E.courseID = C.courseID
		AND E.stdID='$stdID' 
		AND C.courseYear='$courseYear'";
		$result = $mysqli->query($query);
		if($result->num_rows){
			$conflict = true;
			break;
		}
	}
	if($conflict){
		echo "conflict";
		echo "<script type='text/javascript'>";
		echo "alert('Time conflicted!Cannot add the student!');";
		echo "window.location.href='course.php?webNo=2';";
		echo "</script>";
	}
	//add the student
	else{
		echo "not conflict";
		echo $stdID, $courseID;
		$query = "INSERT INTO enroll (stdID, courseID) 
		VALUES ('$stdID', '$courseID')";
		$result = $mysqli->query($query);		
		echo "<script type='text/javascript'>";
		echo "alert('Success!');";
		echo "window.location.href='course.php?webNo=2';";
		echo "</script>";
	}
?>
