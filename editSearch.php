<?php

include "link.php";

?>



<form  method="post" action="">

	<label>Department</label>

	<select name="department[]" multiple>

    	<?php

    	$query = "SELECT DISTINCT department
		FROM  course";

		$result = $mysqli->query($query);

			while ($row = $result->fetch_assoc()){

					echo"<option>";

					echo $row['department'];

					echo"</option>";

		}

		?>

	</select>

	<span class="help-block" id="departmentHelp"></span>

	<label>Grade</label>

	<select name="grade[]" multiple>

		<option>none</option>

		<option>underGraduate</option>

		<option>graduate</option>

		<option>1</option>

		<option>2</option>

		<option>3</option>

		<option>4</option>

		<option>5</option>

		<option>6</option>

	</select>

	<span class="help-block" id="gradeHelp"></span>

	<label>courseName</label>

	<input name="courseName" type="text" class="input-xlarge">

	<span class="" id="courseNameHelp"></span>

	<label>Mode</label>

	<label class="checkbox inline">

	  <input name="mode" type="checkbox" id="inlineCheckbox1" value="1"> 1

	</label>

	<label class="checkbox inline">

	  <input name="mode" type="checkbox" id="inlineCheckbox2" value="2"> 2

	</label>

	<span class="help-block" id="modeHelp"></span>

	<label>Course Time</label>

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

	<div>

		<button class="btn btn-primary">Search Course</button>

	</div>

	<span class="help-block" id="searchCourseHelp"></span>

</form>

<?php

$length_d = 0;

$length_g = 0;

$length_m = 0;

$mode1 = "";

$mode2 = "";

$number1 = "";



//department and grade must be set

if(!empty($_POST['department'])){

	$department = $_POST['department'];//is an array

	$length_d = count($department);

}

if(!empty($_POST['grade'])){

	$grade = $_POST['grade'];

	$length_g = count($grade);

}



if(!empty($_POST["select0"]))$number1 = $_POST["select0"];



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



//start

if(!empty($_POST['mode']) && !empty($_POST['select1'])){//mode is set

	foreach ($_POST["select1"] as $selectedOption){

		$mode1 .= (string)$number1 . (string)$selectedOption . '-';

		$mode2 .= (string)$number1 . (string)$selectedOption . '-';

	}

	$mode1 = rtrim($mode1, "-");
	$mode2 = rtrim($mode2, "-");

	$mode1 = explode("-", $mode1);
	$length_m = count($mode1);

	$mode = $_POST['mode'];

	if($mode == '1'){

		if(!empty($_POST['department']) && !empty($_POST['grade'])){

			if(!empty($_POST['courseName'])){

				$courseName = $_POST['courseName'];

				for($i=0; $i < $length_d; $i++) { 

					for($j=0; $j < $length_g; $j++){

						for($k = 0; $k < $length_m; $k++){

							if($grade[$j] == 'none'){

								$query = "SELECT *

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND C.courseName LIKE '%$courseName%'

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";
							}

							else if($grade[$j] == 'underGraduate'){

								$query = "SELECT *

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND (C.grade = '1'

								OR C.grade = '2'

								OR C.grade = '3'

								OR C.grade = '4'

								)

								AND C.courseName LIKE '%$courseName%'

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";			

							}

							else if($grade[$j] == 'graduate'){

								$query = "SELECT *

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND (C.grade = '5'

								OR C.grade = '6'

								)

								AND C.courseName LIKE '%$courseName%'

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";		

							}

							else{//grade is number

							$query = "SELECT * 

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND C.grade = \"$grade[$j]\"

								AND C.courseName LIKE '%$courseName%'

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";	

							}

							echo "$query<br>";

							$result = $mysqli->query($query);

							while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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
						}

					}
				}

			}

			else{
				for($i=0; $i < $length_d; $i++) { 

					for($j=0; $j < $length_g; $j++){

						for($k = 0; $k < $length_m; $k++){

							if($grade[$j] == 'none'){

								$query = "SELECT *

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";
							}

							else if($grade[$j] == 'underGraduate'){

								$query = "SELECT *

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND (C.grade = '1'

								OR C.grade = '2'

								OR C.grade = '3'

								OR C.grade = '4'

								)

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";			

							}

							else if($grade[$j] == 'graduate'){

								$query = "SELECT *

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND (C.grade = '5'

								OR C.grade = '6'

								)

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";		

							}

							else{//grade is number

							$query = "SELECT * 

								FROM course C

								WHERE C.department = \"$department[$i]\"

								AND C.grade = \"$grade[$j]\"

								AND C.courseTime LIKE \"%$mode1[$k]%\"

								";	

							}

							echo "$query<br>";

							$result = $mysqli->query($query);

							while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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
						}

					}
				}
			}

		}

		else{

			if(!empty($_POST['courseName'])){

				$courseName = $_POST['courseName'];

				for($k = 0; $k < $length_m; $k++){

					$query = "SELECT *

					FROM course C

					WHERE C.courseTime LIKE '$mode1'

					AND C.courseTime LIKE \"%$mode1[$k]%\"

					";

					echo "$query<br>";

					$result = $mysqli->query($query);

					while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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
				}
			}

			else{

				for($k = 0; $k < $length_m; $k++){

					$query = "SELECT *

					FROM course C

					WHERE C.courseTime LIKE \"%$mode1[$k]%\"

					";

					echo "$query<br>";

					$result = $mysqli->query($query);

					while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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
				}

			}

		}



	}

	else{//mode == 2

		if(!empty($_POST['department']) && !empty($_POST['grade'])){

			if(!empty($_POST['courseName'])){

				$courseName = $_POST['courseName'];

				for($i=0; $i < $length_d; $i++) { 

					for($j=0; $j < $length_g; $j++){

						if($grade[$j] == 'none')

							$query = "SELECT *

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND C.courseName LIKE '%$courseName%'

							AND C.courseTime = '$mode2'

							";

						else if($grade[$j] == 'underGraduate'){

							$query = "SELECT *

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND (C.grade = '1'

							OR C.grade = '2'

							OR C.grade = '3'

							OR C.grade = '4'

							)

							AND C.courseName LIKE '%$courseName%'

							AND C.courseTime = '$mode2'

							";			

						}

						else if($grade[$j] == 'graduate'){

							$query = "SELECT *

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND (C.grade = '5'

							OR C.grade = '6'

							)

							AND C.courseName LIKE '%$courseName%'

							AND C.courseTime = '$mode2'

							";		

						}

						else{//grade is number

						$query = "SELECT * 

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND C.grade = \"$grade[$j]\"

							AND C.courseName LIKE '%$courseName%'

							AND C.courseTime = '$mode2'

							";	

						}

						echo "$query<br>";

						$result = $mysqli->query($query);

						while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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

					}

					

				}

			}

			else{

				for($i=0; $i < $length_d; $i++) { 

					for($j=0; $j < $length_g; $j++){

						if($grade[$j] == 'none')

							$query = "SELECT *

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND C.courseTime = '$mode2'

							";

						else if($grade[$j] == 'underGraduate'){

							$query = "SELECT *

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND (C.grade = '1'

							OR C.grade = '2'

							OR C.grade = '3'

							OR C.grade = '4'

							)

							AND C.courseTime = '$mode2'

							";			

						}

						else if($grade[$j] == 'graduate'){

							$query = "SELECT *

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND (C.grade = '5'

							OR C.grade = '6'

							)

							AND C.courseTime = '$mode2'

							";		

						}

						else{//grade is number

						$query = "SELECT * 

							FROM course C

							WHERE C.department = \"$department[$i]\"

							AND C.grade = \"$grade[$j]\"

							AND C.courseTime = '$mode2'

							";	

						}

						echo "$query<br>";

						$result = $mysqli->query($query);

						while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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

					}

					

				}

			}

		}

		else{

			if(!empty($_POST['courseName'])){

				$courseName = $_POST['courseName'];

				$query = "SELECT *

				FROM course C

				WHERE C.courseTime = '$mode2'

				AND C.courseName LIKE '%$courseName%'

				";

				echo "$query<br>";

				$result = $mysqli->query($query);

				while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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

			}

			else{

				$query = "SELECT *

				FROM course C

				WHERE C.courseTime = '$mode2'

				";

				echo "$query<br>";

				$result = $mysqli->query($query);

				while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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

			}

		}

	}

}

else{

	if(!empty($_POST['courseName'])){

		$courseName = $_POST['courseName'];

		for($i=0; $i < $length_d; $i++) { 

			for($j=0; $j < $length_g; $j++){

				if($grade[$j] == 'none')

					$query = "SELECT *

					FROM course C

					WHERE C.department = \"$department[$i]\"

					AND C.courseName LIKE '%$courseName%'

					";

				else if($grade[$j] == 'underGraduate'){

					$query = "SELECT *

					FROM course C

					WHERE C.department = \"$department[$i]\"

					AND (C.grade = '1'

					OR C.grade = '2'

					OR C.grade = '3'

					OR C.grade = '4'

					)

					AND C.courseName LIKE '%$courseName%'

					";			

				}

				else if($grade[$j] == 'graduate'){

					$query = "SELECT *

					FROM course C

					WHERE C.department = \"$department[$i]\"

					AND (C.grade = '5'

					OR C.grade = '6'

					)

					AND C.courseName LIKE '%$courseName%'

					";		

				}

				else{//grade is number

				$query = "SELECT * 

					FROM course C

					WHERE C.department = \"$department[$i]\"

					AND C.grade = \"$grade[$j]\"

					AND C.courseName LIKE '%$courseName%'

					";	

				}

				echo "$query<br>";

				$result = $mysqli->query($query);

				while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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

			}

		}

	}

	else{

		for($i=0; $i < $length_d; $i++) { 

			for($j=0; $j < $length_g; $j++){

				//echo "grade is $grade[$j]<br>";

				if($grade[$j] == 'none')

					$query = "SELECT *

					FROM course C

					WHERE C.department = \"$department[$i]\"

					";

				else if($grade[$j] == 'underGraduate'){

					$query = "SELECT *

					FROM course C

					WHERE C.department = \"$department[$i]\"

					AND (C.grade = '1'

					OR C.grade = '2'

					OR C.grade = '3'

					OR C.grade = '4'

					)

					";			

				}

				else if($grade[$j] == 'graduate'){

					$query = "SELECT *

					FROM course C

					WHERE C.department = \"$department[$i]\"

					AND (C.grade = '5'

					OR C.grade = '6'

					)

					";		

				}

				else{//grade is number

				$query = "SELECT * 

					FROM course C

					WHERE C.department = \"$department[$i]\"

					AND C.grade = \"$grade[$j]\"

					";	

				}

				echo "$query<br>";

				$result = $mysqli->query($query);

				while($row = $result->fetch_assoc()){

						echo "<tr>";
						echo "<td>" . $row['courseName'] . "</td>";
						echo "<td>" . $row['profID'] . "</td>";
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

			}

			

		}

	}

}

echo '</table>';
?>