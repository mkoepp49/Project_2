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
// need functino to check if in DB...


function checkDb($fn, $ln){
	// select the row from DB where first and last name match POST
	$sql = "select * from `Proj2Students` where `FirstName` = '$fn' and `lastName` = '$ln'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	$userId = $row[0];
	// not in main DB yet return 0
	if (empty($row)) {
		return 0;
	}
	else{
		return 1;
	}
}

function getNew($db){
	if ($db){
	$sql = "select * from `Proj2Students` where `Id` = '$userId'";
	}
	else {
		$sql = "select * from `Proj2TempData` where `Id` = '$userId'";
	}
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);

	return $row;
}

function delete($userId){
	// if ($db){
	// $sql = "select * from `Proj2Students` where `Id` = '$userId'";
	// }
	// else {
	// 	$sql = "select * from `Proj2TempData` where `Id` = '$userId'";
	// }
	// $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	// $row = mysql_fetch_row($rs);
	mysql_query( "delete from Proj2TempData" );

	return $row;
}
?>