<?php
session_start();
$debug = false;
include ('../Data.php');
include_once('../CommonMethods.php');
$COMMON = new Common($debug);
include('../studHeader.php');
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Cancel Appointment</title>
	<!-- link the appropriate css to its own file to reduce the file size -->
 <link rel='stylesheet' type='text/css' href='../css/standard.css'/>  
 </head>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Cancel Appointment</h1>
	    <div class="field">
	    <?php
			
			
			// select the user from their DB query
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$oldAdvisorID = $row[2];
			$oldDatephp = strtotime($row[1]);				
			
			// if the advisor was an individual 
			if($oldAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);					
				$oldAdvisorName = $row2[1] . " " . $row2[2];
			}
			// if the advisor was an group
			else{$oldAdvisorName = "Group";}
			
			// this area will print the appointment to the user from the webpage 
			// before any changes are made
			echo "<h2>Current Appointment</h2>";
			echo "<label for='info'>";
			echo "<h3>Advisor: ", $oldAdvisorName, "<br>";
			echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp), "<br>";
			$advisorOffice = $row2[3];
			// The update for where the advisor's room is located as per a requirement
			echo "Advisor Office: ", $advisorOffice,"<br>";
			$apptRoom = $row[6];
			echo "Appointment Room: ", $apptRoom,"</label><br></h3>"; 	
			
		?>		
        </div>
	    <div class="finishButton">
			<!-- If user desires to change the appointment or keep it, they will say so
			by either button they click, send to the processing page -->
			<form action = "StudProcessCancel.php" method = "post" name = "Cancel">
			<input type="submit" name="cancel" class="button large go" value="Cancel">
			<input type="submit" name="cancel" class="button large" value="Home">
			</form>
	    </div>
		</div>
		<div class="bottom">
			<p>Click "Cancel" to cancel appointment. Click "Keep" to keep appointment.</p>
		</div>
		</form>
</body>

<?php
include('../footer.php');
?>
</html>