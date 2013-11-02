<?php
session_start();
include "link.php";

$idNumber = $_SESSION["idNumber"];
$account = $_SESSION["account"];
$name = $mysqli->real_escape_string($_POST["name"]);
$password = $mysqli->real_escape_string($_POST["password"]);
$npassword = $mysqli->real_escape_string($_POST["npassword"]);
$position = $_SESSION["position"];

if(!empty($password) && !empty($npassword)){
	//echo $npassword;
	$sha1 = sha1($password);
	$sha2 = sha1($npassword);
	$query = "SELECT password FROM  $position WHERE idNumber='$idNumber' AND password='$sha1'";
	$result = $mysqli->query($query);
	if($result->num_rows == 0){
		echo "<script type='text/javascript'>";
		echo "alert('Password unauthenticated!');";
		echo "window.location.href='main.php'";
		echo "</script>";
	}
	else {
		$query = "UPDATE $position SET password='$sha2' WHERE idNumber='$idNumber' AND password='$sha1'";
		$result = $mysqli->query($query);
		echo "<script type='text/javascript'>";
		echo "alert('Password authenticated!');";
		echo "window.location.href='main.php'";
		echo "</script>";
	}
}
if($name != $_SESSION["name"]){
	$query = "UPDATE $position SET name='$name' WHERE idNumber='$idNumber'";
	$result = $mysqli->query($query);
	echo "<script type='text/javascript'>";
	echo "alert('Name changed!');";
	echo "window.location.href='main.php'";
	echo "</script>";
}

?>