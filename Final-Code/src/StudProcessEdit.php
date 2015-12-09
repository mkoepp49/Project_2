<?php
session_start();


// other variables needed if an edit
$firstn = strtoupper($_POST["firstN"]);
$lastn = strtoupper($_POST["lastN"]);
$studid = $_SESSION["studID"];
$email = $_POST["email"];
$major = $_POST["major"];

$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
// // update the user's DB with the new information from an edit 
// if($_SESSION["studExist"] == true){
// 	$sql = "update `Proj2Students` set `FirstName` = '$firstn', `LastName` = '$lastn', `Email` = '$email', `Major` = '$major' where `StudentID` = '$studid'";
// 	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
// }


$currentId = $_SESSION["userId"];
$sql = "update `Proj2Students` set `FirstName` = '$firstn', `LastName` = '$lastn', `Email` = '$email', `Major` = '$major' where `id` = '$currentId'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
header('Location: 02StudHome.php');
?>