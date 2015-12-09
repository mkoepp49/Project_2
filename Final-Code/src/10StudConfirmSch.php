<?php
session_start();
$_SESSION["appTime"] = $_POST["appTime"]; // radio button selection from previous form
include ('../studHeader.php');
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Confirm Appointment</title>
	<!-- Link the appropriate css file from the css folder, used to reduce file length -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>  
  </head>
  <body>
	<div id="login">
      <div id="form">
        <div class="top">
		<h1>Confirm Appointment</h1>
	    <div class="field">
		<form action = "StudProcessSch.php" method = "post" name = "SelectTime">
	    <?php
			$debug = false;
			include ('../Data.php');
			include_once('../CommonMethods.php');
			$COMMON = new Common($debug);
			
			
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			//$roomToMeet = $row[7];
			
			// If the student rescheduled,
			// grab the student from the appointment DB
			if($_SESSION["resch"] == true){
				
				$oldAdvisorID = $row[2];
				$oldDatephp = strtotime($row[1]);
				
				// If individual Appt
				if($oldAdvisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$oldAdvisorName = $row2[1] . " " . $row2[2];
					$advisorOffice = $row2[3];
					// Set the variable for appointment meeting room 
					$roomToMeet = $row2[6];
				}
				// Otherwise group Appt
				else{$oldAdvisorName = "Group";}
				
				// Print out info to the user, with the outdated information
				// Addition of Advisor's Office here for consistency
				echo "<label for='info'>";
				echo "<h2>Previous Appointment</h2>";
				echo "Advisor: ", $oldAdvisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp), "<br>";
				echo "Advisor Office: ", $advisorOffice,"<br>";
				// Appt meeting room location
				echo "Appointment Meeting Located in: ", $roomToMeet, "</label>";
			}
			
			// set the updated/current information for student
			$currentAdvisorName;
			$currentAdvisorID = $_SESSION["advisor"];
			$currentDatephp = strtotime($_SESSION["appTime"]);
			
			// If individual appt
			if($currentAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$currentAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);
				$currentAdvisorName = $row2[1] . " " . $row2[2];
				// Addition of Advisor's Office
				$advisorOffice = $row2[3];
				// Addition of Advisor's Appointment Room
				$roomToMeet = $row2[6];
			}
			// Otherwise group Appt
			else{$currentAdvisorName = "Group";}
			
			// Display Current Appt to user
			echo "<label for='info'>";
			echo "<h2>Current Appointment</h2>";
			echo "<label for='newinfo'>";
			echo "Advisor: ",$currentAdvisorName,"<br>";
			echo "Appointment: ",date('l, F d, Y g:i A', $currentDatephp),"<br>";
			echo "Advisor Office: ", $advisorOffice,"<br>";
			// Appt meeting room location
			echo "Appointment Located in: ", $roomToMeet, "<br>";
		?>
        </div>
	    <div class="nextButton">
		<?php
			// let the user either reschedule the appt, or submit 
			if($_SESSION["resch"] == true){
				echo "<input type='submit' name='finish' class='button large go' value='Reschedule'>";
			}
			else{
				echo "<input type='submit' name='finish' class='button large go' value='Submit'>";
			}
		?>
			<input style="margin-left: 50px" type="submit" name="finish" class="button large" value="Cancel">
	    </div>
		</form>
		</div>
  </body>
  
  <?php
include ('../footer.php');
?>
</html>