<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FreeFlight";
		
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$sql_fetch_id = "SELECT * FROM news";
$query_id = mysqli_query($db,$sql_fetch_id);

if(mysqli_num_rows($query_id) != 0) {
	echo mysqli_num_rows($query_id);
}
mysqli_close($db);
?>