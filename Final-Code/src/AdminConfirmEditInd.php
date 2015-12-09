<?php
session_start();
include('../adminHeader.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Individual Appointment</title>
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
		<!-- Confirm an Edit or Remove to Appts -->
          <h1>Removed Appointment</h1><br>
		  <div class="field">
          <?php
            $debug = false;
            include('../CommonMethods.php');
            $COMMON = new Common($debug);
			// Individual Appts, from past file form action, assign to variable
            $ind = $_POST["IndApp"];
            parse_str($ind);

			// Seek out that cell from the DB of the Advisors
            $sql = "SELECT `id` FROM `Proj2Advisors` WHERE `FirstName` = '$row[1]' AND `LastName` = '$row[2]'";
            $rs = $COMMON->executeQuery($sql, "Advising Appointments");
            $rod = mysql_fetch_row($rs);
            $adv = $rod[0];

			// Then select from the student DB where the student equals that Advisor and other Info
            if($row[4]){
              $sql = "SELECT `FirstName`, `LastName`, `Email` FROM `Proj2Students` WHERE `StudentID` = '$row[4]'";
              $rs = $COMMON->executeQuery($sql, "Advising Appointments");
              $ros = mysql_fetch_row($rs);
              $std = $ros[0] . " " . $ros[1];
              $eml = $ros[2];
            }
			
			// DELETE that user ftom the current DB query for the appointment
            $sql = "DELETE FROM `Proj2Appointments` WHERE `Time` = '$row[0]' AND `AdvisorID` = '$adv' AND `Major` = '$row[3]' AND `EnrolledID` = '$row[4]'";
            $rs = $COMMON->executeQuery($sql, "Advising Appointments");

			// Print out the time and date, and majors
            echo("<h4>Time: </h4>". date('l, F d, Y g:i A', strtotime($row[0])). "<br>");
            echo("<h4>Advisor: $row[1] $row[2]<br></h4>");
            echo("<h4>Majors included: </h4>");
            if($row[3]){
              echo("$row[3]<br>"); 
            }
            else{
              echo("<h4>Available to all majors<br></h4>"); 
            }
			// Update the enrollment to CANCELED status to user
            echo("<h4>Enrolled: </h4>");
            if($row[4]){
              echo("$std</b>");
              $sql = "UPDATE `Proj2Students` SET `Status`='C' WHERE `StudentID` = '$row[4]'";
              $rs = $COMMON->executeQuery($sql, "Advising Appointments");
              $message = "<h4>The following appointment has been deleted by the adminstration of your advisor: " . "\r\n" .
                "Time: $row[0]" . "\r\n" . 
                "Advisor: $row[1] $row[2]" . "\r\n" . 
                "Student: $std" . "\r\n" . 
                "To schedule for a new appointment, please log back into the UMBC COEIT Engineering and Computer Science Advising webpage." . "\r\n" .
		"http://coeadvising.umbc.edu  -> COEIT Advising Scheduling \r\n Reminder, this is only accessible on campus.</h4>"; 
              mail($eml, "Your Advising Appointment Has Been Deleted", $message); 
            }
            else{
              echo("<h4>Empty</h4>");
            }
			?>
			<br><br>
			<form method="link" action="AdminUI.php">
				<input type="submit" name="home" class="button large go" value="Return to Home">
			</form>
		</div>
    </div>    
	</div>
	<div class="bottom">
		<?php
		if($row[4]){
              echo "<p style='color:red'>$std has been notified of the cancellation.</p>";
        }
		?>
	</div>
	</div>
	</form>
	 <?php  include('../footer.php'); ?>
  </body>
</html>
