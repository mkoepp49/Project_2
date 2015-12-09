<?php session_start();

if($_SESSION["status"] == "none")
	$enable = true;
 ?>

 
 <script type="text/javascript">
function hideselect(value)
{
if(value ==1)
{
document.getElementById('status').disabled=true;
}
}
</script>

<!-- Inlude a header image for the website here -->
<div id="headerImg">
<img src= "images/COEITAdvisingServices.gif"  align = "left"></div>

	<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="iconic.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>

<nav>
		<ul class="menu">
			<li><a href="02StudHome.php"><span class="iconic home"></span> Home</a></li>

			<li><a href="#"><span class="iconic chat"></span> Appointments</a>
				<ul>
					<li><a href="14StudFindNext.php">Find Next Available</a></li>
					<li><a href="03StudSelectType.php">Schedule New</a></li>
					<li><a class="dropdown-item disabled" href="04StudViewApp.php">View Appointment</a></li>
					<li><a class="dropdown-item disabled" href="03StudSelectType.php">Reschedule Current</a></li>
					<li><a class="dropdown-item disabled" href="05StudCancelApp.php">Cancel Appointment</a></li>
				</ul>
			</li>
			<li><a href="#"><span class="iconic magnifying-glass"></span>Search</a>
				<ul>
					<li><a href="09StudSearchApp.php">Search Appointments</a></li>
					<li><a href="RegistrationDates.php">Registration Dates</a></li>
				</ul>
			</li>
			
			<li><a href="06StudEditInfo.php"><span class="iconic cog"></span> Edit Information</a></li>
			<li><a href ="Logout.php"><span class="iconic x thin"></span>Logout</a></li>
		</ul>
</nav>




