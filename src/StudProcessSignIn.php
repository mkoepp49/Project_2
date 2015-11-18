<?php
session_start();

// Variables needed, send them to the student home UI
// $_SESSION["firstN"] = strtoupper($_POST["firstN"]);
// $_SESSION["lastN"] = strtoupper($_POST["lastN"]);
// $_SESSION["studID"] = strtoupper($_POST["studID"]);
// $_SESSION["email"] = $_POST["email"];
// $_SESSION["major"] = $_POST["major"];


$firstName = strtoupper($_POST["firstN"]);
$lastName = strtoupper($_POST["lastN"]);
$email = $_POST["email"];

//$sql = "select * from Proj2Students where `FirstName` = `$firstName` AND `LastName` = `$lastName` AND `Email` = `$email`";

// This will get the userId, which is unique for each student, into session
$_SESSION["userId"] = "SELECT `id` FROM `Proj2Advisors` WHERE `FirstName` = '$firstName' AND `LastName` = '$lastName' AND `Email` = '$email'";


header('Location: 02StudHome.php');
?>