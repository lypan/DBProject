<?php

include "link.php";

$account = $_SESSION["account"];
$idNumber = $_SESSION["idNumber"];
$position = $_SESSION["position"];

if($_SESSION["privilege"] == 'student'){
	//find info
	$query = "SELECT * FROM  $position WHERE account='$account'";
	$result = $mysqli->query($query);
	//list info
	while ($row = $result->fetch_assoc()){
		$password = $row['password'];
		$name = $row['name'];
		$department = $row['department'];
		$grade = $row['grade'];
	}		
}
?>
<script type="text/javascript">
    var compare = {
    	account:'<?php echo $account?>',
    	name:'<?php echo $name?>',
     	idNumber:'<?php echo $idNumber?>',
     	department:'<?php echo $department?>',
    	grade:'<?php echo $grade?>'
    };   
</script>

<form  method="post" action="updateProfile.php?type=student">
	<label>Account</label>
	<input id="stdAccount" name="account" type="text" value=<?php echo $account?> class="input-xlarge" 
	onblur="update(this, compare.account,document.getElementById('stdAccountHelp'));">
	<span class="help-block" id="stdAccountHelp"></span>
	<label>Old Password</label>
	<input id="stdPassword" name="password" type="password" value="" class="input-xlarge" onchange=
	"updatePassword(this,document.getElementById('stdPasswordHelpOld'));">
	<span class="help-block" id="stdPasswordHelpOld"></span>
	<label>New Password</label>
	<input id="nstdPassword" name="npassword" type="password" value="" class="input-xlarge" onchange=
	"updatePassword(this,document.getElementById('stdPasswordHelpNew'));">
	<span class="help-block" id="stdPasswordHelpNew"></span>
	<label>Name</label>
	<input id="stdName" name="name" type="text" value=<?php echo $name?> class="input-xlarge"  onchange=
	"validateName(this,document.getElementById('stdNameHelp'));">
	<span class="help-block" id="stdNameHelp"></span>
	<label>IDNumber</label>
	<input id="stdID" name="idNumber" type="text" value=<?php echo $idNumber?> class="input-xlarge" 
	onblur="update(this,compare.idNumber,document.getElementById('stdIDHelp'));">
	<span class="help-block" id="stdIDHelp"></span>
	<label>Department</label>
	<select id="stdDepartment" name="department">
		<option><?php echo $department?></option>
	</select>
	<label>Grade</label>
	<select id="stdGrade" name="grade">
		<option><?php echo $grade?></option>
	</select>
	<div>
		<button class="btn btn-primary">Update Profile</button>
	</div>
	<span class="help-block" id="proUpdateHelp"></span>
</form>
