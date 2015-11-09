<?php
session_start();

// if the user selected the group button,
// redirect them to that appropriate file
if ($_POST["next"] == "Group"){
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminEditGroup.php');
}
// if the user selected the individual button
// redirect them to that appropriate file 
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminEditInd.php');
}

?>