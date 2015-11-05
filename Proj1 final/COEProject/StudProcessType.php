<?php
session_start();
// This .php file calls the correct php file 
// depending of group or individual choice of type

// if group, then the advisor is set to type
if ($_POST["type"] == "Group"){
	$_SESSION["advisor"] = $_POST["type"];
	header('Location: 08StudSelectTime.php');
}
elseif ($_POST["type"] == "Individual"){
	header('Location: 07StudSelectAdvisor.php');
}
?>