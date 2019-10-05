<html>
	<head>
		<title>Article Creation - FreeFlight Interactive</title>
		
		<link rel="icon" href="http://freeflightinteractive.co.uk/old/Favicon.ico">
		<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/main.css" type="text/css" />
		<link rel="stylesheet" href="http://freeflightinteractive.co.uk/old/css/font-awesome.css" type="text/css" />
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
						<li <?php $page = "Community"; if($page == "Home") { ?>style="box-shadow: 0px -3px 0px #00dfff inset;"<?php } ?>>
							<a href="http://freeflightinteractive.co.uk/old/">Home</a>
						</li>
						<li class="dropdown" <?php if($page == "News" || $page == "Community") { ?>style="box-shadow: 0px -3px 0px #00dfff inset;"<?php } ?>>
							<a href="http://freeflightinteractive.co.uk/old/Forums" >Community</a>
							<div class="dropdown-content">
								<a href="http://freeflightinteractive.co.uk/old/Forums">Forums</a>
								<a href="http://freeflightinteractive.co.uk/old/?page=news">News</a>
							</div>
						</li>
					</ul>
				</div>
				<div class="right">
					<li>
						<a href="http://freeflightinteractive.co.uk/old/Forums/modcp/announcements/">Return</a>
					</li>
				</div>
			</div>
		</nav>
		<main class="container">
			<div class="MainSectionFULL">
				<div class="box">
					<div class="breadcrumb">
						<a href="http://freeflightinteractive.co.uk/old/?page=community">Community</a>
						<span class="slashes">//</span>
						<a href="http://freeflightinteractive.co.uk/old/Forums/modcp/">Moderator CP</a>
						<span class="slashes">//</span>
						<a href="http://freeflightinteractive.co.uk/old/Forums/modcp/announcements/">Annoucements</a>	
						<span class="slashes">//</span>
						<a class="active" href="http://freeflightinteractive.co.uk/old/Forums/createarticle/">Create Article</a>						
					</div>
					<h1 class="articleTitle">
					</h1><br>
					<script type="text/javascript" src="http://freeflightinteractive.co.uk/old/ckeditor/ckeditor.js"></script>
					<form action="http://freeflightinteractive.co.uk/old/createNews.php">
						<input name="action" value="create" hidden>
						<div class="form-group">
							<label for="title">Title:</label>
							<input name="title" style="max-width: 350px; width: 100%;" type="title" class="form-control" id="title">
						</div>
						<div class="form-group">
							<label for="type">Type:</label>
							<select name="type" type="type" class="form-control" id="type">
								<option value="Annoucement">Annoucement</option>
								<option value="General">General</option>
								<option value="Q&A">Q&A</option>
								<option value="Maintenance">Maintenance</option>
								<option value="Development">Development</option>
							</select>
						</div>
						<div class="form-group">
							<label for="article">Article:</label>
							<textarea name="article" style="max-width: none !important; height: 200px; padding: 0; border: 0;" type="article" class="form-control" id="article"></textarea>
							<script>
								CKEDITOR.replace( 'article' );
							</script>
						</div>
						<!--
						<div class="form-group checkbox">
							<label><input name="publish" type="checkbox"> Publish On Create?</label>
						</div>
						-->
						<button type="submit" class="btn btn-default">Create</button>
					</form>
				</div>
			</div>
		</main>
		<footer class="footer" style="display: block; clear: both;">
			<center>
				<img src="http://freeflightinteractive.co.uk/old/Images/FF-interactive-white.png" height="200px" width="200px">
				<div class="info">
					<p>&copy; <?php echo date("Y"); ?> FreeFlight Interactive. All rights reserved.<br><p>
				</div>
			</center>
		</footer>
	</body>
</html>