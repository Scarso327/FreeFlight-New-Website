<?php
function createID($length = 11) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	if(strlen($randomString) > 11) {
		echo "ID Creation Error: Length >";
	}
    return $randomString;
}

if(isset($_GET['action'])) {
	if($_GET['action'] == "create") {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "FreeFlight";
				
		$db = new mysqli($servername, $username, $password, $dbname);

		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}
		
		$id = createID();
		$idCreated = false;
		$maxTries = 3;
		$currentTries = 0;
		
		while(!$idCreated) {
			$sql_fetch_id = "SELECT * FROM news WHERE id='".$id."'";
			$query_id = mysqli_query($db,$sql_fetch_id);
								
			if ($query_id->num_rows > 0) {
				$currentTries = $currentTries + 1;
				if($currentTries >= $maxTries) {
					die("Failed to create unique id");
				} 
				$id = createID();
			} else {
				$idCreated = true;
			}
		}
		
		$time = date('Y-m-d H:i:s');
		
		require './Forums/init.php';
		\IPS\Session\Front::i();
		
		if (\IPS\Member::loggedIn()->member_id) {
			$member = \IPS\Member::loggedIn();
			$creator = $member->name;
			$creatorURL = $member->url();
		} else {
			die("User Fail...");
		}
		
		$title = mysqli_real_escape_string($db, $_GET['title']);
		$article = mysqli_real_escape_string($db, $_GET['article']);
		
		if(isset($title) && isset($_GET['type']) && isset($article) && isset($creator) && isset($creatorURL) && isset($time)) {
			$sql_fetch_id = "INSERT INTO news (id, articleType, publisher, publisherURL, title, thumbnail, article, isFeatured, isPublished, timeCreated) VALUES ('".$id."', '".$_GET['type']."', '".$creator."', '".$creatorURL."', '".$title."', '".$id."icon.jpg', '".$article."', '0', '0', CURRENT_TIMESTAMP)";
			$query_id = mysqli_query($db,$sql_fetch_id);
								
			if($query_id == true) {
				header("Location: http://freeflightinteractive.co.uk/old/?page=news&article=".$id."");
				exit;
			} else {
				echo "Error updating record: " . $db->error;
			}
		} else {
			die("Data Fail...");
		}
		
		mysqli_close($db);
	}
} else {
	die("Data Fail...");
}
?>