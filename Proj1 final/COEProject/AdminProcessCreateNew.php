<?php
// This file takes the _post and checks password
session_start();

$_SESSION["AdvF"] = $_POST["firstN"];
$_SESSION["AdvL"] = $_POST["lastN"];
$_SESSION["Advloca"] = $_POST["loca"];
$_SESSION["AdvUN"] = $_POST["UserN"];
$_SESSION["AdvPW"] = $_POST["PassW"];
$_SESSION["PassCon"] = false;

// if password is same as confirm password moves to new file
if($_POST["PassW"] == $_POST["ConfP"]){
	header('Location: AdminCreateNew.php');
}
// else goes back to previous file
elseif($_POST["PassW"] != $_POST["ConfP"]){
	$_SESSION["PassCon"] = true;
	header('Location: AdminCreateNewAdv.php');
}

?>