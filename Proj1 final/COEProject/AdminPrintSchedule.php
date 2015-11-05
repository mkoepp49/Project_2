<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- 
    This file allows admin to select their date and type of appointment to print
    -->
    <meta charset="UTF-8" />
    <title>Print Schedule</title>
  <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		      <h1>Print Schedule</h1>
          <!-- 
          sends the _post data to AminPrintResults to get from the DB
          -->
          <form action="AdminPrintResults.php" method="post" name="Confirm">
	         <div class="field">
	     	     <label for="date">Date</label>
             <!-- 
             get date from admin to print
            -->
             <input id="date" type="date" name="date" placeholder="mm/dd/yyyy" required autofocus> (mm/dd/yyyy)
	         </div>

	         <div class="field">
            <!-- 
            Type of appoint to print, both, individual, or group
            -->
        		<label for="Type">Type of Appointment</label>
            <select id="type" name = "type">
					<option>Both</option>
        			<option>Individual</option>
        			<option>Group</option>
        		</select>
	         </div>

	         <br>

          <!-- 
          subimt button to call AdminPrintResults.php page
          -->
    	    <div class="nextButton">
    			<input type="submit" name="next" class="button large go" value="Next">
        </form>
	</div>
	</div>
	<?php include('./workOrder/workButton.php'); ?>

  </body>
</html>
