<?php
session_start();
include "link.php";

$idNumber = $_SESSION["idNumber"];
$courseID = $_GET['courseID'];
$courseYear = $_GET['courseYear'];
$courseTime = $_GET['courseTime'];


$query = "DELETE FROM enroll 
WHERE stdID='$idNumber'
AND courseID='$courseID'";
$result = $mysqli->query($query);


echo "<script type='text/javascript'>";
echo "alert('Success!');";
echo "window.location.href='course.php?webNo=1';";
echo "</script>";

?>