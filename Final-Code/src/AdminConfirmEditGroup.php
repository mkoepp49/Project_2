<?php
session_start();
$debug = false;
include('../adminHeader.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Group Appointment</title>
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
		<div class="field">
        <?php
		// These are the variables set to this file from the form action of the html file
          $delete = $_SESSION["Delete"];
          $group = $_SESSION["GroupApp"];
          parse_str($group);
 
          include('../CommonMethods.php');
          $COMMON = new Common($debug);

			// if there was something reported as deleted 
          if($delete == true){
            echo("<h1>Removed Appointment</h1><br>");

			// select from the enrolled students who is being deleted from appt schedule
            $sql = "SELECT `EnrolledID` FROM `Proj2Appointments` WHERE `Time` = '$row[0]'
              AND `AdvisorID` = '0' 
              AND `Major` = '$row[1]' 
              AND `EnrolledNum` = '$row[2]'
              AND `Max` = '$row[3]'";
            $rs = $COMMON->executeQuery($sql, "Advising Appointments");

            $stds = mysql_fetch_row($rs);
	echo($stds[0]);
	    $stds = trim($stds[0]); // had some side white spaces sometimes
	    $stds = split(" ", $stds);

			// Print out the emails of those in appt deletion
			if($debug) { var_dump("\n<BR>EMAILS ARE: $stds \n<BR>"); }
		// foreach($stds as $element) { echo("->".$element."\n"); }

            if($stds)
	    {
			// for every student, update their status to a C for cancelled
			// as well as inform the user of the change
              foreach($stds as $element){
                $element = trim($element);
		$sql = "UPDATE `Proj2Students` SET `Status`='C' WHERE `StudentID` = '$element'";
                $rs = $COMMON->executeQuery($sql, "Advising Appointments");
                $sql = "SELECT `Email` FROM `Proj2Students` WHERE `StudentID` = '$element'";
                $rs = $COMMON->executeQuery($sql, "Advising Appointments");
                $ros = mysql_fetch_row($rs);
                $eml = $ros[0];
                $message = "The following group appointment has been deleted by the adminstration of your advisor: " . "\r\n" .
                "Time: $row[0]" . "\r\n" . 
                "To schedule for a new appointment, please log back into the UMBC COEIT Engineering and Computer Science Advising webpage." . "\r\n" .
		"http://coeadvising.umbc.edu  -> COEIT Advising Scheduling \r\n Reminder, this is only accessible on campus."; 

                mail($eml, "Your COE Advising Appointment Has Been Deleted", $message);
              }
            }

				// Delete from the Admin's DB to update the changes made
            $sql = "DELETE FROM `Proj2Appointments` WHERE `Time` = '$row[0]' 
              AND `AdvisorID` = '0' 
              AND `Major` = '$row[1]' 
              AND `EnrolledNum` = '$row[2]'
              AND `Max` = '$row[3]'";
            $rs = $COMMON->executeQuery($sql, "Advising Appointments");
			// Print Details of the Appts and the needed variables to user
            echo("Time: ". date('l, F d, Y g:i A', strtotime($row[0])). "<br>");
            echo("Majors included: ");

            if($row[1]){ echo("$row[1]<br>"); }
            else{ echo("Available to all majors<br>"); }

            echo("Number of students enrolled: $row[2]<br>");
            echo("Student limit: $row[3]");
            echo("<br><br>");
            echo("<form method=\"link\" action=\"AdminUI.php\">");
            echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Return to Home\">");
            echo("</form>");
            echo("</div>");
            echo("<div class=\"bottom\">");
            if($stds[0]){
              echo "<p style='color:red'>Students have been notified of the cancellation.</p>";
            }
          }
		  // otherwise if it had changed, inform the user of the 
		  // prior appointment and the changes that have been made
          else{
            echo("<h1>Changed Appointment</h1><br>");
			echo("<h2>Previous Appointment:</h2>");
            echo("<h4>Time: </h4>". date('l, F d, Y g:i A', strtotime($row[0])). "<br>");
            echo("<h4>Majors included: </h4>");
            if($row[1]){
              echo("<h4>$row[1]<br></h4>"); 
            }
            else{
              echo("<h4>Available to all majors<br></h4>"); 
            }
            echo("<h4>Number of students enrolled: $row[2]<br></h4>");
            echo("<h4>Student limit: $row[3]</h4>");
            echo("<h2>Updated Appointment:</h2>");
            $limit = $_POST["stepper"];
            echo("<h4><b>Time: </h4>". date('l, F d, Y g:i A', strtotime($row[0])). "</b><br>");
            echo("<h4><b>Majors included: </h4>");
            if($row[1]){
              echo("<h4>$row[1]</b><br></h4>"); 
            }
            else{
              echo("<h4>Available to all majors</b><br></h4>"); 
            }
            echo("<h4><b>Number of students enrolled: $row[2] </b><br></h4>");
            echo("<h4><b>Student limit: $limit</b></h4>");

			// set a maximum num of students allowed to said appointment
            $sql = "UPDATE `Proj2Appointments` SET `Max`='$limit' WHERE `Time` = '$row[0]' 
                    AND `AdvisorID` = '$0' AND `Major` = '$row[1]' 
                    AND `EnrolledNum` = '$row[2]' AND `Max` = '$row[3]'";
            $rs = $COMMON->executeQuery($sql, "Advising Appointments"); 

            echo("<br><br>");
            echo("<form method=\"link\" action=\"AdminUI.php\">");
            echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Return to Home\">");
            echo("</form>");
          }
        ?>
	</div>
	</div>
	</div>
	</form>
  </body>
  <?php  include('../footer.php'); ?>
</html>
