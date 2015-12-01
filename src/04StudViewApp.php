<?php
session_start();
$debug = false;
include ('../Data.php');
include_once('../CommonMethods.php');
$COMMON = new Common($debug);

$studID = $studid ;

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>View Appointment</title>
	<!-- Link the appropriate css to its own file to reduce the file size -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>View Appointment</h1>
	    <div class="field">
	    <?php
		// Select the appointment based on the student's ID number in DB
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			// If for some reason there really isn't a match, 
			// (something got messed up, tell them there really isn't one there)
			$num_rows = mysql_num_rows($rs);

			// if there is a whole row to print out
			if($num_rows > 0)
			{
				// retrieve that data needed
				// ( the advisorID, date of appt )
				$row = mysql_fetch_row($rs);
				$advisorID = $row[2];
				$datephp = strtotime($row[1]);
				
				// if the advisor is individual,
				// select their name from the table
				if($advisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$advisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$advisorName = $row2[1] . " " . $row2[2];
				}
				// otherwise the advisor is group 
				else{$advisorName = "Group";}
			
				// then print out the text to the user 
				// describing advisor, appt, and location
				echo "<label for='info'>";
				echo "Advisor: ", $advisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $datephp),"<br>";
				$advisorOffice = $row2[3];
				// The update for where the advisor's room is located as per a requirement
				echo "Advisor Office: ", $advisorOffice,"</label>"; 
			}
			// An error occured, need to update the DB to no appt
			else 
			{
				echo("No appointment was detected. It may have been cancelled. Please make another appointment.");
				$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studID'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}
	

		?>
        </div>
	    <div class="finishButton">
			<!-- Let user return back to their Home UI -->
			<button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
	    </div>
		</div>
		</form>
  </body>
</html>
