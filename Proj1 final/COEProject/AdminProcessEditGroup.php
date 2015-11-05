<?php
session_start();

// manages choice made by admin in previous page
// wether to delete, or edit appointment
$_SESSION["GroupApp"] = $_POST["GroupApp"];
$_SESSION["Delete"] = false;

if ($_POST["next"] == "Delete Appointment"){
	$_SESSION["Delete"] = true;
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminConfirmEditGroup.php');
}
elseif ($_POST["next"] == "Edit Appointment"){
	header('Location: AdminProceedEditGroup.php');
}

?>