<?php
include "link.php";


$idNumber = $_SESSION["idNumber"];
$query = "SELECT S.* 
FROM student S 
WHERE S.idNumber = '$idNumber'";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();


$department = $row['department'];
$grade = $row['grade'];

$query = "SELECT * 
FROM course C, professor P
WHERE P.idNumber = C.profID
";
$result = $mysqli->query($query);
$length = count($result);


for ($i=0; $i < $length; $i++) { 

	echo '<table class="table table-striped">
			<tr>
			<td>CourseName</td>
			<td>TeacherName</td>
			<td>Classroom</td>
			<td>Capacity</td>
			<td>Credit</td>
			<td>Department</td>
			<td>Obligatory</td>
			<td>CourseYear</td>
			<td>CourseTime</td>
			<td>CourseID</td>
			<td>Select</td>
			<td>Unselect</td>
			</tr>';

			while ($row = $result->fetch_assoc()){
				$courseID = $row['courseID'];

				$query1 = "SELECT CC.*
				FROM courseConstraint CC
				WHERE CC.courseID = '$courseID'
				";
				$result1 = $mysqli->query($query1);

				if($result1->num_rows){

					$query2 = "SELECT CC.*
					FROM courseConstraint CC
					WHERE CC.courseID = '$courseID'
					AND CC.grade LIKE '%$grade%'
					AND CC.department = '$department'
					";
					$result2 = $mysqli->query($query2);

					if($result2->num_rows){
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
						echo '<td><a class="btn btn-success" href=/selectIt.php?profID='.$row['profID'].
						'&courseID='.$row['courseID'].'&courseYear='.$row['courseYear'].
						'&courseTime='.$row['courseTime'].'>Select It'.'</a></td>';
						echo '<td><a class="btn btn-danger" href=/unselectIt.php?profID='.$row['profID'].
						'&courseID='.$row['courseID'].'&courseYear='.$row['courseYear'].
						'&courseTime='.$row['courseTime'].'>Unselect It'.'</a></td>';
						echo "</tr>";

					}
					else{}
				}	
				else{
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
					echo '<td><a class="btn btn-success" href=/selectIt.php?profID='.$row['profID'].
					'&courseID='.$row['courseID'].'&courseYear='.$row['courseYear'].
					'&courseTime='.$row['courseTime'].'>Select It'.'</a></td>';
					echo '<td><a class="btn btn-danger" href=/unselectIt.php?profID='.$row['profID'].
					'&courseID='.$row['courseID'].'&courseYear='.$row['courseYear'].
					'&courseTime='.$row['courseTime'].'>Unselect It'.'</a></td>';
					echo "</tr>";
				}
			}

	echo '</table>';

}

?>