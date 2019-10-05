<html>
	<?php
	$page = "Home";
	$update = false;
	$forumsOnline = true;
	
	if(isset($_GET['page'])) {
		switch ($_GET['page']) {
			case "news":
				$page = "News";
				break;
			default: 
				$page = "404";
				break;
		}
	}

	require './Forums/init.php';
	\IPS\Session\Front::i();

	if($update == false) {
	?>
	<head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$page;?> - FreeFlight Interactive</title>
		
		<link rel="icon" href="http://freeflightinteractive.co.uk/old/Favicon.ico">
		<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/main.css?v=<?=time();?> type="text/css" />
		<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/font-awesome.css?v=<?=time();?> type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	
	<body>
		<nav>
			<div class="navContainer">
				<div class="logoTitle">
					<img src="http://freeflightinteractive.co.uk/old/Images/website-top-left-ting.png">
				</div>
				<div class="left">
					<ul>
						<li <?php if($page == "Home") { ?>style="box-shadow: 0px -3px 0px #00dfff inset;"<?php } ?>>
							<a href="http://freeflightinteractive.co.uk/old/">Home</a>
						</li>
						<li class="dropdown" <?php if($page == "News" || $page == "Community") { ?>style="box-shadow: 0px -3px 0px #00dfff inset;"<?php } ?>>
							<a href="http://freeflightinteractive.co.uk/old/Forums" >Community</a>
							<div class="dropdown-content">
								<a href="http://freeflightinteractive.co.uk/old/Forums">Forums</a>
								<a href="http://freeflightinteractive.co.uk/old/?page=news">News</a>
							</div>
						</li>
						<li>
							<a href="http://freeflightinteractive.co.uk/old/Forums/rules/?rule=0.X">Rules</a>
						</li>
						<li>
							<a href="http://freeflightinteractive.co.uk/old/Forums/Stats/" >Stats</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
			
		switch($_GET['page']) {
			case "community":
				header("Location: http://freeflightinteractive.co.uk/old/Forums/");
				die();
				break;
			case "news":
				include("./includes/news.php");
				break;
			default:
				if(!(isset($_GET['page']))) {
		?>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "FreeFlight";
					
		$db = new mysqli($servername, $username, $password, $dbname);

		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}

		$sql_fetch_id = "SELECT * FROM news WHERE isBanner='1' and isPublished='1' ORDER BY orderID DESC LIMIT 1";
		$query_id = mysqli_query($db,$sql_fetch_id);

		if(mysqli_num_rows($query_id) != 0) {
			while($row = $query_id->fetch_assoc()) { ?>
				<div class="banner">
					<a class="updateBox" href="http://freeflightinteractive.co.uk/old/?page=news&amp;article=<?=$row['id'];?>" style="background-image: url(http://freeflightinteractive.co.uk/old/images/<?=$row['thumbnail'];?>);">
						<div class="headline">
							<span><?=$row['articleType'];?> - <?php $timestamp = strtotime($row['timeCreated']); echo date("d/m/Y", $timestamp);?></span>
							<h3><?=$row['title'];?></h3>
						</div>
					</a>
				</div>
			<?php
			}
		} 
		mysqli_close($db);
		?>
		<main class="container">
				<div class="MainSection" style="width: 100%;">
					<div class="box">
						<h2>The Latest</h2>
						<div class="featuredUpdates">
							<?php
							include("./system/grabFeaturedArticles.php");
							?>
						</div>
						<div class="genericUpdates">
							<?php
							include("./system/grabArticles.php");
							?>
						</div>
						<?php
						if($updateFound == true || $updateFeaturedFound == true) { ?>
							<a class="updateLink" href="http://freeflightinteractive.co.uk/old/?page=news">View All Updates »</a>
						<?php
						}
						?>
					</div>
				</div>
				<div class="SecondarySection" style="display: none;">
					<div class="box">
						<h2>Blank</h2>
					</div>
				</div>
		</main>
		<?php
				}
				break;
		}
		?>
		<footer class="footer" style="display: block; clear: both;">
			<center>
				<img src="http://freeflightinteractive.co.uk/old/Images/FF-interactive-white.png" height="200px" width="200px">
				<div class="info">
					<p style="margin-top: 16px; margin-bottom: 16px;">© <?php echo date("Y"); ?> FreeFlight Interactive. All rights reserved.<br><span style="font-size: 12px;">Website Designed by <a class="footerLink" href="http://freeflightinteractive.co.uk/old/Forums/topic/3-current-freeflight-developers/">FreeFlight Interactive Development Team</a></span></p>
					<p style="margin-top: 16px; margin-bottom: 16px;"></p>
				</div>
			</center>
		</footer>
		<?php
		} else {
		?>
	<head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Updating - FreeFlight Interactive</title>
		
		<link rel="icon" href="http://freeflightinteractive.co.uk/old/Favicon.ico">
	</head>
		<style>
		body, html {
			height: 100%;
			margin: 0;
			font-family: 'Montserrat',sans-serif;
		}

		.bgimg {
			background-image: url('./images/background.png');
			height: 100%;
			background-position: center;
			background-size: cover;
			position: relative;
			color: white;
			font-family: "Courier New", Courier, monospace;
			font-size: 25px;
		}

		.topleft {
			position: absolute;
			top: 0;
			left: 16px;
		}

		.bottomleft {
			position: absolute;
			bottom: 0;
			left: 16px;
		}

		.middle {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			text-align: center;
			background-color:rgba(0, 0, 0, 0.5);
			padding: 10px;
		}

		hr {
			margin: auto;
			width: 40%;
		}
		</style>
		<body>

		<div class="bgimg">
		  <div class="topleft">
			<img src="http://freeflightinteractive.co.uk/old/Images/FF-interactive-PNG.png" width="164px;">
		  </div>
		  <div class="middle">
			<h1>UPDATE</h1>
			<hr>
			<p>We're updating our web systems, please be patient.<?php if($forumsOnline == true) { ?> <br><a style="color: white; text-decoration: none;" href="http://freeflightinteractive.co.uk/old/Forums/"><b>Our Forums Are Still Up!</b></a><?php } ?></p>
		  </div>
		</div>

		</body>
		
		<?php
		}
		?>
	</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54529136-3', 'auto');
  ga('send', 'pageview');

</script>
</html>