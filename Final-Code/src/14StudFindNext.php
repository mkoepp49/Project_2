<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

if(isset($_POST["FindNext"])){
	$_SESSION["FindNext"] = $_SPOST["FindNext"];
}
$localMaj = $_SESSION["major"];
$studID = $SESSION["studID"];
$advisorID = $_SESSION["advisorID"];

include('../studHeader.php');
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
		/* While the enrolled num is less than the max num and the max and the major either matches the local major
		 is within the set that we need to have // Max is either one or ten 
		   `AdvisorID` = ".$_POST['advisor']." */
		$sql = "select * from Proj2Appointments where `EnrolledNum` < `Max` and (`Major` like '%$localMaj%'  or `Major` = '') 
		       and `Time` > '".date('Y-m-d H:i:s')."' order by `Time` ASC limit 30";
        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		$advisorID = $row[2];
		$datephp = strtotime($row[1]);
		$apptRoom = $row[7];
		
		/* Updated 12/4 in order to print the advisor from the next avail appointment */
		$sql2 = "select * from Proj2Advisors where `id` = '$advisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$advisorName = $row2[1] . " " . $row2[2];
					$apptRoom = $row2[6];
					$advisorOffice = $row2[3];
		
		// Print the result to the user
		echo "<label for='info'>";
		echo "Advisor: ", $advisorName, "<br>";
		echo "Appointment: ", date('l, F d, Y g:i A', $datephp), "<br>";
		//$advisorOffice = $row[3];
		echo "Advisor Office: " , $advisorOffice,  "<br>";
		echo "Appointment Room: " , $apptRoom,  "</label>";
					
	?>
	        </div>
		<!-- Redirect back to student home page after completion -->
	    <div class="finishButton">
			<button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
	    </div>
		</div>
		</form>
  </body>
  <?php include('../footer.php'); ?>
</html>