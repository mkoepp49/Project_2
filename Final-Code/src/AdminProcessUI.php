<?php
session_start();
// from which ever form gets sent in from AdminUI.php, 
//process the form and then redirect the user to the desired
// location from the appropriate files 

// TO SCHEDULE
if($_POST["next"] == 'Schedule appointments'){
	header('Location: AdminScheduleApp.php');
}
// TO PRINT SCHEDULE
elseif($_POST["next"] == 'Print schedule for a day'){
	header('Location: AdminPrintSchedule.php');
}
// TO EDIT APPTS
elseif($_POST["next"] == 'Edit appointments'){
	header('Location: AdminEditApp.php');
}
// TO SEARCH APPTS
elseif($_POST["next"] == 'Search for an appointment'){
	header('Location: AdminSearchApp.php');
}
// TO CREATE A NEW ADMIN ACOUNT
elseif($_POST["next"] == 'Create new Admin Account'){
	header('Location: AdminCreateNewAdv.php');
}

?>