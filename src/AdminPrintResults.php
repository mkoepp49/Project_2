<?php
session_start();
$debug = false;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Print Schedule</title>
    <script type="text/javascript">
    function saveValue(target){
	var stepVal = document.getElementById(target).value;
	alert("Value: " + stepVal);
    }
    </script>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">

<?php

	// the variable from the html file to this file
	$date = $_POST["date"];
	$type = $_POST["type"];
			
	include('../CommonMethods.php');
	$COMMON = new Common($debug);

	  // variable from session for username
      $User = $_SESSION["adminUserId"][3];

	 // grab the first name and last name of advisor from the table and set them to variables 
      $id = $_SESSION["adminUserId"][0];
      $FirstName = $_SESSION["adminUserId"][1];
      $LastName = $_SESSION["adminUserId"][2];
		
		// print schedule for the user
			echo("<h2>Schedule for $FirstName $LastName<br>$date</h2>");
      $date = date('Y-m-d', strtotime($date));
	
	// if btoh individual type of appts
	if($_POST["type"] == 'Both')
	{
		displayGroup($id, $date);
		displayIndividual($id, $date);
	}
	// if individual, display the individual appt
	elseif($_POST["type"] == 'Individual') { displayIndividual($id, $date); }
	// if individual, display the group appt
	elseif($_POST["type"] == 'Group') { displayGroup($id, $date); }
	// if the type was not of the valid types ( individual, group ), then return error statement
	else { echo("Selection invalid"); }

?>
	<!-- return to main -->
	<form method="link" action="AdminUI.php">
	<input type="submit" name="next" class="button large go" value="Return to Home">
	<input type="button" name="print" class="button large go" value="Print" onClick="window.print()">
	</form>

	</div>
	</div>
	<?php include('./workOrder/workButton.php'); ?>
	</div>

  </body>
  
</html>


<?php

function displayGroup($id, $date)
{
	global $debug; global $COMMON;

	$sql = "SELECT `Time`, `Major`, `EnrolledID`, `EnrolledNum`, `Max` FROM `Proj2Appointments` 
	WHERE `Time` LIKE '$date%' AND `AdvisorID` = 0 AND `MAX` > 1 ORDER BY `Time` ";

	// ******************************************************************
	// Why is Advisor ID 0 above?? (and not id)
	// This is so everyone on staff can see it when viewing a schedule
	// Then only one advisor can schedule the group sessions
	// Lupoli - 8/18/15
	// ******************************************************************


       	$rs = $COMMON->executeQuery($sql, "Advising Appointments");
	$matches = mysql_num_rows($rs); // see how many rows were collected by the query
	if($debug) { echo("matches was $matches"); }
	if($matches == 0) { return; }

	// Print out the group appointment variables with Majors included in the set and number of people
	echo("<h3>Group Appointments:</h3>");
	echo("<table border='1'><th colspan='4'>Group Appointments</th>\n");
	echo("<tr><td width='60px'>Time:</td><td>Majors Included:</td><td>students enrolled</td><td>Number of seats</td></tr>\n");

        while ($row = mysql_fetch_array($rs, MYSQL_NUM)) 
	{
		echo("<tr>");
		echo("<td>".date('g:i A', strtotime($row[0]))."</td>");
                 echo("<td>".$row[1]."</td>");
		echo("<td>(".$row[3].")".$row[2]."</td>");
		echo("<td>".$row[4]."</td>");
		echo("</tr>\n");
	}
        echo("</table><br><br>\n");
}

function displayIndividual($id, $date)
{
	global $debug; global $COMMON;

		// Fetch from the appropriate query where the dates are alike and the advisorID matches
        $sql = "SELECT `Time`, `Major`, `EnrolledID` FROM `Proj2Appointments` 
        WHERE `Time` LIKE '$date%' AND `AdvisorID` = $id AND `MAX` = 1 ORDER BY `Time`";
        $rs = $COMMON->executeQuery($sql, "Advising Appointments");
	$matches = mysql_num_rows($rs); // see how many rows were collected by the query
	if($debug) { echo("matches was $matches"); }
	if($matches == 0) { return; }

	echo("<h3>Individual Appointments:</h3>");
	echo("<table border='1'><th colspan='4'>Individual Appointments</th>\n");
	echo("<tr><td width='60px'>Time:</td><td>Majors Included:</td><td>Student's name</td><td>Student ID</td></tr>\n");

	
	 // display the aspects of the appt to the user through fetching that DB 
        while ($row = mysql_fetch_array($rs, MYSQL_NUM)) 
	{
		echo("<tr>");
		echo("<td>".date('g:i A', strtotime($row[0]))."</td>");
                echo("<td>".$row[1]."</td>");
	        $trdsql = "SELECT `FirstName`, `LastName` FROM `Proj2Students` WHERE `StudentID` = '$row[2]'";
        		$trdrs = $COMMON->executeQuery($trdsql, "Advising Appointments");
		$trdrow = mysql_fetch_row($trdrs);
		echo("<td>".$trdrow[0]." ".$trdrow[1]."</td>");
		echo("<td>".$row[2]."</td>");
		echo("</tr>");
	}
        echo("</table><br><br>");
}
?>
