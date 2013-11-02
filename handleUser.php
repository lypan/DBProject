<?php
session_start();
include "link.php";

$account = $mysqli->real_escape_string($_POST["account"]);
$deleteMember= $mysqli->real_escape_string($_POST["deleteMember"]);
//$name = $mysqli->real_escape_string($_POST["name"]);
$changePassword = $mysqli->real_escape_string($_POST["changePassword"]);
$changePermission = $mysqli->real_escape_string($_POST["changePermission"]);


//store selected account privilege
$query = "SELECT privilege 
FROM  permission 
WHERE account='$account'";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();	
$privilege = $row['privilege'];

//store selected account position
$query = "SELECT position 
FROM  position 
WHERE account='$account'";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();	
$position = $row['position'];

//select idnumber first
$query = "SELECT  idNumber 
FROM  $position 
WHERE account='$account'";
$result = $mysqli->query($query);	
$row = $result->fetch_assoc();
$idNumber = $row["idNumber"];


if($deleteMember == 'delete'){
	//first check how many admin left
	$query = "SELECT  * 
	FROM  permission 
	WHERE privilege='admin'";
	$result = $mysqli->query($query);

	if($result->num_rows == 1 && $privilege == 'admin'){
	//only one admin
		echo "<script type='text/javascript'>";
		echo "alert('Only left one admin!Cannot delete member!');";
		echo "window.location.href='user.php?webNo=1';";
		echo "</script>";
	}
	else {
		//enroll delete
		//if student
		if($position == 'student'){
			$query = "DELETE FROM enroll 
			WHERE stdID='$idNumber'";
			$result = $mysqli->query($query);
		}
		else if($position == 'professor'){
			$query = "DELETE E.*
			FROM enroll E
			WHERE E.courseID = (SELECT C.courseID
			FROM course C, professor S
			WHERE C.profID = S.idNumber
			AND E.courseID = C.courseID
			AND C.profID = '$idNumber'
			)";
			$result = $mysqli->query($query);
			//delete course, too
			$query = "DELETE C.* 
			FROM course C 
			WHERE  C.profID = '$idNumber'";
			$result = $mysqli->query($query);
		}

		//original data
		$query = "DELETE FROM $position 
		WHERE account='$account'";
		$result = $mysqli->query($query);
		//position delete
		$query = "DELETE FROM position 
		WHERE account='$account'";
		$result = $mysqli->query($query);
		//permission delete
		$query = "DELETE FROM permission 
		WHERE account='$account'";
		$result = $mysqli->query($query);
		//if delete teacher, delete course too
			
		//back to main.php
	}
	echo "<script type='text/javascript'>";
	echo "window.location.href='user.php?webNo=1';";
	echo "</script>";
}

if(($changePermission == 'student' || $changePermission == 'professor') && $privilege == 'admin'){
	//first check how many admin left
	$query = "SELECT * FROM  permission WHERE privilege='admin'";
	$result = $mysqli->query($query);
	//only one admin left
	if($result->num_rows == 1){
		echo "<script type='text/javascript'>";
		echo "alert('Only left one admin!Cannot change permission!');";
		echo "window.location.href='user.php?webNo=1';";
		echo "</script>";
	}
	else{
		$query = "UPDATE permission SET privilege='$changePermission' WHERE account='$account'";
		$result = $mysqli->query($query);
	}
}
else if($changePermission == 'admin'){
	//just change permission
	$query = "UPDATE permission SET privilege='$changePermission' WHERE account='$account'";
	$result = $mysqli->query($query);
}


if(!empty($changePassword)){
	$sha1 = sha1($changePassword);
	$query = "UPDATE $position SET password='$sha1' WHERE account='$account'";
	$result = $mysqli->query($query);
}

//back to main.php
echo "<script type='text/javascript'>";
echo "window.location.href='user.php?webNo=1';";
echo "</script>";
	

?>