<?php
include "link.php";

$query = "SELECT account FROM  permission";
$result = $mysqli->query($query);

?>

<form  method="post" action="handleUser.php">
	<label>Choose Account</label>
	<select name='account'>
	<?php	
	while ($row = $result->fetch_assoc()){
		echo "<option>";
		echo $row['account'];
		echo "</option>";
		}
	?>
	</select>
	<span class="help-block" id="accountHelp"></span>
	<label>Delete Member</label>
	<select name='deleteMember'>
		<option>remain</option>
		<option>delete</option>
	</select>
	<span class="help-block" id="deleteMemberHelp"></span>
	<label>Change Password</label>
	<input id="changePassword" name="changePassword" type="password" value="" class="input-xlarge" onchange="updatePassword(this,document.getElementById('changePasswordHelp'));">
	<span class="help-block" id="changePasswordHelp"></span>
	<label>Change Permission</label>
	<select name='changePermission'>
		<option>remain</option>
		<option>student</option>
		<option>professor</option>
		<option>admin</option>
	</select>
	<span class="help-block" id="changePermissionHelp"></span>
	<div>
		<button class="btn btn-primary">Update Profile</button>
	</div>
	<span class="help-block"></span>
</form>

<?php
$query = "SELECT * FROM  permission";
$result = $mysqli->query($query);

echo '<table class="table table-striped">
		<tr>
		<td>Account Name</td>
		<td>ID Number</td>
		<td>Privilege</td>
		</tr>';

		while ($row = $result->fetch_assoc()){
				echo "<tr>";
				echo "<td>" . $row['account'] . "</td>";
				echo "<td>" . $row['idNumber'] . "</td>";
				echo "<td>" . $row['privilege'] . "</td>";
				echo "</tr>";
		}
echo '</table>';
?>