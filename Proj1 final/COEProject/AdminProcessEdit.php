<?php
session_start();
// if group calls group php if individual calls ind php
// If group advisor is set as group
if ($_POST["next"] == "Group"){
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminEditGroup.php');
}
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminEditInd.php');
}

?>