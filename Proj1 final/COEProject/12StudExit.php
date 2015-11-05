<?php
session_start();
?>
<!-- 
This is the exit screen to logout
-->
<html lang="en">
<!--  -->
<meta charset="UTF-8" />
<!-- 
deleted previous css that was here below, and linked to css folder
-->
<title>Select Advisor</title>
<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
</head>
<body>
    <div id="login">
      <div id="form">
        <div class="top">
	    <div class="statusMessage">
	    <?php
			$_SESSION["resch"] = false;
      // prints out correct message based on values
			if($_SESSION["status"] == "complete"){
				echo "You have completed your sign-up for an advising appointment.";
			}
			elseif($_SESSION["status"] == "none"){
				echo "You did not sign up for an advising appointment.";
			}
			if($_SESSION["status"] == "cancel"){
				echo "You have cancelled your advising appointment.";
			}
			if($_SESSION["status"] == "resch"){
				echo "You have changed your advising appointment.";
			}
			if($_SESSION["status"] == "keep"){
				echo "No changes have been made to your advising appointment.";
			}
		?>
        </div>
    <!--
    returns home to 02
    -->
		<form action="02StudHome.php" method="post" name="complete">
	    <div class="returnButton">
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>
		</div>
		</form>
  </body>
</html>