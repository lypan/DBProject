<?php

include "link.php";

//stdId and stdName
$idNumber = $_SESSION["idNumber"];
$name = $_SESSION["name"];

$query = "SELECT position FROM  position WHERE idNumber='$idNumber'";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$position = $row['position'];


$query = "SELECT grade FROM  $position WHERE idNumber='$idNumber'";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$grade = $row['grade'];


echo '<table class="table table-striped">
		<tr>
		<td>stdID</td>
		<td>Name</td>
		<td>Grade</td>
		</tr>';
echo '<tr>';
echo '<td>'. $idNumber .'</td>';
echo '<td>'. $name .'</td>';
echo '<td>'. $grade .'</td>';
echo '</tr>';
echo '</table>';

//credit part
$query = "SELECT SUM(C.credit) AS credit
FROM enroll E, course C
WHERE E.stdID='$idNumber'
AND E.courseID = C.courseID
";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$credit = $row['credit'];
//time part
$query = "SELECT C.*
FROM enroll E, course C
WHERE E.stdID='$idNumber'
AND E.courseID = C.courseID
";
$result = $mysqli->query($query);
$count = 0;
while($row = $result->fetch_assoc()){
	//echo $row['courseTime'];
	$courseTime = $row['courseTime'];
	$temp = explode("-", $courseTime);
	foreach ($temp as $value) {
		$count ++;
	}
}

echo "<div  class = 'alert alert-info' >";
echo "Total credit is " . $credit . "<br>";
echo "Total hour is " . $count . "<br>";
echo "</div>";



$query = "SELECT *
FROM enroll E, course C, professor P
WHERE C.profID = P.idNumber 
AND E.courseID=C.courseID
AND E.stdID='$idNumber'";
$result = $mysqli->query($query);


echo '<table class="table table-striped">
		<tr>
		<td>courseName</td>
		<td>teacherName</td>
		<td>classroom</td>
		<td>capacity</td>
		<td>credit</td>
		<td>department</td>
		<td>obligatory</td>
		<td>courseYear</td>
		<td>courseTime</td>
		<td>courseID</td>
		</tr>';

		while ($row = $result->fetch_assoc()){
				echo "<tr>";
				echo "<td>" . $row['courseName'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['classroom'] . "</td>";
				echo "<td>" . $row['capacity'] . "</td>";
				echo "<td>" . $row['credit'] . "</td>";
				echo "<td>" . $row['department'] . "</td>";
				if($row['obligatory'])echo "<td>obligatory</td>";
				else echo "<td>not obligatory</td>";
				echo "<td>" . $row['courseYear'] . "</td>";
				echo "<td>" . $row['courseTime'] . "</td>";
				echo "<td>" . $row['courseID'] . "</td>";
				echo "</tr>";
		}

echo '</table>';

?>