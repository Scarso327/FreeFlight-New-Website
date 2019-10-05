<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FreeFlight";
		
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$sql_fetch_id = "SELECT * FROM news WHERE isPublished='1' ORDER BY orderID DESC LIMIT 2";
$query_id = mysqli_query($db,$sql_fetch_id);

$updateFeaturedFound = false;	
	
if(mysqli_num_rows($query_id) != 0) {
	$updateFeaturedFound = true;
	while($row = $query_id->fetch_assoc()) { ?>
						<a 
						<?php
						if(mysqli_num_rows($query_id) > 1) {
						?> class="updateBox"  <?php
						} else {
						?> class="updateBoxFULL"  <?php
						}
						?>
						href="http://freeflightinteractive.co.uk/old/?page=news&article=<?=$row['id'];?>">
							<div class="UpdateThumbnail">
								<div class="thumbnail" style="background-image: url(http://freeflightinteractive.co.uk/old/images/<?=$row['thumbnail'];?>);"></div>
							</div>
							<div class="updateInfo">
								<span><?=$row['articleType'];?> - <?php $timestamp = strtotime($row['timeCreated']); echo date("d/m/Y", $timestamp);?></span>
								<h3><?=$row['title'];?></h3>
								<p></p>
							</div>
						</a>
	<?php
	}
} else { ?>
						<div class="updateNull">
							<center>
								<h3>No Featured Updates Found</h3>
							</center>
						</div>
<?php
}
mysqli_close($db);
?>