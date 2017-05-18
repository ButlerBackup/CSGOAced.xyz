<?php

$Page = (object) array( 'Home' => 'home',
						'Deposit' => 'deposit', 
						'Widthraw' => 'widthraw',
						'Admin' => 'admin',
						'History' => 'history',
						'FreeCoins' => 'freecoins',
						'TradeURL' => 'tradeurl',
						'Settings' => 'settings',
						'Logout' => 'logout');

require ("lib/SteamAuth/steamauth/steamauth.php");

if(isset($_SESSION['steamid'])) {
	require ('lib/SteamAuth/steamauth/userInfo.php');
	require ('lib/database/Connect.php');
	require ('lib/database/RegisterUser.php');
}

$GetPage = $Page->Home;

if (isset($_GET['p'])){ $GetPage = $_GET['p']; }