<?php
// this file adds new admin to sql database
  session_start();
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
		<h2>New Advisor has been created:</h2>

		<?php
      // gets admin entered data
			$first = $_SESSION["AdvF"];
			$last = $_SESSION["AdvL"];
			$user = $_SESSION["AdvUN"];
			$pass = $_SESSION["AdvPW"];
      $loca = $_SESSION["Advloca"]; // location

			include('../CommonMethods.php');
			$debug = false;
			$Common = new Common($debug);

      // tries to find an exsiting admin with similar first last name
      // if so, gives warning
      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last'";
      $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
      if($row){
        echo("<h3>Advisor $first $last already exists</h3>");
      }
      else{
        
        // inserts new admin into the sql database!
  			$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`,`Location`) 
  			VALUES ('$first', '$last', '$user', '$pass', '$loca')";
        echo ("<h3>$first $last<h3>");
        $rs = $Common->executeQuery($sql, "Advising Appointments");
      }
		?>
    <!-- goes back to admin home -->
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>
	</div>
	</div>
	</div>
	</form>
  </body>
  
</html>
