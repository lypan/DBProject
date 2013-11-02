<?php
session_start();
include "link.php";
//get data from form
$account = $mysqli->real_escape_string($_POST["account"]);
$password = $mysqli->real_escape_string($_POST["password"]);
//use sha1 algo
$sha1 = sha1($password);
//find privilege and suspend from permission
$query = "SELECT * FROM  permission WHERE account='$account'";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$privilege = $row["privilege"];
$suspend = $row["suspend"];

if($result->num_rows == 0){
	echo "<script type='text/javascript'>";
	echo "alert('Not Found!');";
	echo "window.location.href='index.php'";
	echo "</script>";
}
else{
	//find which table store the info
	$query = "SELECT position FROM  position WHERE account='$account'";
	$result = $mysqli->query($query);
	if($result->num_rows){
			//find password right or not
			$row = $result->fetch_assoc();
			$position = $row['position']; 
			$query = "SELECT account, idNumber, name FROM  $position WHERE account='$account' AND password='$sha1'";
			$result = $mysqli->query($query);
			if($result->num_rows){
				$row = $result->fetch_assoc();
				$_SESSION["account"] = $row["account"];
				$_SESSION["name"] = $row["name"];
				$_SESSION["idNumber"] = $row["idNumber"];	
				$_SESSION["privilege"] = $privilege;
				$_SESSION["suspend"] = $suspend;
				$_SESSION["position"] = $position;
				echo $_SESSION["account"];
				echo $_SESSION["name"];
				echo $_SESSION["idNumber"];
				echo $_SESSION["privilege"];
				echo $_SESSION["suspend"];
				echo $_SESSION["position"];
				//goto main.php		
				echo "<script type='text/javascript'>";
				echo "window.location.href='main.php'";
				echo "</script>";
			}
			else {
				echo "<script type='text/javascript'>";
				echo "alert('Wrong password!');";
				echo "window.location.href='index.php'";
				echo "</script>";

			}
			

	}
	else{
		echo "<script type='text/javascript'>";
		echo "alert('Database corrupt!');";
		echo "window.location.href='index.php'";
		echo "</script>";

	}
	
}

