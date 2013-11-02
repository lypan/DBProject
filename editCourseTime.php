<?php
include "link.php";

$conflict = false;
$courseID = '';
$courseName = '';
$courseTime = '';
$profID = $_SESSION["idNumber"];

if(!empty($_POST["course"])){
	$course = $mysqli->real_escape_string($_POST["course"]);
	$course = explode("-", $course);
	$courseID = $course[0];
	$courseName = $course[1];
}
echo $courseID . '-' . $courseName;

if(!empty($_POST["select0"]))$number1 = $_POST["select0"];
if(!empty($_POST["select2"]))$number2 = $_POST["select2"];

if(!empty($_POST["select1"])){
	foreach ($_POST["select1"] as $selectedOption){
		$courseTime .= (string)$number1 . (string)$selectedOption . '-';
	}
}

if(!empty($_POST["select3"])){
	foreach ($_POST["select3"] as $selectedOption){
		$courseTime .= (string)$number2 . (string)$selectedOption . '-';
	}
}

//remove last -
$courseTime = rtrim($courseTime, "-");

echo $courseTime;

//get courseTime remove -
$finalString = explode("-", $courseTime);

print_r($finalString);

$query1 = "SELECT E.*
FROM enroll E
WHERE E.courseID = '$courseID'";
$result1 = $mysqli->query($query1);

while($row = $result1->fetch_assoc()){
	$stdID = $row['stdID'];
	echo $stdID;

	$conflict = false;
	foreach ($finalString as $value) {
		echo $value;
		$query2 = "SELECT *
		FROM enroll E, course C
		WHERE  E.courseID = C.courseID
		AND E.stdID = '$stdID'
		AND C.courseID != '$courseID'
		AND C.courseTime LIKE '%$value%' 
		";
		$result2 = $mysqli->query($query2);
		if($result2->num_rows){
			$conflict = true;
			echo 'Conflict' . "$value";
			$notice = "$courseID-$courseName is deleted due to time!";
			$query3 = "INSERT INTO notice (stdID, notice)
			VALUES ('$stdID', '$notice')
			";
			$result3 = $mysqli->query($query3);
			$query4 = "DELETE E.*
			FROM enroll E
			WHERE E.stdID = '$stdID'
			AND E.courseID = '$courseID'
			";		
			$result4 = $mysqli->query($query4);
			break;
		}
	}
}
if(!empty($_POST["select0"]) && !empty($_POST["select1"])){
	$query = "UPDATE course C
	SET C.courseTime='$courseTime'
	WHERE C.courseID='$courseID'
	";
	$result = $mysqli->query($query);	
	echo "<script type='text/javascript'>";
	echo "alert('Success!');";
	echo "</script>";
}

?>

<form  method="post" action="courseTime.php?webNo=4">
	<label>Choose Course</label>
	<select name='course'>
	<?php	
	$idNumber = $_SESSION["idNumber"];
	$query = "SELECT * 
	FROM course C, professor P 
	WHERE P.idNumber = C.profID
	AND C.profID = '$idNumber'";
	$result = $mysqli->query($query);
	while ($row = $result->fetch_assoc()){
		echo "<option>";
		echo $row['courseID'] . "-" . $row['courseName'];
		echo "</option>";
		}
	?>
	</select>
	<span class="help-block" id="courseHelp"></span>
	<label>courseTime1</label>
	<span class="help-block"></span>
	<select name="select0">
		<?php
			for($i = 1; $i <= 5; $i ++)echo "<option>$i</option>";
		?>
	</select>
	<select id="courseTime1" name="select1[]" multiple>
		<?php
			for($i = 'A'; $i <= "L"; $i ++)echo "<option>$i</option>";
		?>
		<option>X</option>
		<option>Y</option>
	</select>
	<span class="help-block" id="courseTime1Help"></span>
	<label>courseTime2</label>
		<select name="select2">
		<?php
			for($i = 1; $i <= 5; $i ++)echo "<option>$i</option>";
		?>
	</select>
	<select name="select3[]" multiple>
		<?php
			for($i = 'A'; $i <= "L"; $i ++)echo "<option>$i</option>";
		?>
		<option>X</option>
		<option>Y</option>
	</select>
	<div>
		<button class="btn btn-primary">Update CourseTime</button>
	</div>
	<span class="help-block"></span>
</form>
	