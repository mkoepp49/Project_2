<?php
session_start();
// if the type of appt is a group one
if ($_POST["type"] == "Group"){
	$_SESSION["advisor"] = $_POST["type"];
	// redirect appropriately
	header('Location: 08StudSelectTime.php');
}
// if the type of appt is an individual one
elseif ($_POST["type"] == "Individual"){
// redirect appropriately
	header('Location: 07StudSelectAdvisor.php');
}
?>