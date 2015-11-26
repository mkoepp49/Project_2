<?php
session_start();
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
	    <div class="statusMessage">
	    <?php
		// SET OF PRINT STATEMENTS
			// if there is not reschedule
			
			$_SESSION["resch"] = false;			
			if($_SESSION["status"] == "complete"){
				echo "You have completed your sign-up for an advising appointment.";
				// call function to delete from temp
				include ('../Data.php');
				//$done = delete($_SESSION['userId']);
			}
			// if the user does not have an appt
			elseif($_SESSION["status"] == "none"){
				echo "You did not sign up for an advising appointment.";
			}
			// if the user cancelled their appt
			if($_SESSION["status"] == "cancel"){
				echo "You have cancelled your advising appointment.";
			}
			// if the user did reschedule
			if($_SESSION["status"] == "resch"){
				echo "You have changed your advising appointment.";
			}
			// if the user kept their appt
			if($_SESSION["status"] == "keep"){
				echo "No changes have been made to your advising appointment.";
			}
		?>
        </div>
		<!-- Return the user back to the student UI -->
		<form action="02StudHome.php" method="post" name="complete">
	    <div class="returnButton">
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>
		</div>
		</form>
  </body>
</html>