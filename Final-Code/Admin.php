<?php 
session_start();
$adminUserid = $_SESSION["adminUserid"];

// include ('../Admin.php');
// need this to call mysql DB
include_once('../CommonMethods.php');
$COMMON = new Common($debug);

// get info from DB
$sql = "select * from `Proj2Advisors` where `id` = '$adminUserid'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);


$User = $row[4];
$Pass = $row[5];


$FirstName = $row[1];
$LastName = $row[2];
$offNum = $row[3];
$apptNum = $row[6];
?>