<?php
session_start();
include('../adminHeader.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Appointment</title>
    <!-- Add the appropriate css file to this page, reduce file size -->
<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	<h1>Edit Appointments</h1>
	<h2>Select advising type</h2><br>
  <!-- Send a form to the AdminProcessEdit.php" when the buttons (2 options) are selected -->
	<form method="post" action="AdminProcessEdit.php">
	<div class="nextButton">
		<!-- option one -->
		<input type="submit" name="next" class="button large go" value="Individual">
		<!-- option two -->
		<input type="submit" name="next" class="button large go" value="Group">
	</div>
	</form>
        </div>
        <div class="field">
	<br>
	<br>
	<!-- Send a form to the AdminUI.php when the buttons (2 options) are selected -->
	<form method="link" action="AdminUI.php">
	<!-- option to go home -->
	<input type="submit" name="next" class="button large go" value="Return to Home">
	</form>
         
        </div>
	</div>
		
  </body>
  <?php  include('../footer.php'); ?>
</html>
