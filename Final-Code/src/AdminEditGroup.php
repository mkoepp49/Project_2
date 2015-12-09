<?php
session_start();
$_SESSION["Delete"] = false;
include('../adminHeader.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Group Appointment</title>
    <script type="text/javascript">
    function saveValue(target){
  var stepVal = document.getElementById(target).value;
  alert("Value: " + stepVal);
    }
    </script>
	<!-- Link the standard css file to this document from the css folder, reduce file size -->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head> 
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
          <h1>Edit Group Appointment</h1>
		  <h2>Select an appointment to change</h2>
		  <div class="field">
          <?php
            $debug = false;
            include('../CommonMethods.php');
            $COMMON = new Common($debug);

			// select the time of the advisor ID
            $sql = "SELECT * FROM `Proj2Appointments` WHERE `AdvisorID` = '0' ORDER BY `Time`";
            $rs = $COMMON->executeQuery($sql, "Advising Appointments");
            $row = mysql_fetch_array($rs, MYSQL_NUM); 
			//first item in row, who is enrolled and how many for that time in the query
            if($row){
              echo("<form action=\"AdminProcessEditGroup.php\" method=\"post\" name=\"Confirm\">");
	echo("<table border='1px'>\n<tr>");
	echo("<tr><td width='320px'>Time</td><td>Majors</td><td>Seats Enrolled</td><td>Total Seats</td></tr>\n");

			// Group Appointments
              echo("<td><label for='$row[0]'><input type=\"radio\" id='$row[0]' name=\"GroupApp\" 
                required value=\"row[]=$row[1]&row[]=$row[3]&row[]=$row[5]&row[]=$row[6]\">");
              echo(date('l, F d, Y g:i A', strtotime($row[1])). "</label></td>");
              if($row[3]){
                echo("<td>".$row[3]."</td>"); 
              }
              else{
                echo("<td>Available to all majors</td>"); 
              }

              echo("<td>$row[5]</td><td>$row[6]");
			  echo("</label>");
			
			//rest of row
              echo("</td></tr>\n");
              while ($row = mysql_fetch_array($rs, MYSQL_NUM)) {
                echo("<tr><td><label for='$row[0]'><input type=\"radio\" id='$row[0]' name=\"GroupApp\" 
                  required value=\"row[]=$row[1]&row[]=$row[3]&row[]=$row[5]&row[]=$row[6]\">");
                echo(date('l, F d, Y g:i A', strtotime($row[1])). "</label></td>");
                if($row[3]){
                  echo("<td>".$row[3]."</td>"); 
                }
                else{
                  echo("<td>Available to all majors</td>"); 
                }

                echo("<td>$row[5]</td><td>$row[6]");
				echo("</label>");
                echo("</td></tr>");
                
              }

				// option to edit, delete, cancel appointment
		echo("</table>");
              echo("<div class=\"nextButton\">");
              echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Delete Appointment\">");
              echo("<input style=\"margin-left: 10px\" type=\"submit\" name=\"next\" class=\"button large go\" value=\"Edit Appointment\">");
              echo("</div>");
			  echo("</form>");
			  echo("<form method=\"link\" action=\"AdminUI.php\">");
              echo("<input type=\"submit\" name=\"next\" class=\"button large\" value=\"Cancel\">");
              echo("</form>");
            }
			// if no appointments are scheduled at that time, print out statement with option back to home
            else{
              echo("<br><b>There are currently no group appointments scheduled at the current moment.</b>");
              echo("<br><br>");
              echo("<form method=\"link\" action=\"AdminUI.php\">");
              echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Return to Home\">");
              echo("</form>");
            }
          ?>
  </div>
  </div>
  </div>
	<?php include('./workOrder/workButton.php'); 
	include('../footer.php'); ?>
  </div>
  </body>
</html>
