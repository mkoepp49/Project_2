<?php

/* Had to make sure sessions was enabled. Some help here:

https://wiki.umbc.edu/pages/viewpage.action?pageId=46563550

cd /afs/umbc.edu/public/web/sites/coeadvising/prod/php/session/

/usr/bin/fs sa /afs/umbc.edu/public/web/sites/coeadvising/prod/php/session/ web.coeadvising all


then edit .htaccess file here in the same directory

This file validates the username and password

*/


session_start();

include('../CommonMethods.php');
$debug = false;
$Common = new Common($debug);

// sets the sesion username/password
$_SESSION["UserN"] = strtoupper($_POST["UserN"]);
$_SESSION["PassW"] = strtoupper($_POST["PassW"]);
$_SESSION["UserVal"] = false;

// variables to hold values
$user = $_SESSION["UserN"];
$pass = $_SESSION["PassW"];

// find row with the values in DB
$sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `Password` = '$pass'";
$rs = $Common->executeQuery($sql, "Advising Appointments");
$row = mysql_fetch_row($rs);

// if found, then move to AdminUI.php
if($row){
	if($debug) { echo("<br>".var_dump($_SESSION)."<- Session variables above<br>"); }
	else { header('Location: AdminUI.php'); }
}

// else go to AdminSignIn.php
else{
	$_SESSION["UserVal"] = true;
	header('Location: AdminSignIn.php'); 
}

?>