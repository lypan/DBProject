<?php
include "link.php";
$name = $_SESSION["name"];
?>
<script type="text/javascript">
    var compare = {
     	name:'<?php echo $name?>'
    };   
</script>
<form method="post" action="insertCourse.php" onsubmit="return submitTeachCourseForm();">
	<label>courseName</label>
	<input id="courseName" name="courseName" type="text" value="" class="input-xlarge" 
	onblur="validateNonEmpty(this,document.getElementById('courseNameHelp'));">
	<span class="help-block" id="courseNameHelp"></span>
	<label>teacherName</label>
	<input id="teacherName" name="teacherName" type="text" value=<?php echo $name?> class="input-xlarge"
	onblur="update(this, compare.name,document.getElementById('teacherNameHelp'));">
	<span class="help-block" id="teacherNameHelp"></span>
	<label>classroom</label>
	<input id="classroom" name="classroom" type="text" value="" class="input-xlarge"
	onblur="validateNonEmpty(this,document.getElementById('classroomHelp'));">
	<span class="help-block" id="classroomHelp"></span>
	<label>capacity</label>
	<input id="capacity" name="capacity" type="text" value="" class="input-xlarge"
	onblur="validateCapacity(this,document.getElementById('capacityHelp'));">
	<span class="help-block" id="capacityHelp"></span>
	<label>credit</label>
	<select name="credit" onblur="validateNonEmpty(this,document.getElementById('creditHelp'));">
		<option>0</option>
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
	</select>
	<span class="help-block" id="creditHelp"></span>
	<label>department</label>
	<select name="department">
    	<?php
    	$query = "SELECT * FROM  department";
		$result = $mysqli->query($query);
			while ($row = $result->fetch_assoc()){
					echo"<option>";
					echo $row['department'];
					echo"</option>";
		}
		?>
	</select>
	<span class="help-block" id="departmentHelp"></span>
	<label>grade</label>
	<select name="grade">
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
	</select>
	<span class="help-block" id="gradeHelp"></span>
	<label>obligatory</label>
	<select name="obligatory">
		<option>Yes</option>
		<option>No</option>
	</select>		
	<span class="help-block" id="obligatoryHelp"></span>
	<label>courseYear</label>
	<select name="courseYear">
		<?php
			for($i = 2012; $i <= 2112; $i ++)echo "<option>$i</option>";
		?>
	</select>
	<span class="help-block" id="courseYearHelp"></span>
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
		<button class="btn btn-primary">Create Course</button>
	</div>
</form>