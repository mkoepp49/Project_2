<?php 
session_start();
$userId = $_SESSION["userId"];


// need this to call mysql DB
include_once('../CommonMethods.php');
$COMMON = new Common($debug);

// //
// $database = "ejohn3";
// $pass = "Jt%FvNd=28%zwJ/#";
// $connect = mysql_connect("studentdb-maria.gl.umbc.edu", $database, $pass) or die("Could not connect to MySQL");
// $rs = @mysql_select_db($database, $connect) or die("Could not connect select $db database");

// $file = $_SERVER["SCRIPT_NAME"];
// $rs = mysql_query($sql, $this->conn) or die("Could not execute query '$sql' in $file"); 

// select the row from DB where first and last name match POST
if ($_SESSION['db']){
	$sql = "select * from `Proj2Students` where `Id` = '$userId'";
}
else {
	$sql = "select * from `Proj2TempData` where `Id` = '$userId'";
}
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$firstn = $row[1];
$lastn = $row[2];
$studid = $row[3];
$major = $row[5];
$email = $row[4];

// need a function for last case, where it deleted from tmp db when its in main db...
?>