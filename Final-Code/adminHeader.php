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
			<li><a href="AdminUI.php"><span class="iconic home"></span> Home</a></li>

			<li><a href="#"><span class="iconic chat"></span> Appointments</a>
				<ul>
					<li><a href="AdminScheduleApp.php">Schedule An Appointment</a></li>
					<li><a href="AdminPrintSchedule.php">Print Schedule</a></li>
				</ul>
			</li>
			<li><a href="#"><span class="iconic magnifying-glass"></span>Search</a>
				<ul>
					<li><a href="AdminSearchApp.php">Search Appointments</a></li>
					<li><a href="RegistrationDatesAdmin.php">Registration Dates</a></li>
				</ul>
			</li>
			
			<li><a href="#"><span class="iconic cog"></span>Edit/Create</a>
				<ul>
					<li><a href="AdminEditApp.php">Edit Appointments</a></li>
					<li><a href="AdminCreateNewAdv.php">Create New Admin</a></li>
				</ul>
			</li>
			
			<li><a href ="Logout.php"><span class="iconic x thin"></span>Logout</a></li>
		</ul>
</nav>




