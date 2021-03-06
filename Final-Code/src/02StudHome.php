<?php
session_start();
include ('../studHeader.php');
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Student Advising Home</title>
	<!-- link the appropriate css to its own file to reduce the file size -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>


    <div id="login">
      <div id="form">
        <div class="top">
  <h2>Welcome, 
		<?php
			include ('../Data.php');
			echo $firstn;
		?>
        </h2>
	    <div class="selections">
		<!-- These will go through processing before performing user desired action 
		     based on which option the student chooses from the buttons listed-->
		<form action="StudProcessHome.php" method="post" name="Home">
	    <?php
			$debug = false;
			include_once('../CommonMethods.php');
			$COMMON = new Common($debug);
			
			$_SESSION["studExist"] = false;
			$adminCancel = false;
			$noApp = false;
			$studid = $_SESSION["studID"];

			// fetch the specific student from the DB based on the 
			$sql = "select * from Proj2Students where `StudentID` = '$studid'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			
			// check if the user has an existing appointment,
			// needed later for displaying certain option buttons
			if (!empty($row)){
				$_SESSION["studExist"] = true;
				if($row[6] == 'C'){
					$adminCancel = true;
				}
				if($row[6] == 'N'){
					$noApp = true;
				}
				// checks if temp appoint
				if($row[6] == 'X'){
					$_SESSION["studExist"] = false;
				}
			}
			// If the student meets the requirements, release the buttons that are appropriate to the user's available action options 
			if ($_SESSION["studExist"] == false || $adminCancel == true || $noApp == true){
				if($adminCancel == true){
					echo "<p style='color:red'>The advisor has cancelled your appointment! Please schedule a new appointment.</p>";
				}
				echo "<button type='submit' name='selection' class='button large selection' value='Signup'>Signup for an Appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='FindNext'>Next Available Appointment</button><br>";
			}
			else{
				echo "<button type='submit' name='selection' class='button large selection' value='View'>View my Appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Reschedule'>Reschedule my Appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Cancel'>Cancel my Appointment</button><br>";
			}
			echo "<button type='submit' name='selection' class='button large selection' value='Search'>Search for appointment</button><br>";
			echo "<button type='submit' name='selection' class='button large selection' value='Edit'>Edit student information</button><br>";
			echo "<button type='submit' name='selection' class='button large selection' value='Registration Dates'>Registration Dates</button><br>";
		?>
		</form>
        </div>
		<!-- otherwise, they can also retreat back to their home UI if desired -->
		<form action="Logout.php" method="post" name="Logout">
	    <div class="logoutButton">
			<input type="submit" name="logout" class="button large go" value="Logout">
	    </div>
		</div>
		</form>

<?php include ('../footer.php'); ?>

</body>

</html>