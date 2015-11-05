<?php
session_start();
// This file shows the student appoint by pulling it off the DB
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

$studID = $_SESSION["studID"]; // id entered at login
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>View Appointment</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>View Appointment</h1>
	    <div class="field">
	    <?php
	    	// Brings up the row on DB with student id 
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			// if for some reason there really isn't a match, (something got messed up, tell them there really isn't one there)
			$num_rows = mysql_num_rows($rs);

			// if DB exists
			if($num_rows > 0)
			{
				// get enumerated array from DB
				$row = mysql_fetch_row($rs); 
				$advisorID = $row[2];
				$datephp = strtotime($row[1]);
				
				// if not group
				if($advisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$advisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$advisorName = $row2[1] . " " . $row2[2];
					$advLocation = $row2[5];
				}
				// if group
				else{$advisorName = "Group";}
			
				// print out appointment
				echo "<label for='info'>";
				echo "Advisor: ", $advisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $datephp), "<br>";
				echo "Location: ", $advLocation, "</label>";
			}
			// something is up, and there DB table needs to be fixed
			else
			{
				echo("No appointment was detected. It may have been cancelled. Please make another appointment.");
				$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studID'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}
	

		?>
        </div>
        <!-- 
        back to student homepage 02
        -->
	    <div class="finishButton">
			<button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
	    </div>
		</div>
		</form>
  </body>
</html>