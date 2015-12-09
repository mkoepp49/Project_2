<?php
session_start();
$debug = false;
include ('../Data.php');
include_once('../CommonMethods.php');
$COMMON = new Common($debug);

// variables needed to update if user desires to cancel
if($_POST["cancel"] == 'Cancel'){
	
	//remove stud from EnrolledID
	$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	$oldAdvisorID = $row[2];
	$oldAppTime = $row[1];
	$newIDs = str_replace($studid, "", $row[4]);
	
	// update their DB after removing old appt
	$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-2, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//update stud status to noApp
	$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studid'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	$_SESSION["status"] = "cancel";
}
// otherwise keep everything as it is already, no updates needed
else{
	$_SESSION["status"] = "keep";
}
header('Location: 12StudExit.php');
?>