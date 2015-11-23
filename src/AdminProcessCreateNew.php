<?php
session_start();


// options: delete this file, and just pass the values into adminCreateNew...
// 

// Set the variables needed to keep going with the creation
$_SESSION["AdvF"] = $_POST["firstN"];
$_SESSION["AdvL"] = $_POST["lastN"];
$_SESSION["AdvUN"] = $_POST["UserN"];
$_SESSION["AdvPW"] = $_POST["PassW"];
$_SESSION["AdvRN"] = $_POST["OfficeNum"];
$_SESSION["PassCon"] = false;

// If password is confirmed, then proceed
if($_POST["PassW"] == $_POST["ConfP"]){
	header('Location: AdminCreateNew.php');
}
// Otherwise, reloop to the file because not verified
elseif($_POST["PassW"] != $_POST["ConfP"]){
	$_SESSION["PassCon"] = true;
	header('Location: AdminCreateNewAdv.php');
}

?>
