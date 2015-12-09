<?php
session_start();
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
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head> 
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
          <h1>Edit Group Appointment</h1>
		  <div class="field">
          <?php
            $debug = false;
            include('../CommonMethods.php');
            $COMMON = new Common($debug);

            $group = $_SESSION["GroupApp"];
            parse_str($group);
			
			// option to edit the post, printing out the time, date with majors included 
            echo("<form action=\"AdminConfirmEditGroup.php\" method=\"post\" name=\"Edit\">");
            echo("<h4>Time: </h4>". date('l, F d, Y g:i A', strtotime($row[0])). "<br>");
            echo("<h4>Majors included: </h4>");
            if($row[1]){
              echo("<h4>$row[1]<br></h4>"); 
            }
            else{
              echo("<h4>Available to all majors<br></h4>"); 
            }
			// display amount enrolled currently with limit currently
            echo("<h4>Number of students enrolled: $row[2] <br></h4>");
            echo("<h4>Student limit: </h4>");
            echo("<input type=\"number\" id=\"stepper\" name=\"stepper\" min=\"$row[2]\" max=\"$row[3]\" value=\"$row[3]\" />");

            echo("<br><br>");

            echo("<div class=\"nextButton\">");
            echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Submit\">");
            echo("</div>");
            echo("</div>");
            echo("<div class=\"bottom\">");
			// if the there is nobody available to delete, print a message to the user to decline their actions
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
  <?php include('../footer.php'); ?>
</html>
