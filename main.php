<?php
session_start();
include "link.php";

$position = $_SESSION["position"];
$idNumber = $_SESSION["idNumber"];

if($position == 'student'){

$query = "SELECT *
FROM notice N
WHERE N.stdID = '$idNumber'
";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
	$msg = $row['notice'];
	echo "<script type='text/javascript'>";
	echo "alert('$msg')";
	echo "</script>";
}

$query = "DELETE N.*
FROM notice N
WHERE N.stdID = '$idNumber'
";
$result = $mysqli->query($query);

}


?>

<!Doctype html>

<html>

	<head>

		<meta charset = "utf-8"/>

		<title>main</title>

		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

		<link href="style.css" rel="stylesheet" media="screen">

		<script src="http://code.jquery.com/jquery-latest.js"></script>

    	<script src="js/bootstrap.min.js"></script>

    	<script src="js/formValidation.js"></script>

	</head>



	<body>

    	<div class="navbar navbar-inverse">

			<div class="navbar-inner">

				<div class="container-fluid">

			    	<a class="brand" href="#">Title</a>

			    	<div class="nav-collapse collapse">

			    	<?php include "menu.php" ?>

				    	<div class="pull-right">
							<ul class="nav pull-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "Welcome!".$_SESSION["privilege"].':'.$_SESSION["name"]; ?>
										<b class="caret"></b>
									</a>
								</li>
							</ul>
				    	</div>

			    	</div>


			    </div>

			</div>

		</div>

    	<div class="container-fluid">

		  <div class="row-fluid">

		    <div class="span2">

		      <!--Left Sidebar content-->

		    </div>

		    <div class="span10">

		      

		      <div class="span8">

		      	<!--Body content-->

		      	<?php include "content.php" ?>

		      </div>



		      <div class="span2">

		      	<!--Right Submenu content-->

		      </div>

		      	

		    </div>

		  </div>

		</div>

	</body>

</html>