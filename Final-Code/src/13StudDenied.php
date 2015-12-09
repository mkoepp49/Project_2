<?php
session_start();
include('../studHeader.php');
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Exit Message</title>
	<!-- Link the appropriate css file from the css folder, used to reduce file length -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<!-- Print status to the user -->
	    <div class="statusMessage">
		<h3>Someone JUST took that appointment before you. Please find another available appointment.</h3>
        </div>
		<!-- Return user back to the home Student UI -->
		<form action="02StudHome.php" method="post" name="complete">
	    <div class="returnButton">
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>
		</div>
		</form>
  </body>
  <?php
session_start();
include('../footer.php');
?>
</html>