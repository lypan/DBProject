<?php
session_start();
include "link.php";
$query = "SELECT department FROM department";
$result = $mysqli->query($query);
?>
<!Doctype html>

<html>

	<head>

		<meta charset = "utf-8"/>

		<title>Index</title>

		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

		<link href="style.css" rel="stylesheet" media="screen">

		<script src="http://code.jquery.com/jquery-latest.js"></script>

    	<script src="js/bootstrap.min.js"></script>

    	<script src="js/formValidation.js"></script>

	</head>



	<body>
		<br/><br/>
		<br/><br/>
		<br/><br/>
		<div class="container">	
			<div class="well">

		        <ul class="nav nav-tabs">
		          <li class="active"><a href="#loginTab" data-toggle="tab">Login</a></li>
		          <li><a href="#createStudent" data-toggle="tab">Create Account(student)</a></li>
		          <li><a href="#createProfessor" data-toggle="tab">Create Account(professor)</a></li>
		        </ul>

	         
		        <div class="tab-content">
				    <div class="tab-pane active in" id="loginTab">
						<form class="form-horizontal" method="post" action="login.php">
						<fieldset>

						<!-- Form Name -->
						<legend>Login</legend>

						<!-- Text input-->
						<div class="control-group">
						  <label class="control-label">account</label>
						  <div class="controls">
						    <input id="account" name="account" type="text" placeholder="input account" class="input-xlarge" required="">
						    <p class="help-block"></p>
						  </div>
						</div>

						<!-- Password input-->
						<div class="control-group">
						  <label class="control-label">password</label>
						  <div class="controls">
						    <input id="password" name="password" type="password" placeholder="input password" class="input-xlarge" required="">
						    <p class="help-block"></p>
						  </div>
						</div>

						<!-- Button -->
						<div class="control-group">
						  <label class="control-label"></label>
						  <div class="controls">
						    <button id="login" name="login" class="btn btn-primary">login</button>
						  </div>
						</div>

						</fieldset>
						</form>
					</div>
					<!-- Register(student) -->
					<div class="tab-pane fade" id="createStudent">
						<form id="tabS" method="post" action="register.php?type=student" 
						onsubmit="return submitStudentForm();">
							<label>Account</label>
							<input id="stdAccount" name="account" type="text" value="" 
							class="input-xlarge" onblur="validateAccountAndID(this,document.getElementById('stdAccountHelp'));">
							<span class="" id="stdAccountHelp"></span>
							<label>Password</label>
							<input id="stdPassword" name="password" type="password" value="" 
							class="input-xlarge" onblur="validatePassword(this,document.getElementById('stdPasswordHelp'));">
							<span class="help-block" id="stdPasswordHelp"></span>
							<label>Name</label>
							<input id="stdName" name="name" type="text" value="" 
							class="input-xlarge" onblur="validateName(this,document.getElementById('stdNameHelp'));">
							<span class="help-block" id="stdNameHelp"></span>
							<label>IDNumber</label>
							<input id="stdID" name="idNumber" type="text" value="" 
							class="input-xlarge" onblur="validateAccountAndID(this,document.getElementById('stdIDHelp'));">
							<span class="help-block" id="stdIDHelp"></span>
							<label>Department</label>
							<select id="stdDepartment" name="department">
						    	<?php
									while ($row = $result->fetch_assoc()){
											echo"<option>";
											echo $row['department'];
											echo"</option>";
								}
								?>
							</select>
							<label>Grade</label>
							<select id="stdGrade" name="grade">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
							</select>
							<div>
								<button class="btn btn-primary">Create Account</button>
							</div>
							<span class="help-block" id="stdRegisterHelp"></span>
						</form>
					</div>

					<div class="tab-pane fade" id="createProfessor">
						<form id="tabP" method="post" action="register.php?type=professor" 
						onsubmit="return submitProfessorForm();">
							<label>Account</label>
							<input id="profAccount" name="account" type="text" value="" 
							class="input-xlarge" onblur="validateAccountAndID(this,document.getElementById('profAccountHelp'));">
							<span class="help-block" id="profAccountHelp"></span>
							<label>Password</label>
							<input id="profPassword" name="password" type="password" value="" 
							class="input-xlarge" onblur="validatePassword(this,document.getElementById('profPasswordHelp'));">
							<span class="help-block" id="profPasswordHelp"></span>
							<label>Name</label>
							<input id="profName" name="name" type="text" value="" 
							class="input-xlarge" onblur="validateName(this,document.getElementById('profNameHelp'));">
							<span class="help-block" id="profNameHelp"></span>
							<label>StaffNumber</label>
							<input id="profID" name="idNumber" type="text" value="" 
							class="input-xlarge" onblur="validateAccountAndID(this,document.getElementById('profIDHelp'));">
							<span class="help-block" id="profIDHelp"></span>
							<label>Department</label>
							<select id="profDepartment" name = "department">
						    	<?php
						    		mysqli_data_seek($result, 0) ;
									while ($row = $result->fetch_assoc()){
											echo"<option>";
											echo $row['department'];
											echo"</option>";
								}
								?>
							</select>
							<div>
								<button class="btn btn-primary">Create Account</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</body>

</html>	