<?php
session_start();
include "link.php";

$courseTime = '';
$profID = $_SESSION["idNumber"];
$courseYear = $mysqli->real_escape_string($_POST["courseYear"]);
if(!empty($_POST["select0"]))$number1 = $_POST["select0"];
if(!empty($_POST["select2"]))$number2 = $_POST["select2"];

if(!empty($_POST["select1"])){
	foreach ($_POST["select1"] as $selectedOption){
		$courseTime .= (string)$number1 . (string)$selectedOption . '-';
	}
}

if(!empty($_POST["select3"])){
	foreach ($_POST["select3"] as $selectedOption){
		$courseTime .= (string)$number2 . (string)$selectedOption . '-';
	}
}

//remove last -
$courseTime = rtrim($courseTime, "-");

echo $courseTime;

//get courseTime remove -
$finalString = explode("-", $courseTime);
asort($finalString);


$courseTime = "";
foreach ($finalString as $value){
	$courseTime .= (string)$value . '-';
}
$courseTime = rtrim($courseTime, "-");


$conflict = false;
foreach ($finalString as $value) {
	echo $value . ' ---' ;
	$query = "SELECT courseTime FROM course WHERE courseTime LIKE '%$value%' 
	AND profID='$profID' AND courseYear='$courseYear'";
	$result = $mysqli->query($query);
	if($result->num_rows){
		$conflict = true;
		break;
	}
}
	if($conflict){
		echo "conflict";
		echo "<script type='text/javascript'>";
		echo "alert('The course has conflicted!Please rechoose!');";
		echo "window.location.href='teachCourse.php?webNo=2';";
		echo "</script>";
	}
	else{
		echo "no conflict";
		$random = true;
		do{
			$courseID = rand(100,1000);
			echo $courseID;
			$query = "SELECT courseID FROM  course WHERE courseID='$courseID'";
			$result = $mysqli->query($query);
			if($result->num_rows){
				//dulplicate
				echo "not random";
				$random = false;
			}	
		}while(!$random);

		$courseName = $mysqli->real_escape_string($_POST["courseName"]);
		$classroom = $mysqli->real_escape_string($_POST["classroom"]);
		//$teacherName = $mysqli->real_escape_string($_POST["teacherName"]);
		$capacity = $mysqli->real_escape_string($_POST["capacity"]);
		$credit = $mysqli->real_escape_string($_POST["credit"]);
		$department = $mysqli->real_escape_string($_POST["department"]);
		$grade = $mysqli->real_escape_string($_POST["grade"]);
		$obligatory = $mysqli->real_escape_string($_POST["obligatory"]);
		$courseYear = $mysqli->real_escape_string($_POST["courseYear"]);

		$query = "INSERT INTO course (courseName, profID, classroom ,capacity ,credit , 
			department ,grade ,obligatory ,courseYear, courseTime, courseID) 
		VALUES ('$courseName', '$profID', '$classroom', '$capacity', '$credit',
		 '$department', '$grade', '$obligatory', '$courseYear', '$courseTime', '$courseID')";
		$result = $mysqli->query($query);

		echo "<script type='text/javascript'>";
		echo "window.location.href='teachCourse.php?webNo=2';";
		echo "</script>";
	}




?>