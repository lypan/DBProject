<?php
session_start();
include "link.php";

$idNumber = $_SESSION["idNumber"];
$courseID = $_GET['courseID'];
$courseYear = $_GET['courseYear'];
$courseTime = $_GET['courseTime'];


//get time
$time = explode("-", $courseTime);

//check time is conflict or not
$conflict = false;
foreach ($time as $value) {
	echo $value;
	$query = "SELECT * 
	FROM enroll E, course C
	WHERE E.courseID = C.courseID
	AND C.courseTime LIKE '%$value%' 
	AND E.stdID='$idNumber' 
	AND C.courseYear='$courseYear'";
	$result = $mysqli->query($query);
	if($result->num_rows){
		$conflict = true;
		break;
	}
}


if($conflict){
	echo "<script type='text/javascript'>";
	echo "alert('Time conflicted!');";
	echo "window.location.href='course.php?webNo=1';";
	echo "</script>";
}
else{
	//check has selected or not
	$query = "SELECT * 
	FROM  enroll 
	WHERE stdID='$idNumber'  
	AND courseID='$courseID'";
	$result = $mysqli->query($query);

	if($result->num_rows){

		echo "<script type='text/javascript'>";
		echo "alert('You have been enrolled!');";
		echo "window.location.href='course.php?webNo=1';";
		echo "</script>";

	}
	else{

		$query = "INSERT INTO enroll (stdID, courseID) 
		VALUES ('$idNumber', '$courseID')";
		$result = $mysqli->query($query);
		echo "<script type='text/javascript'>";
		echo "alert('Success!');";
		echo "window.location.href='course.php?webNo=1';";
		echo "</script>";
	}
}

?>