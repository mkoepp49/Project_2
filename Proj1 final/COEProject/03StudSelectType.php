<?php
session_start();
?>

<html lang="en">
	<!-- 
	This file provides two options to the user to schedule an appointment
	Group or Individual
	Calls StudProcessType.php with the selected value
	-->
  <head>
    <meta charset="UTF-8" />
    <title>Select Advising Type</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Schedule Appointment</h1>
		<h2>What kind of advising appointment would you like?</h2><br>
	<form action="StudProcessType.php" method="post" name="SelectType">
	<div class="nextButton">
		<!--
		the option chosen is sent to StudProcessType.php
		-->
		<input type="submit" name="type" class="button large go" value="Individual">
		<input type="submit" name="type" class="button large go" value="Group" style="float: right;">
	    </div>
		</div>
		</form>


<br>
<br>
		<div>
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
</html>