<?php
session_start();
$debug = false;
include ('../Data.php');
include_once('../CommonMethods.php');
$COMMON = new Common($debug);

if(isset($_POST["FindNext"])){
	$_SESSION["FindNext"] = $_SPOST["FindNext"];
}
$localMaj = $major;
$studID = $studid;
$advisorID = $_SESSION["advisorID"];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Next Available Appointment</title>
        <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
      <div id="login">
      <div id="form">
        <div class="top">
		<h1>View Next Available Appointment</h1>
	    <div class="field">
    <?php
		// Grasp the real-world time
		$curTime = time();
		
		/* Based on the requirements: 
		  - Advisor is not scheduled
		  - Time originates from closest time after $curTime
		  - Major is in the needed ranges
		  Select a free appointment */
		$sql = "select * from Proj2Appointments where `EnrolledNum` < `Max`
		and (`Major` like '%$localMaj%' or `Major` = '') and `Time` > '".date('Y-m-d H:i:s')."' order by `Time` ASC limit 30";
        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		$advisorID = $row[2];
		$datephp = strtotime($row[1]);
		
		// Select the advisor out of their DB that correspond to the appointment
		$sql2 = "select * from Proj2Advisors where `id` = '$advisorID'";
		$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
		$row2 = mysql_fetch_row($rs2);
		$advisorName = $row2[1] . " " . $row2[2];
		
		// Print the result to the user
		echo "<label for='info'>";
		echo "Advisor: ", $advisorName, "<br>";
		echo "Appointment: ", date('l, F d, Y g:i A', $datephp), "<br>";
		$advisorOffice = $row2[3];
		echo "Advisor Office: ", $advisorOffice,  "</label>";
	?>
	        </div>
		<!-- Redirect back to student home page after completion -->
	    <div class="finishButton">
			<button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
	    </div>
		</div>
		</form>
  </body>
</html>