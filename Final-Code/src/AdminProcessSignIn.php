<?php

/* Had to make sure sessions was enabled. Some help here:

https://wiki.umbc.edu/pages/viewpage.action?pageId=46563550

cd /afs/umbc.edu/public/web/sites/coeadvising/prod/php/session/

/usr/bin/fs sa /afs/umbc.edu/public/web/sites/coeadvising/prod/php/session/ web.coeadvising all


then edit .htaccess file here in the same directory

*/


session_start();

include('../CommonMethods.php');
$debug = false;
$Common = new Common($debug);

// set the inputted values from the HTML form,
// set the post values to upper to 
// eliminate casesensitivity
$_SESSION["UserVal"] = false;
$user = strtoupper($_POST["UserN"]);
$pass = strtoupper($_POST["PassW"]);

// find that user/pass in the sql database table
$sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `Password` = '$pass'";
$rs = $Common->executeQuery($sql, "Advising Appointments");
$row = mysql_fetch_row($rs);

// if the person is matched with DB
if($row){
	$_SESSION["adminUserid"] = $row[0]; // hold value for row id in DB
	if($debug) { echo("<br>".var_dump($_SESSION)."<- Session variables above<br>"); }
	else { header('Location: AdminUI.php'); }
}

// otherwise reloop to the sign in page
else{
	$_SESSION["UserVal"] = true;
	header('Location: AdminSignIn.php'); 
}

?>