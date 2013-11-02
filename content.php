<?php

$webNo = $_GET["webNo"];
$state = $webNo;
if($_SESSION["privilege"] == "student"){
	switch ($state) {
		case '0':
			include "editProfileStd.php";
			break;
		case '1':
			include "editCourse.php";
			break;
		case '2':
			include "editResult.php";
			break;
		case '3':
			include "editSearch.php";
			break;
		default:
			break;
	}
}
else if($_SESSION["privilege"] == "admin"){
		switch ($state) {
			case '0':
				include "editProfileAdmin.php";
				break;
			case '1':
				include "editUser.php";
				break;
			case '2':
				include "editCourseAdmin.php";
				break;
			case '3':
				include "editPermission.php";
				break;	
			case '4':
				include "editTeachList.php";
				break;
			case '5':
				include "editTeachCourse.php";
				break;	
			default:
				break;
		}
}
else if($_SESSION["privilege"] == "professor"){
		switch ($state) {
			case '0':
				include "editProfilePro.php";
				break;			
			case '1':
				include "editTeachList.php";
				break;
			case '2':
				include "editTeachCourse.php";
				break;
			case '3':
				include "editConstraint.php";
				break;
			case '4':
				include "editCourseTime.php";
				break;
			case '5':
				include "editCourseMember.php";
				break;			
			default:
				break;
		}
}
?>