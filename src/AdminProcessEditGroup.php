<?php
session_start();

// Assign these variables to go to location AdminProceedEditGroup.php
$_SESSION["GroupApp"] = $_POST["GroupApp"];
$_SESSION["Delete"] = false;

// If the variable is to delete the appointment all together,
// confirm the deletion
if ($_POST["next"] == "Delete Appointment"){
	$_SESSION["Delete"] = true;
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminConfirmEditGroup.php');
}
// Otherwise edit the appointment
elseif ($_POST["next"] == "Edit Appointment"){
	header('Location: AdminProceedEditGroup.php');
}

?>