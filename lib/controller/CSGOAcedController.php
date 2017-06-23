<?php
session_start();

require_once ("lib/controller/Config.php");

if (isset($_GET['r'])){ 
	$_SESSION['referal'] = strtolower($_GET['r']);
	header('Location: ' . $Link->Website);
	die();
}

if (isset($_GET['logout'])){
	require_once ('lib/database/Connect.php');
	require_once ('lib/database/Logout.php');
	require_once ("lib/SteamAuth/steamauth/steamauth.php");
}

require_once ("lib/SteamAuth/steamauth/steamauth.php");

$GetPage = $Page->Home;
if (isset($_GET['p'])){ $GetPage = $_GET['p']; }

if(isset($_SESSION['steamid'])) {
	require_once ('lib/SteamAuth/steamauth/userInfo.php');
	require_once ('lib/database/Connect.php');
	require_once ('lib/database/RegisterUser.php');
}

if (isset($_GET['m'])){
	if (!isset($_SESSION['UID'])){
		echo '<h3>Login to See This Content</h3>';
		die();
	}else{
		if ($GetPage == $Page->Admin && isset($_SESSION['Role']) && $_SESSION['Role'] == "Admin"){
			require_once ("lib/view/admin.php");
		}elseif ($GetPage == $Page->TradeURL){
			require_once ("lib/view/tradeurl.php");
		}elseif ($GetPage == $Page->FreeCoins){
			require_once ("lib/view/freecoins.php");
		}elseif ($GetPage == $Page->Referal){
			require_once ("lib/view/referal.php");
		}elseif ($GetPage == $Page->Deposit){
				require_once ('lib/database/ShowInventory.php');
		}elseif ($GetPage == $Page->Withdraw){
				require_once ('lib/database/ShowBotInventory.php');
		}elseif ($GetPage == $Page->Emojis){
			require_once ('lib/view/emojis.php');
		}elseif (isset($_GET['updateinventory'])){
			if (isset($_GET['bot'])){
				require_once ('lib/database/UpdateBotInventory.php');
			}else{
				require_once ('lib/database/UpdateInventory.php');
			}
		}
	}
	die();
}