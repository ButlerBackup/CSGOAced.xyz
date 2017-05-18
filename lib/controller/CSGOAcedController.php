<?php

require ("lib/SteamAuth/steamauth/steamauth.php");

if(isset($_SESSION['steamid'])) {
	require ('lib/SteamAuth/steamauth/userInfo.php');
	require ('lib/database/Connect.php');
	require ('lib/database/RegisterUser.php');
}