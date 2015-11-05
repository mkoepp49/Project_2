<?php
// this file allows admin to edit the appointment
session_start();
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
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head> 
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
          <!--  
          Title for group appointment 
          -->
          <h1>Edit Group Appointment</h1>
		  <div class="field">
          <?php
            $debug = false;
            include('../CommonMethods.php');
            $COMMON = new Common($debug);
            // set if group appointment
            $group = $_SESSION["GroupApp"];
            parse_str($group);

            // transfer input on this file to AmdinConfirmEditGroup.php
            echo("<form action=\"AdminConfirmEditGroup.php\" method=\"post\" name=\"Edit\">");
            // print out the time and date
            echo("Time: ". date('l, F d, Y g:i A', strtotime($row[0])). "<br>");
            // print out the majors appointment takes
            echo("Majors included: ");
            if($row[1]){
              echo("$row[1]<br>"); 
            }
            else{
              echo("Available to all majors<br>"); 
            }
            // # of students enrolled in appointment
            echo("Number of students enrolled: $row[2] <br>");
            // Student limit, this is editable with a stepper to incre/decrement
            echo("Student limit: ");
            echo("<input type=\"number\" id=\"stepper\" name=\"stepper\" min=\"$row[2]\" max=\"$row[3]\" value=\"$row[3]\" />");

            echo("<br><br>");
            // submit button that moves to next page
            echo("<div class=\"nextButton\">");
            echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Submit\">");
            echo("</div>");
            echo("</div>");
            echo("<div class=\"bottom\">");
            // if there are students enrolled, cannot change limit below student enrollment number
            if($row[2] > 0){
              echo "<p style='color:red'>Note: There are currently $row[2] students enrolled in this appointment. <br>
                    The student limit cannot be changed to be under this amount.</p>";
            }
            echo("</div>");
          ?>
		  </div>
  </div>
  </div>
  </form>
  </body>
  
</html>
