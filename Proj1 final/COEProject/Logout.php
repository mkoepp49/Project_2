<?php
session_start();
$flag = false;
// logs out, and destroys session!

if(isset($_SESSION['studID'])) { $flag = true; }

session_unset();
// or unset($_SESSION); ?? 
session_destroy();


if($flag) { header("Location: 01StudSignIn.html"); }
else { header("Location: StudentAdminSignIn.html"); }

?>