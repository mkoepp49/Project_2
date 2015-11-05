<?php
session_start();
// Call correct file based on input
if ($_POST["next"] == "Group"){
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminScheduleGroup.php');
}
elseif ($_POST["next"] == "Individual"){
	// done to reduce code in AdminConfirmSchGroup.php file
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminScheduleInd.php');
}

?>