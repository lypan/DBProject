<?php

include "link.php";

$account = $_SESSION["account"];
$idNumber = $_SESSION["idNumber"];
$position = $_SESSION["position"];

if($_SESSION["privilege"] == 'professor'){
	//find info
	$query = "SELECT * FROM  $position WHERE account='$account'";
	$result = $mysqli->query($query);
	//list info
	while ($row = $result->fetch_assoc()){
		$password = $row['password'];
		$name = $row['name'];
		$department = $row['department'];
	}	
}
?>
<script type="text/javascript">
    var compare = {
    	account:'<?php echo $account?>',
    	name:'<?php echo $name?>',
     	idNumber:'<?php echo $idNumber?>',
     	department:'<?php echo $department?>',
    };   
</script>

<form  method="post" action="updateProfile.php?type=professor">
	<label>Account</label>
	<input id="proAccount" name="account" type="text" value=<?php echo $account?> class="input-xlarge" onblur="update(this, compare.account,document.getElementById('proAccountHelp'));">
	<span class="help-block" id="proAccountHelp"></span>
	<label>Old Password</label>
	<input id="proPassword" name="password" type="password" value="" class="input-xlarge" onchange="updatePassword(this,document.getElementById('proPasswordHelpOld'));">
	<span class="help-block" id="proPasswordHelpOld"></span>
	<label>New Password</label>
	<input id="nproPassword" name="npassword" type="password" value="" class="input-xlarge" onchange="updatePassword(this,document.getElementById('proPasswordHelpNew'));">
	<span class="help-block" id="proPasswordHelpNew"></span>
	<label>Name</label>
	<input id="proName" name="name" type="text" value=<?php echo $name?> class="input-xlarge"  onchange="validateName(this,document.getElementById('proNameHelp'));">
	<span class="help-block" id="proNameHelp"></span>
	<label>IDNumber</label>
	<input id="proID" name="idNumber" type="text" value=<?php echo $idNumber?> class="input-xlarge" onblur="update(this,compare.idNumber,document.getElementById('proIDHelp'));">
	<span class="help-block" id="proIDHelp"></span>
	<div>
		<button class="btn btn-primary">Update Profile</button>
	</div>
	<span class="help-block" id="proUpdateHelp"></span>
</form>
