<?php
if($_SESSION["suspend"]){
	echo "<script type='text/javascript'>";
	echo "alert('You are suspended!');";
	echo "</script>";
	$menuList = array("logout");
	$menuFile = array("logout.php");
}
else {
	if($_SESSION["privilege"] == "student"){
	$menuList = array("Profile", "Course", "Result", "Search", "Logout");
	$menuFile = array("profile.php", "course.php", "result.php", "search.php", "logout.php");
	}
	else if($_SESSION["privilege"] == "admin"){
	$menuList = array("Profile", "User", "Course", "Permission", "TeachList", "TeachCourse", "Logout");
	$menuFile = array("profile.php", "user.php","course.php", "permission.php", "teachList.php", "teachCourse.php", "logout.php");
	}
	else if($_SESSION["privilege"] == "professor"){
	$menuList = array("Profile", "TeachList", "TeachCourse", "CourseConstraint", "CourseTime", "CourseEdit", "Logout");
	$menuFile = array("profile.php", "teachList.php", "teachCourse.php","constraint.php", "courseTime.php", "courseEdit.php", "logout.php");
	}
}

echo '<ul class="nav">';
for($i = 0; $i < count($menuList); $i++){
	echo '<li><a href=/'.$menuFile[$i].'?webNo='.$i.'>'.$menuList[$i].'</a></li>';
	echo '<li class="divider-vertical"></li>';
}
echo '</ul>';

?>

