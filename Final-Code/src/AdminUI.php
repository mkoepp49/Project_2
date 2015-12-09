<?php
session_start();
$debug = false;

if($debug) { echo("Session variables-> ".var_dump($_SESSION)); }
include ('../Admin.php');
include_once('../CommonMethods.php');
$COMMON = new Common($debug);
$_SESSION["PassCon"] = false;

include('../adminHeader.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Admin Home</title>
  <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
    </head>
    <body>
      <div id="login">
        <div id="form">
          <div class="top">
  <h2>
  <?php

  if(!isset($_SESSION["adminUserid"])) // someone landed this page by accident
    {
      echo "ACCESS DENIED 403 FORBIDDEN";
      return;
    }

echo "Hello ";
echo $FirstName;
?>
</h2>

<form action="AdminProcessUI.php" method="post" name="UI">

  <input type="submit" name="next" class="button large selection" value="Schedule appointments"><br>
  <input type="submit" name="next" class="button large selection" value="Print schedule for a day"><br>
  <input type="submit" name="next" class="button large selection" value="Edit appointments"><br>
  <input type="submit" name="next" class="button large selection" value="Search for an appointment"><br>
  <input type="submit" name="next" class="button large selection" value="Create new Admin Account"><br>

  </form>
  <br>

  <form method="link" action="Logout.php">
  <input type="submit" name="next" class="button large go" value="Log Out">
  </form>

          </div>
          <div class="field">

          </div>
  </div>

  <?php include('./workOrder/workButton.php'); ?>

</body>

</html>
<?php include('../footer.php'); ?>
