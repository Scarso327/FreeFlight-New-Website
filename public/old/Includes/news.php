<?php
if(isset($_GET['article'])) {
	if(isset($_GET['action'])) {
		switch($_GET['action']) {
				case "create":
				
					break;
				default: ?>
					<main class="container">
						<div class="box articleB">
							<div class="breadcrumb">
								<a href="http://freeflightinteractive.co.uk/old/?page=community">Community</a>
								<span class="slashes">//</span>
								<a href="http://freeflightinteractive.co.uk/old/?page=news">News</a>
								<span class="slashes">//</span>
								<a class="active" href="http://freeflightinteractive.co.uk/old/?page=news&action">Null Action</a>						</div>
							<?php echo "Null Action"; ?>
						</div>
					</main>
					<?php break;
		}
	} else {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "FreeFlight";
				
		$db = new mysqli($servername, $username, $password, $dbname);

		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}

		$sql_fetch_id = "SELECT * FROM news WHERE id='".$_GET['article']."'";
		$query_id = mysqli_query($db,$sql_fetch_id);

		if(mysqli_num_rows($query_id) != 0) {
			while($row = $query_id->fetch_assoc()) { 
	?>	
			<div class="articleCover " style="background-image: url(./images/<?=$row['thumbnail'];?>);">
			
			
			</div>
			<main class="container">
				<div class="box articleB">
					<div class="breadcrumb">
						<a href="http://freeflightinteractive.co.uk/old/?page=community">Community</a>
						<span class="slashes">//</span>
						<a href="http://freeflightinteractive.co.uk/old/?page=news">News</a>
						<span class="slashes">//</span>
						<a class="active" href="http://freeflightinteractive.co.uk/old/?page=news&article=<?=$row['id'];?>"><?=$row['title'];?></a>
					</div>
					<h1 class="articleTitle">
						<?=$row['title'];?>
						<span class="updateInfo"><?=$row['articleType'];?> - <?php $timestamp = strtotime($row['timeCreated']); echo date("d/m/Y", $timestamp);?></span>
						<span class="articleAuthor" >By 
							<a href="<?=$row['publisherURL'];?>"><?=$row['publisher'];?></a>
						</span>
					</h1>
					<?=$row['article'];?>
				</div>
			</main>
			<?php
			}
		} else { ?>
			<main class="container">
				<div class="box articleB">
					<div class="breadcrumb">
						<a href="http://freeflightinteractive.co.uk/old/?page=community">Community</a>
						<span class="slashes">//</span>
						<a href="http://freeflightinteractive.co.uk/old/?page=news">News</a>
						<span class="slashes">//</span>
						<a class="active">Missing Article</a>
					</div>
					<h1 class="articleTitle">
						Missing Article
						<span class="updateInfo">This Article could not be found in our database!</span>
					</h1>
				</div>
			</main>
		<?php
		}
	}
} else if(isset($_GET['action'])) {
	switch($_GET['action']) {
			case "create":
			
				break;
			default: ?>
				<main class="container">
					<div class="box articleB">
						<div class="breadcrumb">
							<a href="http://freeflightinteractive.co.uk/old/?page=community">Community</a>
							<span class="slashes">//</span>
							<a href="http://freeflightinteractive.co.uk/old/?page=news">News</a>
							<span class="slashes">//</span>
							<a class="active" href="http://freeflightinteractive.co.uk/old/?page=news&action">Null Action</a>						
						</div>
						<?php echo "Null Action"; ?>
					</div>
				</main>
				<?php break;
	}
} else {
// News Types
// Annoucement
// General
// Q&A
// Maintenance
// Development
?>
	<main class="container">
		<div class="box articleB">
			<div class="breadcrumb">
				<a href="http://freeflightinteractive.co.uk/old/?page=community">Community</a>
				<span class="slashes">//</span>
				<a class="active" href="http://freeflightinteractive.co.uk/old/?page=news">News</a>
			</div>
			<form class="selectOptions" action="">
			  <select name="articleOptions" onChange="changeNews();">
				<option value="All">All</option>
				<!-- 
				<option value="Annoucement">Annoucement</option>
				<option value="General">General</option>
				<option value="Q&A">Q&A</option>
				<option value="Maintenance">Maintenance</option>
				<option value="Development">Development</option>
				-->
			  </select>
			  <br><br>
			</form>
			<h2>The Lastest</h2>
			<div class="articleList">
				<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "FreeFlight";
							
				$db = new mysqli($servername, $username, $password, $dbname);

				if ($db->connect_error) {
					die("Connection failed: " . $db->connect_error);
				}
					
				if (isset($_GET["pageNumber"])) { 
					if($_GET["pageNumber"] != 0 && $_GET["pageNumber"] != "") {
						$page  = $_GET["pageNumber"]; 
					} else {
						$page=1; 
					}
				} else { 
					Header ("Location: http://freeflightinteractive.co.uk/old/?page=news&pageNumber=1");
				}; 
					
				$results_per_page = 5;
					
				$start_from = ($page-1) * $results_per_page;
				$sql_fetch_id = "SELECT * FROM news WHERE isPublished='1' ORDER BY orderID DESC LIMIT ".$start_from.", ".$results_per_page;
				$query_id_users = mysqli_query($db,$sql_fetch_id);
					
				if(mysqli_num_rows($query_id_users) > 0) {
					while($row = $query_id_users->fetch_assoc()) {
				?>
					<a href="http://freeflightinteractive.co.uk/old/?page=news&article=<?=$row['id'];?>">
						<div class="listThumbnail">
							<div class="thumbnail" style="background-image: url(./images/<?=$row['thumbnail'];?>);"></div>
						</div>
						<div class="listInfo">
							<span><?=$row['articleType'];?> - <?php $timestamp = strtotime($row['timeCreated']); echo date("d/m/Y", $timestamp);?></span>
							<h3><?=$row['title'];?></h3>
							<p></p>
						</div>
					</a>	
				<?php
					}
				} else { ?>
					<div class="updateNull">
						<br>
						<center>
							<h3>No Updates Found</h3>
						</center>
					</div>
				<?php
				}
				?>
			</div>
			<div class="pageList">
			<?php 
				$sql = "SELECT COUNT(orderID) AS total FROM news";
				
				$query_id_users = mysqli_query($db,$sql);
									
				if(mysqli_num_rows($query_id_users) > 0) {
					$row = $query_id_users->fetch_assoc();
					$total_pages = ceil($row["total"] / $results_per_page); 

					$page = $_GET["pageNumber"] - 1; 
					if($page < 1) {
						$page = 1;
					}
					?> 
					<a href='http://freeflightinteractive.co.uk/old/?page=news&pageNumber=<?=$page;?>'><<</a>
					<?php 
					for ($i=1; $i<=$total_pages; $i++) {  
								echo "<a href='http://freeflightinteractive.co.uk/old/?page=news&pageNumber=".$i."'";
								if ($i==$_GET["pageNumber"])  echo " class='selected'";
								echo ">".$i."</a> "; 
					}; 
					$page = $_GET["pageNumber"] + 1; 
					if($page == $total_pages || $page > $total_pages) {
						$page = $total_pages;
					}
					?> 
					<a href='http://freeflightinteractive.co.uk/old/?page=news&pageNumber=<?=$page;?>'>>></a>
					<?php 
				}
				?>
			</div>
		</div>
	</main>
<?php
}
?>