<?php
session_start();
//ini_set('display_errors','1');
//ini_set('display_startup_errors','1');
//error_reporting (E_ALL);

$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Search for Appointment</title>
	<!-- Link the appropriate css file from the css folder, used to reduce file length -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Search Results</h1>
		<h3>Showing open appointments only</h3>
	    <div class="field">
			<p>Showing results for: </p>
			<?php
				// variables needed to display to the user
				$date = $_POST["date"];
				$times = $_POST["time"];
				$advisor = $_POST["advisor"];
				$results = array();
				
				// output the date, set it to a variable
				if($date == ''){ echo "Date: All"; }
				else{ 
					echo "Date: ",$date;
					$date = date('Y-m-d', strtotime($date));
				}
				echo "<br>";
				
				// If they didnt enter a time, output all times found
				if(empty($times)){ echo "Time: All"; }
				else{
					$i = 0;
					echo "Time: ";

					// output all times found
					foreach($times as $t){
						echo ++$i, ") ", date('g:i A', strtotime($t)), " ";
					}
				}
				echo "<br>";
				
				// if advisor was not entered, or if they selected individual or group
				if($advisor == ''){ echo "Advisor: All appointments"; }
				elseif($advisor == 'I'){ echo "Advisor: All individual appointments"; }
				elseif($advisor == '0'){ echo "Advisor: All group appointments"; }
				else{
				// find the advisors for either instance
					$sql = "select * from Proj2Advisors where `id` = '$advisor'";
					$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					while($row = mysql_fetch_row($rs)){
						echo "Advisor: ", $row[1], " ", $row[2];
					}
				}
				?>
				<br><br><label>
				<?php
				// Select the appointment from Ind/Group Appt
				if(empty($times)){
					if($advisor == 'I'){
						$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` != 0 and `EnrolledNum` = 0 and `Major` like '%".$_SESSION['major']."%' order by `Time` ASC Limit 30";
						}
					else{
						$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` like '%$advisor%' and `EnrolledNum` = 0 and `Major` like '%".$_SESSION['major']."%' order by `Time` ASC Limit 30";
					}
				}	
					// based on whichever instance was caught,
					// perform action here to reduce redundancy 
					$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					$row = mysql_fetch_row($rs);
					$rsA = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					
					// If its a valid row
					if($row){
						// fetch the advisor
						while($row = mysql_fetch_row($rsA)){
							if($row[2] == 0){
								$advName = "Group";
							} 
							else{ $advName = getAdvisorName($row); }
							$majors = getMajor($row[3]);

							// print out details to user
							$found = 	"<tr><td>". date('l, F d, Y g:i A', strtotime($row[1]))."</td>".
									"<td>". $advName."</td>". 
									"<td>" .$majors. "</td></tr>".

							array_push($results, $found);
						}
					}
				//}
				// if times were not empty
				else{
					if($advisor == 'I'){
						foreach($times as $t){
							$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` > '".date('Y-m-d H:i:s')."' and `Time` like '%$t%' and `AdvisorID` != 0 and `EnrolledNum` = 0 and `Major` like '%".$_SESSION['major']."%' order by `Time` ASC Limit 30";
							$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							$row = mysql_fetch_row($rs);
							$rsA = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							if($row){
								while($row = mysql_fetch_row($rsA)){
									if($row[2] == 0){
										$advName = "Group";
									}
									else{ $advName = getAdvisorName($row); }

							$majors = getMajor($row[3]);
							$found = 	"<tr><td>". date('l, F d, Y g:i A', strtotime($row[1]))."</td>".
									"<td>". $advName."</td>". 
									"<td>" .$majors."</td>".
									array_push($results, $found);
								}
							}
						}
					}
					else{
					// for every result found, output to the user
						foreach($times as $t){
							$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` > '".date('Y-m-d H:i:s')."' and `Time` like '%$t%' and `AdvisorID` like '%$advisor%' and `EnrolledNum` = 0 and `Major` like '%".$_SESSION['major']."%' order by `Time` ASC Limit 30";
							$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							$row = mysql_fetch_row($rs);
							if($row){
								while($row = mysql_fetch_row($rs)){
									if($row[2] == 0){
										$advName = "Group";
									}
									else{ $advName = getAdvisorName($row); }
						
							$majors = getMajor($row[3]);
							$found = 	"<tr><td>". date('l, F d, Y g:i A', strtotime($row[1]))."</td>".
									"<td>". $advName."</td>".
									"<td>" .$majors."</td>".									
									array_push($results, $found);
								}
							}
						}
					}
				}
				// if nothing found, print the instance of no results found for search filters set by user
				if(empty($results)){
					echo "No results found.<br><br>";
				}
				
				// otherwise print out the results found
				else{
					echo("<table border='1'><th colspan='3'>Appointments Available</th>\n");
					echo("<tr><td width='60px'>Time:</td><td>Advisor</td><td>Major</td></tr>\n");

					foreach($results as $r){ echo($r."\n"); }

					echo("</table>");
				}
			?>
			</label>
        </div>
		<form action="02StudHome.php" method="link">
	    <div class="nextButton">
		<!-- Return back to the Student UI -->
			<input type="submit" name="done" class="button large go" value="Done">
	    </div>
		</form>
		</div>
		<div class="bottom">
		<p>If the Major category is followed by a blank, then it is open for all majors.</p>
		</div>
  </body>
</html>

<?php


// More code reduction by Lupoli - 9/1/15
// just getting the advisor's name
function getAdvisorName($row)
{
	global $debug; global $COMMON;
	$sql2 = "select * from Proj2Advisors where `id` = '$row[2]'";
	$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
	$row2 = mysql_fetch_row($rs2);
	return $row2[1] ." ". $row2[2];
}


function getMajor($row)
{	
	if( strpos($row[3], 'CMCS') !== false)
		{return 'Computer Science,' ;}
	elseif( strpos($row[3], 'MECHE') !== false)
		{return 'Mechanical Engineering,' ;}
	elseif( strpos($row[3], 'ENGR') !== false)
		{return 'Undecided Engineering' ;}
	elseif( strpos($row[3], 'CHEME') !== false)
		{return 'Chemical Engineering' ;}
	else
		{return 'Computer Science, Computer Engineering, Mechanical Engineering,Undecided Engineering, Chemical Engineering' ;}
}


?>
