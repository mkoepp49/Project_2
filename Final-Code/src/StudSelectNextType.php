<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advising Type for Next Available Appointment</title>
	<!-- Link the appropriate css to its own file to reduce the file size -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Schedule Next Available Appointment</h1>
		<!-- Based on whether a student desires to have an individual versus group 
		     appointment, they will select a submit button to be sent into processing -->
		<h2>What kind of advising appointment would you like?</h2><br>
	<form action="StudProcessNextType.php" method="post" name="SelectType">
	<div class="nextButton">
		<input type="submit" name="type" class="button large go" value="Individual">
		<input type="submit" name="type" class="button large go" value="Group" > <!-- style="float: right;"> -->
		<input type="submit" name="type" class="button large go" value="Either Selection"> <!--style="float: none;">-->
	    </div>
		</div>
		</form>
<br>
<br>
		<div>
		<!-- Otherwise, they can also retreat back to their home UI if desired -->
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
</html>