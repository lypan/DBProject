<?php

include "link.php";

$query = "SELECT * FROM  permission WHERE privilege='student' OR privilege='professor'";
$result = $mysqli->query($query);

echo '<table class="table table-striped">
		<tr>
		<td>Account Name</td>
		<td>ID Number</td>
		<td>Privilege</td>
		<td>Suspend State</td>
		<td>Suspend It</td>
		<td>Don\'t Suspend It</td>
		</tr>';

		while ($row = $result->fetch_assoc()){
				echo "<tr>";
				echo "<td>" . $row['account'] . "</td>";
				echo "<td>" . $row['idNumber'] . "</td>";
				echo "<td>" . $row['privilege'] . "</td>";
				if($row['suspend'])echo "<td>Suspended</td>";
				else echo "<td>Not Suspended</td>";
				echo '<td><a class="btn btn-success" href=/suspendIt.php?account='.$row['account'].'>Suspend It'.'</a></td>';
				echo '<td><a class="btn btn-danger" href=/dontSuspendIt.php?account='.$row['account'].'>Dont suspend It'.'</a></td>';
				echo "</tr>";
		}

?>
