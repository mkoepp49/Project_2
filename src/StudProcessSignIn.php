<?php
session_start();
$debug = false;
// Variables needed, send them to the student home UI
//$_SESSION["firstN"] = strtoupper($_POST["firstN"]);
// $_SESSION["lastN"] = strtoupper($_POST["lastN"]);
// $_SESSION["studID"] = strtoupper($_POST["studID"]);
// $_SESSION["email"] = $_POST["email"];
// $_SESSION["major"] = $_POST["major"];


$firstName = strtoupper($_POST["firstN"]);
include('../CommonMethods.php');
$COMMON = new Common($debug);

$sql = "select * from `Proj2Students` where `FirstName` = '$firstName' and `LastName` = '$lastName'";
      $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
      $row = mysql_fetch_row($rs);
      $userId = $row[0];



//$_SESSION["firstN"] = $FirstName;
//$lastName = strtoupper($_POST["lastN"]);
//$email = $_POST["email"];

//$sql = "select * from Proj2Students where `FirstName` = `$firstName` AND `LastName` = `$lastName` AND `Email` = `$email`";

// This will get the userId, which is unique for each student, into session
// took out email for triple check
//$userId = "SELECT `id` FROM `Proj2Students` WHERE `FirstName` = '$firstName' AND `LastName` = '$lastName'";
$_SESSION["userId"] = $userId;


header('Location: 02StudHome.php');
?>