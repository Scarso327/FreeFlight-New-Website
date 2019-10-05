<?php
ob_start();
session_start();

if(isset($_GET['logout'])) {
	session_unset();
	session_destroy();
	header('Location: http://freeflightinteractive.co.uk/old/police.php');
	exit;
}

$page = "Unknown";
	
switch ($_GET['page']) {
	case "myArea":
		$page = "myArea";
		break;
	case "staff":
		$page = "Staff";
		break;
	case "myProfile":
		$page = "myProfile";
		break;
	case "settings":
		$page = "Settings";
		break;
	default: 
		$page = "Dashboard";
		break;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freeflight";
			
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

if(isset($_SESSION['username'])) {
?>
<html>
	<?php
	include("./system/policeFunctions.php");
	$name = mysqli_real_escape_string($db, $_SESSION['username']);
	
	$sql_fetch_id = "SELECT * FROM officers WHERE Username='".$name."'";
	$query_id = mysqli_query($db,$sql_fetch_id);	

	if ($query_id->num_rows > 0) {
		while($row = $query_id->fetch_assoc()) {
			$pid = $row['pid'];
			$isAdmin = $row['isAdmin'];
			$isInterviewManager = $row['isInterviewManager'];
			$isInterviewer = $row['isInterviewer'];
		}
	} else {
		die("Error W/ Client, Code: 1A");
	};
	
	$debug = false; // Allows you to access things without meeting requirements 
	?>
	<head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$page;?> - Altis Constabulary</title>
				
		<link rel="icon" href="http://freeflightinteractive.co.uk/old/Favicon.ico">
		<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/main.css?v=<?=time();?> type="text/css" />
		<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/font-awesome.css?v=<?=time();?> type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
		<script>
		window.addEventListener("load", function(){
		window.cookieconsent.initialise({
			container: document.getElementById("footer"),
			"palette": {
				"popup": {
					"background": "#222222"
				},
				"button": {
				  "background": "#14a7d0"
				}
			},
			"theme": "edgeless",
			"static": true
		})});
		</script>
		<style>
		nav .navContainer .right li {
			float: right;
			display: block;
		}

		nav .navContainer .right li a {
			position: relative;
			display: block;
			line-height: 40px;
			color: #9d9d9d;
			padding: 10px 15px;
			text-decoration: none;
		}

		nav .navContainer .right li a:hover {
			color: white;
		}
		</style>
	</head>
	<body id="police">
		<?php
		if($debug == true) {
		?>
		<center>
			<div style="width: 100%; height: 25px; line-height: 1.6; background-color: #d9534f;">Debug Mode Active!</div>
		</center>
		<?php
		}
		?>
		<nav id="policeTop">
			<div class="navContainer">
				
				<div class="right">
					<ul>
						<?php
						if($isAdmin == 1) {
						?>
							<li <?php if($page == 'Staff') { ?>style="box-shadow: 0px -3px 0px #00dfff inset;"<?php } ?>>
								<a href="http://freeflightinteractive.co.uk/old/police.php?page=staff">Staff Panel</a>
							</li>
						<?php
						}
						?>
						<li <?php if($page == 'myArea') { ?>style="box-shadow: 0px -3px 0px #00dfff inset;"<?php } ?>>
							<a href="http://freeflightinteractive.co.uk/old/police.php?page=myArea">myArea</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<nav>
			<div class="navContainer">
				<div class="logoTitle">
					<img src="./images/uk_badge.png">
				</div>
				<div class="left">
					<ul>
						<li <?php if($page == 'Dashboard') { ?>style="box-shadow: 0px -3px 0px #00dfff inset;"<?php } ?>>
							<a href="http://freeflightinteractive.co.uk/old/police.php">Dashboard</a>
						</li>
					</ul>
				</div>
				<div class="right">
					<li class="dropdown">
						<?php
						$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=4C05220E7DC9A7C562CB5277B7AE5280&steamids=".$pid;
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_URL,$apifr);
						$url = curl_exec($ch);
						curl_close($ch);
						$content = json_decode($url, true);
						
						$_SESSION['steamu_avatarfull'] = $content['response']['players'][0]['avatarfull'];
						?>
						<a class="profileLink" href=''><img class="profileImage" src="<?=$_SESSION['steamu_avatarfull'];?>"> <p class="profileText"><?=$_SESSION['username'];?></p> <i class="fa fa-chevron-down profileIcon" aria-hidden="true"></i></a>
						<div class="dropdown-content">
							<a href="http://freeflightinteractive.co.uk/old/police.php?page=myProfile">Profile</a>
							<a href="http://freeflightinteractive.co.uk/old/police.php?page=settings">Settings</a>
							<a href="http://freeflightinteractive.co.uk/old/police.php?logout">Logout</a>
						</div>
					</li>
				</div>
			</div>
		</nav>
		<?php
		switch($_GET['page']) {
			case "myArea":
				include("./includes/police/myArea.php");
				break;
			case "staff":
				include("./includes/police/staff.php");
				break;
			case "myProfile": ?>
				<main id="police" class="container">
					<div class="box articleB" style="margin-top: 10px;">
						<div class="breadcrumb ipsBreadcrumb_top">
							<a href="http://freeflightinteractive.co.uk/old/police.php">Dashboard</a>
							<span class="slashes">//</span>
							<a class="active" href="http://freeflightinteractive.co.uk/old/police.php?page=myProfile">Your Profile</a>	
						</div>
						<?php
						$sql_fetch_id = "SELECT * FROM officers WHERE pid='".$pid."'";
						$query_id = mysqli_query($db,$sql_fetch_id);
					
						if ($query_id->num_rows > 0) {
							while($row = $query_id->fetch_assoc()) {
								$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=4C05220E7DC9A7C562CB5277B7AE5280&steamids=".$pid;
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($ch, CURLOPT_URL,$apifr);
								$url = curl_exec($ch);
								curl_close($ch);
								$content = json_decode($url, true);
							
								$_SESSION['officer_avatarfull'] = $content['response']['players'][0]['avatarfull'];
							
								if($row['isInterviewed'] != 1) { ?>
									<center>
										<div style="width: 100%; height: 25px; line-height: 1.6; background-color: #d9534f;">Requires Interview</div>
									</center>
									<?php
								}
								?>
							<div class="articleList">
								<a class="">
									<div class="listThumbnail">
										<div class="thumbnail" style="background-image: url(<?=$_SESSION['officer_avatarfull'];?>);"></div>
									</div>
									<div class="listInfo" style="top: -125;">
										<span>Added To PNC: <?=$row['TimeAdded'];?></span>
										<h3><?=$row['Username'];?></h3>
										<p><?=grabRank($row['pid'], "Abr", false, true);?></p>
									</div>
								</a>
							</div>
							<div class="tab">
							  <button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab1") { ?> id="defaultOpen" <?php } } else { ?> id="defaultOpen" <?php } ?> class="tablinks" onclick="changeTab(event, 'Tab1', 'profile')">Profile</button>
							  <button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab2") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab2', 'profile')">Submitted Forms</button>
							</div>
							<div id="Tab1" class="tabcontent">
								<div class="SideAreaSection innerBox" style="float: left; background-color: #1B1B1B;">
									<h2>Duty Time (HH:MM)</h2>
									<p>Recorded: <?php 
									$sql_fetch_id2 = "SELECT TotalTime FROM forms WHERE pid='".$row['pid']."'";
									$query_id2 = mysqli_query($db,$sql_fetch_id2);
									
									$alltimes = [];
									if ($query_id2->num_rows > 0) {
										while($reportedTime = $query_id2->fetch_assoc()) { 
											
											$alltimes[] = date('H:i', strtotime($reportedTime['TotalTime']));
										}
										$finalTime = date('H:i', strtotime("00:00"));
										foreach ($alltimes as $value) {
											$finalTime = addTwoTimes($finalTime, $value);
										}
										echo $finalTime;
									} else {
										echo "00:00";
									}
									?> 
									<br>
									Actual: <?=getPlayTime($row['pid']);?></p>
								</div>
								<div class="AreaSection innerBox" style="float: right; background-color: #1B1B1B;">
									test
								</div>
							</div>
							<div id="Tab2" class="tabcontent">
								<form class="selectOptionsPolice" id="formTypes" action="" style="top: 223; right: 5;">
									<select name="articleOptions" onchange="changeFormType(this.value,'Tab2')">
										<option value="All">All</option>
										<option value="TimeSheet">Time Sheets</option>
										<option value="Recommendations">Recommendations</option>
										<option value="Other">Other</option>
									</select>
								</form>
								<div class="articleList" id="formListPAST">
									<?php
									// Getting the list!
									$sql_fetch_id = "SELECT * FROM forms WHERE pid='".$_GET['officer']."' ORDER BY ID DESC";
									$query_id = mysqli_query($db,$sql_fetch_id);
												
									if ($query_id->num_rows > 0) {
										while($row = $query_id->fetch_assoc()) { ?>
											<div class="<?=$row['formType'];?>">
												<a id="<?=$row['formType'];?>" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&officer=76561198092567307&viewForm=<?=$row['id'];?>">
													<div class="listThumbnail">
														<div class="thumbnail" style="background-image: url();"></div>
													</div>
													<div class="listInfo">
														<span>
														<?php
														echo "Date Submitted: ".$row['Date']."";
														?>
														</span>
														<h3>
														<?php
														
														switch($row['form']) {
															case "CSOPCSOTimeSheet":
																echo "CSO/PSCO Time Sheet";
																break;
															case "NPASTimeSheet":
																echo "NPAS Time Sheet";
																break;
															case "MPUTimeSheet":
																echo "MPU Time Sheet";
																break;
															case "SFUTimeSheet":
																echo "SFU Time Sheet";
																break;
															case "NCUTimeSheet":
																echo "NCU Time Sheet";
																break;
															case "CSOPSCORecommendation":
																echo "CSO/PCSO Recommendation Sheet";
																break;
															case "PCSPCRecommendation":
																echo "PC/SPC Recommendation Sheet";
																break;
															case "JuniorCommandRecommendation":
																echo "Junior Command Recommendation Sheet";
																break;
															case "NPASDamageReport":
																echo "NPAS Damage Report";
																break;
															case "LeaveofAbsenseForm":
																echo "Leave of Absense Form";
																break;
															case "ResignationForm":
																echo "Resignation Form";
																break;
															default:
																echo "Unknown Form";
																break;
														}
														
														?>
														</h3>
														<p>
														<?php
														
														switch($row['form']) {
															case "CSOPCSOTimeSheet":
																echo "Duty Time: ".$row['TotalTime']."";
																break;
															case "NPASTimeSheet":
																echo "Duty Time: ".$row['TotalTime']."";
																break;
															case "MPUTimeSheet":
																echo "Duty Time: ".$row['TotalTime']."";
																break;
															case "SFUTimeSheet":
																echo "Duty Time: ".$row['TotalTime']."";
																break;
															case "NCUTimeSheet":
																echo "Duty Time: ".$row['TotalTime']."";
																break;
															case "CSOPSCORecommendation":
																echo "Recommended: ";
																break;
															case "PCSPCRecommendation":
																echo "Recommended: ";
																break;
															case "JuniorCommandRecommendation":
																echo "Recommended: ";
																break;
															case "NPASDamageReport":
																echo "Aircraft: ";
																break;
														}
														
														?>
														</p>
													</div>
												</a>
											</div>
										<?php
										}
									}
									?>
								</div>
							</div>
						<?php
							}
						}?>
					</div>
				</main>
				<?php
				break;
			case "settings":
				include("./includes/police/settings.php");
				break;
			default:
		?>
				<main id="police" class="container">
					<div class="MainSectionFULL">
						<div class="box">
							<h1>Welcome, <?=grabRank($pid, "Abr", true, false);?> <?=$_SESSION['username']?></h1>
							<!--
							<h3 class="subTitle">Police Statstics</h3>
							<div class="row">
								<div class="box inlineBox">
									<div class="totalIcon">
										<i class="fa fa-comment xxxlarge"></i>
									</div>
									<div class="totalCount">
										0
									</div>
									<div class="titleCount">
										<h3>Total Arrests</h3>
									</div>
								</div>
								<div class="box inlineBox">
									<div class="totalIcon">
										<i class="fa fa-comment xxxlarge"></i>
									</div>
									<div class="totalCount">
										0
									</div>
									<div class="titleCount">
										<h3>Total Tickets</h3>
									</div>
								</div>
								<div class="box inlineBox">
									<div class="totalIcon">
										<i class="fa fa-comment xxxlarge"></i>
									</div>
									<div class="totalCount">
										0
									</div>
									<div class="titleCount">	
										<h3>Total Impounds</h3>
									</div>
								</div>
								<div class="box inlineBox">
									<div class="totalIcon">
										<i class="fa fa-comment xxxlarge"></i>
									</div>
									<div class="totalCount">
										0
									</div>
									<div class="titleCount">
										<h3>Total Crushed</h3>
									</div>
								</div>
							</div>
							-->
						</div>
					</div>
				</main>
		<?php
				break;
		}
		?>
		<div id="footer"></div>
		<footer class="footer" style="display: block; clear: both;">
			<center>
				<img src="http://freeflightinteractive.co.uk/old/Images/FF-interactive-white.png" height="200px" width="200px">
				<div class="info">
					<p style="margin-top: 16px; margin-bottom: 16px;">© <?php echo date("Y"); ?> FreeFlight Interactive. All rights reserved.<br><span style="font-size: 12px;">Faction Software by <a class="footerLink" href="http://freeflightinteractive.co.uk/old/Forums/topic/3-current-freeflight-developers/">FreeFlight Interactive Development Team</a></span></p>
					<p style="margin-top: 16px; margin-bottom: 16px;"></p>
				</div>
			</center>
		</footer>
		<script>
		document.getElementById("defaultOpen").click();
		function searchForms(tab) {
			// Declare variables
			var input, filter, ul, li, a, i;
			input = document.getElementById('formInput');
			filter = input.value.toUpperCase();
			switch(tab) {
				case "Tab1":
					ul = document.getElementById("formList");
					break;
				case "Tab2":
					ul = document.getElementById("formListPAST");
					break;
			}
			li = ul.getElementsByTagName('a');
				
			// Loop through all list items, and hide those who don't match the search query
			for (i = 0; i < li.length; i++) {
				a = li[i].getElementsByTagName("h3")[0];
				if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
					li[i].style.display = "";
				} else {
					li[i].style.display = "none";
				}
			}
		}
		function changeTab(evt, tab, page) {
			switch(page) {
				case "forms":
					history.pushState(null, null, 'police.php?page=myArea&section=forms&tab='+tab);
					break;
				case "officerProfile":
					history.pushState(null, null, 'police.php?page=staff&section=officers&officer=<?=$_GET['officer'];?>&tab='+tab);
					break;
				case "profile":
					history.pushState(null, null, 'police.php?page=myProfile&tab='+tab);
					break;
			}
			var i, tabcontent, tablinks;

			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}

			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}

			document.getElementById(tab).style.display = "block";
			evt.currentTarget.className += " active";
		}
		function changeFormType(type, tab) {
			//history.pushState(null, null, 'police.php?page=myArea&section=forms&type='+type);
			switch(tab) {
				case "Tab1":
					var list = document.getElementById("formList");
					break;
				case "Tab2":
					var list = document.getElementById("formListPAST");
					break;
			}
			var TimesheetItems = list.getElementsByClassName("TimeSheet");
			var RecommendationItems = list.getElementsByClassName("Recommendations");
			var OtherItems = list.getElementsByClassName("Other");
			
		    switch(type) {
				
				case "TimeSheet":
					document.getElementById("formTypes").value = type;
					for(var i = 0; i < TimesheetItems.length; i++)
					{
						TimesheetItems[i].style.display="block";
					}
					for(var i = 0; i < RecommendationItems.length; i++)
					{
						RecommendationItems[i].style.display="none";
					}
					for(var i = 0; i < OtherItems.length; i++)
					{
						OtherItems[i].style.display="none";
					}
				break;
				
				case "Recommendations":
					document.getElementById("formTypes").value = type;
					for(var i = 0; i < TimesheetItems.length; i++)
					{
						TimesheetItems[i].style.display="none";
					}
					for(var i = 0; i < RecommendationItems.length; i++)
					{
						RecommendationItems[i].style.display="block";
					}
					for(var i = 0; i < OtherItems.length; i++)
					{
						OtherItems[i].style.display="none";
					}
					break;
					
				case "Other":
					document.getElementById("formTypes").value = type;
					for(var i = 0; i < TimesheetItems.length; i++)
					{
						TimesheetItems[i].style.display="none";
					}
					for(var i = 0; i < RecommendationItems.length; i++)
					{
						RecommendationItems[i].style.display="none";
					}
					for(var i = 0; i < OtherItems.length; i++)
					{
						OtherItems[i].style.display="block";
					}
					break;
					
				default:
					document.getElementById("formTypes").value = type;
					for(var i = 0; i < TimesheetItems.length; i++)
					{
						TimesheetItems[i].style.display="block";
					}
					for(var i = 0; i < RecommendationItems.length; i++)
					{
						RecommendationItems[i].style.display="block";
					}
					for(var i = 0; i < OtherItems.length; i++)
					{
						OtherItems[i].style.display="block";
					}
			}
		}
		<?php
		if(isset($_GET['type']) && isset($_GET['page']) && isset($_GET['section'])) {
			if($_GET['page'] == "myArea" && $_GET['section'] == "forms") {
				//echo "changeFormType('".$_GET['type']."');";
			}
		}
		?>
		</script>
	</body>
</html>
<?php
} else {
	// Not logged in? Time to let you login then!
	$page = "Login";
	if(isset($_POST['name']) && isset($_POST['pwd'])) {
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$pwd = mysqli_real_escape_string($db, $_POST['pwd']);
		
		$sql_fetch_id = "SELECT Password FROM officers WHERE Username='".$name."'";
		$query_id = mysqli_query($db,$sql_fetch_id);
		
		if ($query_id->num_rows > 0) {
			while($row = $query_id->fetch_assoc()) {
				$hash = $row['Password'];
			}
		} else {
			header("Location: http://freeflightinteractive.co.uk/old/police.php?msg=1A");
			exit;
		};
		
		if (password_verify($pwd, $hash)) {
			$_SESSION['username'] = $name;
			header("Location: http://freeflightinteractive.co.uk/old/police.php");
			exit;
		} else {
			header("Location: http://freeflightinteractive.co.uk/old/police.php?msg=1A");
			exit;
		}
	} else {
	?>
	<html>
		<head>
			<meta charset="utf-8"> 
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title><?=$page;?> - Altis Constabulary</title>
				
			<link rel="icon" href="http://freeflightinteractive.co.uk/old/Favicon.ico">
			<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/main.css" type="text/css" />
			<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/font-awesome.css" type="text/css" />
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
			<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
			<script>
			window.addEventListener("load", function(){
			window.cookieconsent.initialise({
				container: document.getElementById("footer"),
				"palette": {
					"popup": {
						"background": "#222222"
					},
					"button": {
					  "background": "#14a7d0"
					}
				},
				"theme": "edgeless",
				"static": true,
				"content": {
					"message": "This website uses cookies"
				  }
			})});
			</script>
		</head>
		<body id="elLogin">
			<div id="elLogin">
			<div class="loginPanel box">
				<center>
					<h1>Altis Police Constabulary</h1>
					<img src="./images/uk_badge.png" height="250" width="200">
				</center>
				<?php
				if(isset($_GET['msg'])) {
					switch($_GET['msg']) {
						case "1A":
							echo '<span style="color: red;">You have entered incorrect information!</span>';
							break;
					}
				}
				?>
				<form action="/police.php" method="POST">
					Username:<br>
					<input class="inputHappy" type="text" name="name" value="" placeholder="Input Username...">
					<br>
					Password:<br>
					<input class="inputHappy" type="password" name="pwd" value="" placeholder="Input Password...">
					<br><br>
					<input class="buttonHappy" type="submit" value="Submit">
				</form> 
				<div id="footer"></div>
			</div>
		</body>
	</html>
	<?php
	}
}
mysqli_close($db);
?>
<a class="mainSite" href="http://freeflightinteractive.co.uk/old/"><- Main Site</a>