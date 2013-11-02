<?php
include "link.php";

$courseID = '';
$courseName = '';
$profID = $_SESSION["idNumber"];
$query = "SELECT * 
FROM course C, professor P
WHERE P.idNumber = C.profID
AND C.profID = '$profID'
";
$result = $mysqli->query($query);

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


<form method="post" action="courseEdit.php?webNo=5">
	<label>Select Course</label>
	<select name="courseID">
	<?php
		$query = "SELECT * 
		FROM course C, professor P
		WHERE P.idNumber = C.profID
		AND C.profID = '$profID'
		";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_assoc()){
			echo"<option>";
			echo $row['courseID']. '-' . $row['courseName'];
			echo"</option>";
		}
	?>
	</select>
	<span class="" id=""></span>
	<label>Remain/Delete Course</label>
	<select name="choose">
		<option name="add">Remain</option>
		<option name="delete">Delete</option>
	</select>
	<span class="" id=""></span>
	<div>
		<button class="btn btn-primary">Update Course</button>
	</div>
	<span class="help-block" id=""></span>
</form>


<?php
if(!empty($_POST['courseID']) && !empty($_POST['choose'])){
	
	$course = explode("-", $_POST['courseID']);
	$courseID	= $course[0];
	$courseName = $course[1];
	$choose	= $_POST['choose'];

	echo $courseID;
	echo $courseName;
	echo $choose;

	if($choose == 'Remain'){
?>

<form method="post" action=<?php echo 'remain.php?courseID=' . $courseID . '&courseName=' . $courseName ?> >
	<label>Select Student to delete</label>
	<select name="stdID">
	<?php
		$query = "SELECT * 
		FROM enroll E, student S
		WHERE E.courseID = '$courseID'
		AND E.stdID = S.idNumber
		";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_assoc()){
			echo"<option>";
			echo $row['idNumber']. '-' . $row['name'];
			echo"</option>";
		}
	?>
	</select>
	<div>
		<button class="btn btn-success">Delete Student</button>
	</div>
	<span class="help-block" id=""></span>
</form>
<?php
	}
	else if($choose == 'Delete'){

		$query = "SELECT *
		FROM enroll E
		WHERE E.courseID = '$courseID' 
		";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_assoc()){
			$stdID = $row['stdID'];
			echo $stdID;
			$notice = "$courseID-$courseName is deleted due to course!";
			$query1 = "INSERT INTO notice(stdID, notice)
			VALUES ('$stdID', '$notice')";
			$result1 = $mysqli->query($query1);
		}

		$query = "DELETE E.*
		FROM enroll E
		WHERE E.courseID = '$courseID' 
		";
		$result = $mysqli->query($query);	

		$query = "DELETE C.*
		FROM course C
		WHERE C.courseID = '$courseID' 
		";	
		$result = $mysqli->query($query);			
	}


}
?>