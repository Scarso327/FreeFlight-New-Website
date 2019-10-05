<?php
session_start();
require 'system/steamAuthentication/SteamConfig.php';
session_unset();
session_destroy();
$loggedIn = false;
header('Location: '.$steamauth['logoutpage']);
exit;
?>