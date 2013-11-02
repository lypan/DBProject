<?php

include "link.php";

$idNumber = $_SESSION["idNumber"];
$name = $_SESSION["name"];

$query = "SELECT * FROM course C, professor P 
WHERE P.idNumber = C.profID 
AND C.profID='$idNumber'";
$result = $mysqli->query($query);

if($result->num_rows){
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
			<td>studentList</td>
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
					echo '<td><a class="btn btn-info" href=teachList.php?webNo=1&courseID='
					.$row['courseID'].'>List Student' . '</a></td>';
					echo "</tr>";
			}

	echo '</table>';
}

if(!empty($_GET["courseID"])){

	$courseID = $_GET["courseID"];
	echo $courseID;
	$query = "SELECT *
	FROM enroll E, student S
	WHERE E.stdID=S.idNumber
	AND E.courseID='$courseID'";
	$result = $mysqli->query($query);

	echo '<table class="table table-striped">
			<tr>
			<td>studentID</td>
			<td>studentName</td>
			<td>department</td>
			<td>grade</td>
			</tr>';

			while ($row = $result->fetch_assoc()){
				echo "<tr>";
				echo "<td>" . $row['idNumber'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['department'] . "</td>";
				echo "<td>" . $row['grade'] . "</td>";
				 "</tr>";
			}
			
	echo '</table>';	

}


?>