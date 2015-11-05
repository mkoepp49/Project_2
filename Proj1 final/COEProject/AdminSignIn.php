<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
 	<!-- 
 	This file allows to sign in as student or admin
 	-->
    <meta charset="UTF-8" />
    <title>UMBC COEIT Engineering and Computer Science Advising Admin Sign In</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>UMBC COEIT Engineering and Computer Science Advising</h1>
		<h2>Admin Sign In</h2>

    <?php
    // If wrong password was entered, will display error message
      if($_SESSION["UserVal"] == true){
        echo "<h3 style='color:red'>Invalid Username/Password combination</h3>";
      }
    ?>
    	<!-- 
      	get username and password of admin and pass into AdminProcessSignIn.php
      	-->
        <form action="AdminProcessSignIn.php" method="POST" name="SignIn">

	    <div class="field">
	      <label for="UserN">Username</label>
	      <input id="UserN" size="20" maxlength="50" type="text" name="UserN" required autofocus>
	    </div>

	    <div class="field">
	      <label for="PassW">Password</label>
	      <input id="PassW" size="20" maxlength="50" type="password" name="PassW" required>
	    </div>

	    <div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
	</div>
	</form>
  </body>
  
</html>
