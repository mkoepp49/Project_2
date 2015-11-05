<?php
session_start();
?>

<html lang="en">
	<!-- 
	This page displays is a menu for the student once logged in
	
	Options: View my appointment, Reschedule my appointment
	Cancel my appointment, Search for appointment
	Edit student information, Logout
	
	This is a HTML / PHP / HTML / PHP file

	 -->


  <head>
    <meta charset="UTF-8" />
    <title>Student Advising Home</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">

      	<!-- 
      	top()
      	Prints out greeting on top of screen
      	-->
        <div class="top">
		<h2>Hello 
		<?php
			echo $_SESSION["firstN"];
		?>
        </h2>

        <!-- 
        Selections()
        Calls upon StudProcessHome.php which calls the correct header with menu item
         -->
	    <div class="selections">
		<form action="StudProcessHome.php" method="post" name="Home">
	    <?php

	    	// Calls the debug variable in CommonMethods
			$debug = false;
			include('../CommonMethods.php');
			$COMMON = new Common($debug);
			

			$_SESSION["studExist"] = false; // student exists in DB
			$adminCancel = false; // cancelled apointment
			$noApp = false; // appointment not available
			$studid = $_SESSION["studID"]; // student ID


			// get student ID from DB
			$sql = "select * from Proj2Students where `StudentID` = '$studid'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			

			// Check for cancelled apointment, or no appointment
			if (!empty($row)){
				$_SESSION["studExist"] = true;
				if($row[6] == 'C'){
					$adminCancel = true;
				}
				if($row[6] == 'N'){
					$noApp = true;
				}
			}

			// conditionals: check if admin cancelled, and check if student doesnt exist/ no appointment
			// if the later, then bring up signup 
			if ($_SESSION["studExist"] == false || $adminCancel == true || $noApp == true){
				if($adminCancel == true){
					echo "<p style='color:red'>The advisor has cancelled your appointment! Please schedule a new appointment.</p>";
				}
				echo "<button type='submit' name='selection' class='button large selection' value='Signup'>Signup for an appointment</button><br>";
			}
			// else display options to modify/view appointment
			else{
				echo "<button type='submit' name='selection' class='button large selection' value='View'>View my appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Reschedule'>Reschedule my appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Cancel'>Cancel my appointment</button><br>";
			}
			echo "<button type='submit' name='selection' class='button large selection' value='Search'>Search for appointment</button><br>";
			echo "<button type='submit' name='selection' class='button large selection' value='Edit'>Edit student information</button><br>";
		?>
		</form>
        </div>

        <!-- Logout button if everything is set -->
		<form action="Logout.php" method="post" name="Logout">
	    <div class="logoutButton">
			<input type="submit" name="logout" class="button large go" value="Logout">
	    </div>
		</div>
		</form>
  </body>
</html>