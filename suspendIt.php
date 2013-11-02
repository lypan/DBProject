<?php

include "link.php";

$account = $_GET['account'];

$query = "UPDATE permission SET suspend='1' WHERE account='$account'";
$result = $mysqli->query($query);

echo "<script type='text/javascript'>";
echo "window.location.href='main.php';";
echo "</script>";

?>