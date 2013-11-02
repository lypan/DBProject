<?php

include "link.php";



$profID = $_SESSION["idNumber"];

$courseID = "";



if(!empty($_POST["course"])){

	$course = $mysqli->real_escape_string($_POST["course"]);

	$course = explode("-", $course);

	echo $course[0];

	$courseID = $course[0];

	$courseName = $course[1];

}

if(!empty($_POST["department"])){

	$department = $mysqli->real_escape_string($_POST["department"]);

	echo $department;

}

$grade = "";

if(!empty($_POST["grade"])){

	$original = $_POST["grade"];

	foreach ($_POST["grade"] as $selectedOption)$grade .= (string)$selectedOption . ",";

	//remove last ,

	$grade = rtrim($grade, ",");

	echo $grade;

}



if(!empty($_POST["course"]) && !empty($_POST["department"])){



	//check already exist or not

	$query = "SELECT *

	FROM courseConstraint C

	WHERE C.courseID = '$courseID'

	";

	$result = $mysqli->query($query);



	//has been inserted

	if($result->num_rows){

		echo "<script type='text/javascript'>";

		echo "alert('The course has been set!');";

		$query = "DELETE CC.*
		FROM courseConstraint 
		WHERE CC.courseID = '$courseID'
		";
		$result = $mysqli->query($query);

		echo "</script>";	

	}

	

		//set constraint

		$query = "INSERT INTO courseConstraint (courseID, department, grade)

		VALUES ('$courseID', '$department', '$grade')";

		$result = $mysqli->query($query);

		echo "<script type='text/javascript'>";

		echo "alert('Constraint set success');";

		echo "</script>";



		//clear not satisfy the constraint students

		echo "grade is " . $grade;

		if($grade == ""){//clear except department

			//select each student first

			$query = "SELECT *

			FROM enroll E, student S

			WHERE E.stdID = S.idNumber

			AND E.courseID = '$courseID' 

			AND S.department != '$department'

			";

			echo $query;

			$result = $mysqli->query($query);



			while ($row = $result->fetch_assoc()){

				echo $row['idNumber'];

				$stdID = $row['idNumber'];

				//add notice 

				$notice = "$courseID-$courseName is deleted due to constraint!";

				$query2 = "INSERT INTO notice (stdID, notice)

				VALUES ('$stdID', '$notice')

				";		

				$result2 = $mysqli->query($query2);

				//delete student

				$query3 = "DELETE E.*

				FROM enroll E

				WHERE E.stdID = '$stdID'

				AND E.courseID = '$courseID'

				";		

				$result3 = $mysqli->query($query3);

			}

		}

		else {	

			//select each student first

			$query = "SELECT *

			FROM enroll E, student S

			WHERE E.stdID = S.idNumber

			AND E.courseID = '$courseID' 

			AND S.department != '$department'

			OR (S.department = '$department' AND S.grade NOT IN ($grade))

			";

			echo $query;

			$result = $mysqli->query($query);

			while ($row = $result->fetch_assoc()){

				echo $row['idNumber'];

				$stdID = $row['idNumber'];

				//add notice 

				$notice = "$courseID-$courseName is deleted due to constraint!";

				$query2 = "INSERT INTO notice (stdID, notice)

				VALUES ('$stdID', '$notice')

				";

				$result2 = $mysqli->query($query2);

				//delete student

				$query3 = "DELETE E.*

				FROM enroll E

				WHERE E.stdID = '$stdID'

				AND E.courseID = '$courseID'

				";		

				$result3 = $mysqli->query($query3);	

			}

		}	

	

}



?>



<form  method="post" action="constraint.php?webNo=3">

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

	<label>Select Department</label>

	<select name='department'>

		<?php

			$query = "SELECT department FROM department";

			$result = $mysqli->query($query);

			while ($row = $result->fetch_assoc()){

					echo"<option>";

					echo $row['department'];

					echo"</option>";

			}

		?>

	</select>

	<span class="help-block" id="departmentHelp"></span>

	<label>Select Grade</label>

	<select id="grade" name="grade[]" multiple>

		<?php

			for($i = 1; $i <= 6; $i ++)echo "<option>$i</option>";

		?>

	</select>	

	<span class="help-block" id="gradeHelp"></span>

	<div>

		<button class="btn btn-primary">Add Constraint</button>

	</div>

	<span class="help-block"></span>

</form>

	