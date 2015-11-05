<?php
session_start();

// For each option in 02 student side, calls specific header

// Sign up new appointment
if($_POST["selection"] == 'Signup'){
	header('Location: 03StudSelectType.php');
}

// View appointment
elseif($_POST["selection"] == 'View'){
	header('Location: 04StudViewApp.php');
}

// Reschedule appointment
elseif($_POST["selection"] == 'Reschedule'){
	$_SESSION["resch"] = true;
	header('Location: 03StudSelectType.php');
}

// Cancel appointment
elseif($_POST["selection"] == 'Cancel'){
	header('Location: 05StudCancelApp.php');
}

// Search for appointment
elseif($_POST["selection"] == 'Search'){
	header('Location: 09StudSearchApp.php');
}

// Edit info
elseif($_POST["selection"] == 'Edit'){
	header('Location: 06StudEditInfo.php');
}

?>