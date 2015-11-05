<?php
// This File takes the $_POST from 01StudSignIn.html and stores it to the $_SESSION Calls

session_start();

$_SESSION["firstN"] = strtoupper($_POST["firstN"]);
$_SESSION["lastN"] = strtoupper($_POST["lastN"]);
$_SESSION["studID"] = strtoupper($_POST["studID"]);
$_SESSION["email"] = $_POST["email"];
$_SESSION["major"] = $_POST["major"];

// Gives raw HTTP to 02StudHome.php
header('Location: 02StudHome.php');
?>