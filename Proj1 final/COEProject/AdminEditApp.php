<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- 
    This file allows admin to edit their appointment
    -->
    <meta charset="UTF-8" />
    <title>Print Schedule</title>
  <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	<h1>Edit Appointments</h1>
	<h2>Select advising type</h2><br>

	<form method="post" action="AdminProcessEdit.php">
	<div class="nextButton">
    <!-- 
    Chosen button is sent to AdminProcessEdit.php
    -->
		<input type="submit" name="next" class="button large go" value="Individual">
		<input type="submit" name="next" class="button large go" value="Group" style="float: right;">
	</div>
  </form>
	</form>
        </div>
        <div class="field">
	<br>
	<br>
  <!-- 
  go back to admin home
  -->
	<form method="link" action="AdminUI.php">
	<input type="submit" name="next" class="button large go" value="Return to Home">
	</form>
         
        </div>
	</div>
		
  </body>
  
</html>
