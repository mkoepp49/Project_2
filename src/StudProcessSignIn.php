<?php
session_start();
$debug = false;

// Holds values for first and last name to search table
$firstn = strtoupper($_POST["firstN"]);
$lastn = strtoupper($_POST["lastN"]);
$studid = strtoupper($_POST["studID"]);
$email = $_POST["email"];
$major = $_POST["major"];

// need this to call mysql DB
include_once('../CommonMethods.php');
$COMMON = new Common($debug);

// select the row from DB where first and last name match POST
$sql = "select * from `Proj2Students` where `FirstName` = '$firstn' and `lastName` = '$lastn'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$userId = $row[0];
$whichDb = 1;

// If name does not exist in Proj2Students, then add to Proj2TempData DB
if (empty($row)) {
$sql = "insert into Proj2TempData (`FirstName`, `LastName`, `StudentID`, `Email`, `Major`) values ('$firstn','$lastn','$studid','$email','$major')";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


// gets latest created unique id
$userId = mysql_insert_id();

// helps with Data.php, 0 means temp db
$whichDb = 0;
}

// Creates a session variable with id in DB of user
$_SESSION["userId"] = $userId;
$_SESSION['db'] = $whichDb;

header('Location: 02StudHome.php');
?>