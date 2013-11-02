<?php
session_start();
include "link.php";
$type = $_GET['type'];
echo $type;
$duplication = false;

if($type == 'student'){
	//get data from form
	$account = $mysqli->real_escape_string($_POST["account"]);
	$password = $mysqli->real_escape_string($_POST["password"]);
	$name = $mysqli->real_escape_string($_POST["name"]);
	$idNumber = $mysqli->real_escape_string($_POST["idNumber"]);
	$department = $mysqli->real_escape_string($_POST["department"]);
	$grade = $mysqli->real_escape_string($_POST["grade"]);

	//test id exist or not
	$query = "SELECT account,idNumber  FROM permission WHERE account='$account' OR idNumber='$idNumber'";
	$result = $mysqli->query($query);
	if($result->num_rows)$duplication = true;

	//if exist 
	if($duplication){
		echo "<script type='text/javascript'>window.alert('Duplication account or idNumber! Please reinput!');</script>";
	}
	//else insert
	else{
	$sha1 = sha1($password);
	//insert student
	$query = "INSERT INTO student (account, password,name ,idNumber ,department, grade) VALUES ('$account', '$sha1', '$name', '$idNumber', '$department', '$grade')";
	$result = $mysqli->query($query);
	//insert permission
	$query = "INSERT INTO permission  (account, idNumber, privilege, suspend) VALUES ('$account', '$idNumber', 'student', 'false')";
	$result = $mysqli->query($query);
	//insert position
	$query = "INSERT INTO position  (account, idNumber, position) VALUES ('$account', '$idNumber', 'student')";
	$result = $mysqli->query($query);	
	echo "<script type='text/javascript'>window.alert('Register Success!');</script>";
	}	
}

else if($type == 'professor'){	
	//get data from form
	$account = $mysqli->real_escape_string($_POST["account"]);
	$password = $mysqli->real_escape_string($_POST["password"]);
	$name = $mysqli->real_escape_string($_POST["name"]);
	$idNumber = $mysqli->real_escape_string($_POST["idNumber"]);
	$department = $mysqli->real_escape_string($_POST["department"]);

	$query = "SELECT account,idNumber  FROM permission WHERE account='$account' OR idNumber='$idNumber'";
	$result = $mysqli->query($query);
	if($result->num_rows)$duplication = true;

	//test id exist or not
	if($duplication){
		echo "<script type='text/javascript'>window.alert('Duplication account or idNumber! Please reinput!');</script>";
	}
	else{
	$sha1 = sha1($password);
	$query = "INSERT INTO professor (account, password, name ,idNumber ,department) VALUES ('$account', '$sha1', '$name', '$idNumber', '$department')";
	$result = $mysqli->query($query);

	$query = "INSERT INTO permission  (account, idNumber, privilege, suspend) VALUES ('$account', '$idNumber', 'professor', 'false')";
	$result = $mysqli->query($query);
	//insert position
	$query = "INSERT INTO position  (account, idNumber, position) VALUES ('$account', '$idNumber', 'professor')";
	$result = $mysqli->query($query);
	echo "<script type='text/javascript'>window.alert('Register Success!');</script>";
	}

}

	echo "<script type='text/javascript'>";  
	echo "window.location.href='index.php'";
	echo "</script>";
?>