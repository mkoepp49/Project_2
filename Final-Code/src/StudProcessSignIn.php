<?php
session_start();

// Variables needed, send them to the student home UI
$firstn = strtoupper($_POST["firstN"]);
$lastn = strtoupper($_POST["lastN"]);
$studid = strtoupper($_POST["studID"]);
$email = $_POST["email"];
$major = $_POST["major"];
$logIn = "X";

// add to DB, with "X" in status
include_once('../CommonMethods.php');
$COMMON = new Common($debug);


// check if user already added in current session
$currStatus = $_SESSION["created"];
$currentId = $_SESSION["userId"];

// if so, then update the current temp data
if ($currStatus == "X"){
	$sql = "update `Proj2Students` set `FirstName` = '$firstn', `LastName` = '$lastn', `Email` = '$email', `Major` = '$major', `Status` = '$logIn' where `id` = '$currentId'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}
else{
	$sql = "insert into Proj2Students (`FirstName`, `LastName`, `StudentID`, `Email`, `Major`, `Status`) values ('$firstn','$lastn','$studid','$email','$major','$logIn')";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	// get id created
	$userId = mysql_insert_id();

	// set sessions variables needed
	$_SESSION["userId"] = $userId;
	$_SESSION["created"] = $logIn;
}

header('Location: 02StudHome.php');
?>