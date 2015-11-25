<?php 
session_start();
$userId = $_SESSION["userId"];


// need this to call mysql DB
include('../CommonMethods.php');
$COMMON = new Common($debug);

// select the row from DB where first and last name match POST
$sql = "select * from `Proj2Students` where `Id` = '$userId'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$firstn = $row[1];
$lastn = $row[2];
$studid = $row [3];
$major = $row [5];
$email = $row [4];
?>