<?php
require_once ("lib/controller/CSGOAcedController.php");

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

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require ("lib/view/head.php"); ?>
	</head>

	<body>
		<script>
		/*
																																							   dddddddd
		CCCCCCCCCCCCC   SSSSSSSSSSSSSSS         GGGGGGGGGGGGG     OOOOOOOOO                 AAA                                                                d::::::d
	 CCC::::::::::::C SS:::::::::::::::S     GGG::::::::::::G   OO:::::::::OO              A:::A                                                               d::::::d
   CC:::::::::::::::CS:::::SSSSSS::::::S   GG:::::::::::::::G OO:::::::::::::OO           A:::::A                                                              d::::::d
  C:::::CCCCCCCC::::CS:::::S     SSSSSSS  G:::::GGGGGGGG::::GO:::::::OOO:::::::O         A:::::::A                                                             d:::::d
 C:::::C       CCCCCCS:::::S             G:::::G       GGGGGGO::::::O   O::::::O        A:::::::::A            cccccccccccccccc    eeeeeeeeeeee        ddddddddd:::::d         xxxxxxx      xxxxxxxyyyyyyy           yyyyyyyzzzzzzzzzzzzzzzzz
C:::::C              S:::::S            G:::::G              O:::::O     O:::::O       A:::::A:::::A         cc:::::::::::::::c  ee::::::::::::ee    dd::::::::::::::d          x:::::x    x:::::x  y:::::y         y:::::y z:::::::::::::::z
C:::::C               S::::SSSS         G:::::G              O:::::O     O:::::O      A:::::A A:::::A       c:::::::::::::::::c e::::::eeeee:::::ee d::::::::::::::::d           x:::::x  x:::::x    y:::::y       y:::::y  z::::::::::::::z
C:::::C                SS::::::SSSSS    G:::::G    GGGGGGGGGGO:::::O     O:::::O     A:::::A   A:::::A     c:::::::cccccc:::::ce::::::e     e:::::ed:::::::ddddd:::::d            x:::::xx:::::x      y:::::y     y:::::y   zzzzzzzz::::::z
C:::::C                  SSS::::::::SS  G:::::G    G::::::::GO:::::O     O:::::O    A:::::A     A:::::A    c::::::c     ccccccce:::::::eeeee::::::ed::::::d    d:::::d             x::::::::::x        y:::::y   y:::::y          z::::::z
C:::::C                     SSSSSS::::S G:::::G    GGGGG::::GO:::::O     O:::::O   A:::::AAAAAAAAA:::::A   c:::::c             e:::::::::::::::::e d:::::d     d:::::d              x::::::::x          y:::::y y:::::y          z::::::z
C:::::C                          S:::::SG:::::G        G::::GO:::::O     O:::::O  A:::::::::::::::::::::A  c:::::c             e::::::eeeeeeeeeee  d:::::d     d:::::d              x::::::::x           y:::::y:::::y          z::::::z
 C:::::C       CCCCCC            S:::::S G:::::G       G::::GO::::::O   O::::::O A:::::AAAAAAAAAAAAA:::::A c::::::c     ccccccce:::::::e           d:::::d     d:::::d             x::::::::::x           y:::::::::y          z::::::z
  C:::::CCCCCCCC::::CSSSSSSS     S:::::S  G:::::GGGGGGGG::::GO:::::::OOO:::::::OA:::::A             A:::::Ac:::::::cccccc:::::ce::::::::e          d::::::ddddd::::::dd           x:::::xx:::::x           y:::::::y          z::::::zzzzzzzz
   CC:::::::::::::::CS::::::SSSSSS:::::S   GG:::::::::::::::G OO:::::::::::::OOA:::::A               A:::::Ac:::::::::::::::::c e::::::::eeeeeeee   d:::::::::::::::::d ......   x:::::x  x:::::x           y:::::y          z::::::::::::::z
	 CCC::::::::::::CS:::::::::::::::SS      GGG::::::GGG:::G   OO:::::::::OO A:::::A                 A:::::Acc:::::::::::::::c  ee:::::::::::::e    d:::::::::ddd::::d .::::.  x:::::x    x:::::x         y:::::y          z:::::::::::::::z
		CCCCCCCCCCCCC SSSSSSSSSSSSSSS           GGGGGG   GGGG     OOOOOOOOO  AAAAAAA                   AAAAAAA cccccccccccccccc    eeeeeeeeeeeeee     ddddddddd   ddddd ...... xxxxxxx      xxxxxxx       y:::::y           zzzzzzzzzzzzzzzzz
																																																		 y:::::y
																																																		y:::::y
																																																	   y:::::y
																																																	  y:::::y
																																																	 yyyyyyy
*/
		</script>
		<?php require ("lib/view/navbar.php"); ?>

		<?php require ("lib/view/content.php"); ?>

		<?php require ("lib/view/footer.php"); ?>

		<?php require ("lib/view/scripts.php"); ?>
	</body>
</html>
