<?php
include "link.php";

$query = "SELECT * FROM course C, professor P WHERE P.idNumber = C.profID";
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
		<td>Delete</td>
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
				echo '<td><a class="btn btn-danger" href=/course.php?webNo=2&courseID='
				.$row['courseID'].'>Delete It'.'</a></td>';
				echo "</tr>";
		}

echo '</table>';

//delete the course
if(!empty($_GET['courseID'])){
	$courseID = $_GET['courseID'];
	//delete course
	$query = "DELETE FROM course WHERE courseID='$courseID'";
	$result = $mysqli->query($query);
	//delete enroll
	$query = "DELETE FROM enroll WHERE courseID='$courseID'";
	$result = $mysqli->query($query);	
}
?>


<form method="post" action="course.php?webNo=2">
	<label>Select Course</label>
	<select name="courseID">
	<?php
		$query = "SELECT * FROM  course";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_assoc()){
			echo"<option>";
			echo $row['courseID']. '-' . $row['courseName'];
			echo"</option>";
		}
	?>
	</select>
	<span class="" id=""></span>
	<label>Add/Delete</label>
	<select name="choose">
		<option name="add">Add</option>
		<option name="delete">Delete</option>
	</select>
	<span class="" id=""></span>
	<div>
		<button class="btn btn-primary">Choose Course</button>
	</div>
	<span class="help-block" id=""></span>
</form>


<?php
if(!empty($_POST['courseID']) && !empty($_POST['choose'])){

	$courseID = explode("-", $_POST['courseID']);
	$courseID	= $courseID[0];
	$choose	= $_POST['choose'];

	echo $courseID;
	echo $choose;

	if($choose == 'Add'){
?>

<form method="post" action=<?php echo 'add.php?courseID=' .$courseID?> >
	<label>Select Student</label>
	<select name="stdID">
	<?php
		$query = "SELECT * FROM student";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_assoc()){
			echo"<option>";
			echo $row['idNumber']. '-' . $row['name'];
			echo"</option>";
		}
	?>
	</select>
	<div>
		<button class="btn btn-success">Add Student</button>
	</div>
	<span class="help-block" id=""></span>
</form>
<?php
	}
	else if($choose == 'Delete'){
?>
<form method="post" action=<?php echo 'delete.php?courseID=' .$courseID?> >
	<label>Select Student</label>
	<select name="stdID">
	<?php
		$query = "SELECT * FROM student";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_assoc()){
			echo"<option>";
			echo $row['idNumber']. '-' . $row['name'];
			echo"</option>";
		}
	?>
	</select>
	<div>
		<button class="btn btn-danger">Delete Student</button>
	</div>
	<span class="help-block" id=""></span>
</form>


<?php

	}


}
?>