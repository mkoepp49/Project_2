<?php
  session_start();
  include('../adminHeader.php');


$_SESSION["PassCon"] = false;
//  reloop to the file because not verified
if($_POST["PassW"] != $_POST["ConfP"]){
	$_SESSION["PassCon"] = true;
	header('Location: AdminCreateNewAdv.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
    <script type="text/javascript"> 
    function saveValue(target){
	var stepVal = document.getElementById(target).value;
	alert("Value: " + stepVal);
    }
    </script>
	<!-- Link the css portion of file to its own css file to reduce file size -->
<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>New Advisor has been created:</h2>

		<?php
			// Variables sent in from the form action of AdminCreateNewAdv.php
			$first = $_POST["firstN"];
			$last = $_POST["lastN"];
			$user = $_POST["UserN"];
			$pass = $_POST["PassW"];
			$offNum = $_POST["OfficeNum"];
			
			// New field for Project 2 Update 
			$apptNum = $_POST["ApptRoom"];
			$defaultRoom = "TBA123";
			
			include('../CommonMethods.php');
			$debug = false;
			$Common = new Common($debug);

	  // based on the variables set, attempt to find an existing member in the DB
      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last'";
      $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
	  
	  // If the row equals the selection, then the advisor already exists, cannot complete
      if($row){
        echo("<h3>Advisor $first $last already exists</h3>");
      }

	  // Otherwise, insert the new adivisor successfully
      else
	  {
	  	// If user did not enter an appointment room number to their database query (for the sign up page on front-end side)
		// if($apptNum == $NoInput)
		if(empty($apptNum))
			{
				$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`,
				`RoomNumber`,`AppointmentRoom`)	VALUES ('$first', '$last', '$user', '$pass', '$offNum', '$defaultRoom')";
				echo ("<h3>$first $last<h3>");
				// $rs = $Common->executeQuery($sql, "Advising Appointments");
			}
		else
			{
				$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`,
				`RoomNumber`, `AppointmentRoom`) VALUES ('$first', '$last', '$user', '$pass', '$offNum', '$apptNum')";
				echo ("<h3>$first $last<h3>");
				// $rs = $Common->executeQuery($sql, "Advising Appointments");
			}
		$rs = $Common->executeQuery($sql, "Advising Appointments");
	  }
		?>
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return To Home">
		</form>
	</div>
	</div>
	</div>
	</form>
  </body>
  <?php  include('../footer.php'); ?>
</html>
