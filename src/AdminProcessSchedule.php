<?php
session_start();

// If it is a group, then schedule group
if ($_POST["next"] == "Group"){
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminScheduleGroup.php');
}
// Otherwise, schedule for an individual
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminScheduleInd.php');
}

?>