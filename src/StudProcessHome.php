<?php
session_start();

// TO SIGN UP FOR APPT
if($_POST["selection"] == 'Signup'){
	header('Location: 03StudSelectType.php');
}
// TO VEIW AN EXISTENT APPT
elseif($_POST["selection"] == 'View'){
	header('Location: 04StudViewApp.php');
}
// TO RESCHEDULE AN EXISTENT APPT
elseif($_POST["selection"] == 'Reschedule'){
	$_SESSION["resch"] = true;
	header('Location: 03StudSelectType.php');
}
// TO CANCEL AN EXISTENT APPT
elseif($_POST["selection"] == 'Cancel'){
	header('Location: 05StudCancelApp.php');
}
// TO SEARCH FOR APPTS
elseif($_POST["selection"] == 'Search'){
	header('Location: 09StudSearchApp.php');
}
// TO UPDATE/CHANGE USER INFORMATION
elseif($_POST["selection"] == 'Edit'){
	header('Location: 06StudEditInfo.php');
}
// TO FIND ANY NEXT AVAILABLE APPT
elseif($_POST["selection"] == 'FindNext'){
	header('Location: 14StudFindNext.php');
}

?>