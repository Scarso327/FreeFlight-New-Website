<?php
	// This file checks for clients that are logged in...
	require("steamauth.php");
	require("userInfo.php");
	$loggedIn = null;
	
	if(isset($_SESSION['steamid']))
	{
			// Yes Login
			$id = $_SESSION['steamid'];
			$loggedIn = true;
	} else {
			// No login
			$loggedIn = false;
	}

?>