<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
  	<!--
  	This file allows student to pick their advisor, and transfers to 08
  	-->
    <meta charset="UTF-8" />
    <title>Select Advisor</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Individual Advising</h1>
		<h2>Select Advisor</h2>
	    <div class="field">
	    <!-- 
	    Tranfsers data to 08, with the selected advisor 
	    -->
		<form action="08StudSelectTime.php" method="post" name="SelectAdvisor">
	    <?php
	    	// gets advisor name from DB, and sets values for 08
			$sql = "select * from Proj2Advisors";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			while($row = mysql_fetch_row($rs)){
				echo "<label for='",$row[0],"'><input id='",$row[0],"' type='radio' name='advisor' required value='", $row[0],"'>", $row[1]," ", $row[2],"</label><br>";
			}
		?>
        </div>
        <!-- 
        Options to cancel or go on
        -->
	    <div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
		</div>
		</form>
		<div>
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
</html>