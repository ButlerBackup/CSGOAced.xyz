<?php

require ("lib/controller/Config.php");
require ("lib/SteamAuth/steamauth/steamauth.php");

$GetPage = $Page->Home;
if (isset($_GET['p'])){ $GetPage = $_GET['p']; }

if(isset($_SESSION['steamid'])) {
	require ('lib/SteamAuth/steamauth/userInfo.php');
	require ('lib/database/Connect.php');
	require ('lib/database/RegisterUser.php');

	if($_SESSION['Role'] == "Admin"){
		if (isset($_GET[$Page->RefreshPrices])){
			require ('lib/database/UpdateSkinPrices.php');
		}
	}
}