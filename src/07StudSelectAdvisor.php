<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advisor</title>
	<!-- Link the appropriate css file from the css folder, used to reduce file length -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Individual Advising</h1>
		<h2>Select Advisor</h2>
	    <div class="field">
		<!-- Send fields to the next page needed, selection of time -->
		<form action="08StudSelectTime.php" method="post" name="SelectAdvisor">
	    <?php
			// select the advisor's DB, grab an advisor 
			$sql = "select * from Proj2Advisors";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			while($row = mysql_fetch_row($rs)){
				echo "<label for='",$row[0],"'><input id='",$row[0],"' type='radio' name='advisor' required value='", $row[0],"'>", $row[1]," ", $row[2],"</label><br>";
			}
		?>
        </div>
	    <div class="nextButton">
			<!-- submit the action to the next page -->
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
		</div>
		</form>
		<div>
		<!-- If the user desires, retreat back to Student UI -->
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
</html>