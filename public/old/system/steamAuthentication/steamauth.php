<?php
ob_start();
session_start();

function logoutbutton() {
	echo "<form action='' method='get'><button name='logout' type='submit'>Logout</button></form>"; //logout button
}

function loginbutton($buttonstyle = "square") {
	$button['rectangle'] = "01";
	$button['square'] = "02";
	$button = "<a href='?login'><img src='http".(isset($_SERVER['HTTPS']) ? "s" : "")."://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
	
	echo $button;
}

if (isset($_GET['login'])){
	require 'openid.php';
	try {
		require 'SteamConfig.php';
		include_once("./system/db.php");
		
		$openid = new LightOpenID($steamauth['domainname']);
		
		if(!$openid->mode) {
			$openid->identity = 'http://steamcommunity.com/openid';
			header('Location: ' . $openid->authUrl());
		} elseif ($openid->mode == 'cancel') {
			echo 'User has canceled authentication!';
		} else {
			if($openid->validate()) { 
				$id = $openid->identity;
				$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
				preg_match($ptn, $id, $matches);

				$_SESSION['steamid'] = $matches[1];
				$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$_SESSION['steamid']; 
				$json_object= file_get_contents($url);
				$json_decoded = json_decode($json_object);
    
				foreach ($json_decoded->response->players as $player)
				{
					$sql_fetch_id = "SELECT steamid FROM usersSteam WHERE steamid='$player->steamid'";
					$query_id = mysqli_query($db,$sql_fetch_id);
					
					if(mysqli_num_rows($query_id) == 0) {
						$sql_steam = "INSERT INTO usersSteam (Username, steamid) VALUES ('$player->personaname','$player->steamid')";
						mysqli_query($db,$sql_steam);
					} else {
						// They are already in the database no need to add them, might call for some stuff
						// here in the future tho.
						
						// Make sure we have their current username.
						while($row = $query_id->fetch_assoc()) {
							$databasename = $row['Username'];
							$name = $player->personaname;
							if($name != $databasename) {
								$nameChange = true;
							} else {
								$nameChange = false;
							}
						}
						if($nameChange == true) {
							$sql_fetch_id = "UPDATE usersSteam SET Username='$player->personaname' WHERE steamid='$player->steamid'";
							$query_id = mysqli_query($db,$sql_fetch_id);
						} else {
						}
					}
					
					mysqli_close($db);
				}

				if (!headers_sent()) {
					header('Location: '.$steamauth['loginpage']);
					exit;
				} else {
					?>
					<script type="text/javascript">
						window.location.href="<?=$steamauth['loginpage']?>";
					</script>
					<noscript>
						<meta http-equiv="refresh" content="0;url=<?=$steamauth['loginpage']?>" />
					</noscript>
					<?php
					exit;
				}
			} else {
				// User is not logged in so we do nothing, we used to echo it but that ruined the look
				// of the page.
				// echo "User is not logged in.\n";
			}
		}
	} catch(ErrorException $e) {
		echo $e->getMessage();
	}
}

if (isset($_GET['update'])){
	unset($_SESSION['steam_uptodate']);
	require 'userInfo.php';
	header('Location: '.$_SERVER['PHP_SELF']);
	exit;
}

// Version 3.2

?>
