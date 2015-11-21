<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

// if a student cancels on the process
if($_POST["finish"] == 'Cancel')
{
	$_SESSION["status"] = "none";
	header('Location: 12StudExit.php');
}
// assign the needed variables from prior file
else
{
	$firstn = $_SESSION["userId"][1];
	$lastn = $_SESSION["userId"][2];
	$studid = $_SESSION["userId"][3];
	$major = $_SESSION["userId"][5];
	$email = $_SESSION["userId"][4];
	$advisor = $_SESSION["advisor"];
	$apptime = $_SESSION["appTime"];
	
	// if a student doesn't exist in the DB already, add them into mySQL database 
	if($_SESSION["studExist"] == false){
		$sql = "insert into Proj2Students (`FirstName`,`LastName`,`StudentID`,`Email`,`Major`) values ('$firstn','$lastn','$studid','$email','$major')";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}

	// ************************ Lupoli 9-1-2015
	// we have to check to make sure someone did not steal that spot just before them!! (deadlock)
	// if the spot was taken, need to stop and reset
	
	// the position is void and can be filled
	if( !isStillAvailable($apptime, $advisor) )
	// the position is filled, task has to be cancelled
	{
		if($debug == false) 
		{
			header('Location: 13StudDenied.php');
			return;
		}
	}

	else{
	// Update the Appointment's status now 
	if($_POST["finish"] == 'Submit'){
		// student scheduled for a group session
		if($_SESSION["advisor"] == 'Group') 
		{
			$sql = "select * from Proj2Appointments where `Time` = '$apptime' and `AdvisorID` = 0";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$groupids = $row[4];
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studid' where `Time` = '$apptime' and `AdvisorID` = 0";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		// student scheduled for an individual session
		else
		{
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studid' where `AdvisorID` = '$advisor' and `Time` = '$apptime'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		// remove redudant code from if/else	
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		// set student's status to schedule set
		$_SESSION["status"] = "complete";
	}
	// reschedule student
	elseif($_POST["finish"] == 'Reschedule'){
		//remove stud from EnrolledID
		$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		$oldAdvisorID = $row[2];
		$oldAppTime = $row[1];
		$newIDs = str_replace($studid, "", $row[4]);
		
		$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		
		//schedule new group appt 
		if($_SESSION["advisor"] == 'Group'){
			$sql = "select * from Proj2Appointments where `Time` = '$apptime' and `AdvisorID` = 0";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$groupids = $row[4];
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studid' where `Time` = '$apptime' and `AdvisorID` = 0";
			//$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		// update the student's individual appointment
		else{
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studid' where `Time` = '$apptime' and `AdvisorID` = '$advisor'";
			//$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$_SESSION["status"] = "resch";
	}

	//update stud status to ''
	$sql = "update `Proj2Students` set `Status` = '' where `StudentID` = '$studid'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	//if($debug == false) 
	//{ header('Location: 12StudExit.php'); }
}
}
// student status screen
if($debug == false) { header('Location: 12StudExit.php'); }


function isStillAvailable($apptime, $advisor)
{
	// advisor could be "Group"
	global $debug; global $COMMON;
	$sql = "";

	if($advisor == "Group")
	{ $sql = "select `EnrolledNum`, `Max` from `Proj2Appointments` where `Time` = '$apptime' and `AdvisorID` = 0";  }
	else // then specific
	{ $sql = "select `EnrolledNum`, `Max` from `Proj2Appointments` where `Time` = '$apptime' and `AdvisorID` = '$advisor'";  }
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);

	// if max [1] =< EnrolledNum[0], then the spot was indeed taken
	if($row[1] > $row[0]) // then all good
	{ 
		if($debug) { echo("spot available\n<br>"); }
		return true; 
	}
	else // spot was taken
	{
		if($debug) { echo("spot NOT available\n<br>"); }	
		return false; 
	}

}

?>