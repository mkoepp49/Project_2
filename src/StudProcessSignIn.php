<?php
session_start();
$debug = false;
// Variables needed, send them to the student home UI
//$_SESSION["firstN"] = strtoupper($_POST["firstN"]);
// $_SESSION["lastN"] = strtoupper($_POST["lastN"]);
// $_SESSION["studID"] = strtoupper($_POST["studID"]);
// $_SESSION["email"] = $_POST["email"];
// $_SESSION["major"] = $_POST["major"];

// Holds values for first and last name to search table
$firstName = strtoupper($_POST["firstN"]);
$lastName = strtoupper($_POST["lastN"]);

// need this to call mysql DB
include('../CommonMethods.php');
$COMMON = new Common($debug);

// select the row from DB where first and last name match POST
$sql = "select * from `Proj2Students` where `FirstName` = '$firstName' and `LastName` = '$lastName'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

// userId is the row of individual user
// Here is the key of each item in $userId array:
// 0,1,2,3,4,5,6
// ID, firstName, lastName, ID, EMAIL, MAJOR, STATUS
$userId = $row;


// new idea: 11/20
      // bascially store the entire row into session variable


//$_SESSION["firstN"] = $FirstName;
//$lastName = strtoupper($_POST["lastN"]);
//$email = $_POST["email"];

//$sql = "select * from Proj2Students where `FirstName` = `$firstName` AND `LastName` = `$lastName` AND `Email` = `$email`";

// This will get the userId, which is unique for each student, into session
// took out email for triple check
//$userId = "SELECT `id` FROM `Proj2Students` WHERE `FirstName` = '$firstName' AND `LastName` = '$lastName'";

// Creates a session variable array of userId row
$_SESSION["userId"] = $userId;

header('Location: 02StudHome.php');
?>