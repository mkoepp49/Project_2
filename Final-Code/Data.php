<?php 
session_start();
$userId = $_SESSION["userId"];

// need this to call mysql DB
include_once('../CommonMethods.php');
$COMMON = new Common($debug);

// get info from DB
$sql = "select * from `Proj2Students` where `id` = '$userId'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$firstn = $row[1];
$lastn = $row[2];
$studid = $row[3];
$major = $row[5];
$email = $row[4];

// reworded variables for files that have diff names
$localMaj = $row[5];
$studID = $row[3];
?>