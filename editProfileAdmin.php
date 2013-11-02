<?php

include "link.php";

$account = $_SESSION["account"];
$idNumber = $_SESSION["idNumber"];
$position = $_SESSION["position"];


if($_SESSION["privilege"] == 'admin'){
	//find info
	$query = "SELECT * FROM  $position WHERE account='$account'";
	$result = $mysqli->query($query);
	//list info
	while ($row = $result->fetch_assoc()){
		$password = $row['password'];
		$name = $row['name'];
	}
}

?>
<script type="text/javascript">
    var compare = {
    	account:'<?php echo $account?>',
     	idNumber:'<?php echo $idNumber?>',
     	name:'<?php echo $name?>'
    };   
</script>

<form  method="post" action="updateProfile.php">
	<label>Account</label>
	<input id="adminAccount" name="account" type="text" value=<?php echo $account?> class="input-xlarge" onblur="update(this, compare.account,document.getElementById('adminAccountHelp'));">
	<span class="help-block" id="adminAccountHelp"></span>
	<label>Old Password</label>
	<input id="adminPassword" name="password" type="password" value="" class="input-xlarge" onchange="updatePassword(this,document.getElementById('adminPasswordHelpOld'));">
	<span class="help-block" id="adminPasswordHelpOld"></span> <label>New Password</label>
	<input id="nadminPassword" name="npassword" type="password" value="" class="input-xlarge" onchange="updatePassword(this,document.getElementById('adminPasswordHelpOld'));">
	<span class="help-block" id="nadminPasswordHelpNew"></span>
	<label>Name</label>
	<input id="adminName" name="name" type="text" value=<?php echo $name?> class="input-xlarge"  onchange="validateName(this,document.getElementById('adminNameHelp'));">
	<span class="help-block" id="stdNameHelp"></span>
	<label>IDNumber</label>
	<input id="adminID" name="idNumber" type="text" value=<?php echo $idNumber?> class="input-xlarge" onblur="update(this, compare.idNumber,document.getElementById('adminIDHelp'));">
	<span class="help-block" id="adminIDHelp"></span>
	<div>
		<button class="btn btn-primary">Update Profile</button>
	</div>
	<span class="help-block" id="proUpdateHelp"></span>
</form>
