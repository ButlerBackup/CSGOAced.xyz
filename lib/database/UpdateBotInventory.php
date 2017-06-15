<?php
// Update Inventory
$JSONInventory = file_get_contents('https://steamcommunity.com/inventory/'.$Vars->BotSteam64.'/730/2?l=english');

if($JSONInventory != null){

	$inventory = json_decode($JSONInventory);
	$sth = $conn->prepare("DELETE FROM Inventories WHERE UserID=:UID;");
	$sth->bindParam(':UID', $Vars->BotUID);
	$sth->execute();

	$sth = $conn->prepare("INSERT INTO Inventories (UserID, SkinMarketName, Assetid, Classid) VALUES (:UID, :SkinMarketName, :Assetid, :Classid);");

	foreach($inventory->descriptions AS $description) {
		if($description->tradable == 1 && $description->marketable == 1){
			foreach($inventory->assets AS $item) {
				if($description->classid == $item->classid){

					$sth1 = $conn->prepare("SELECT * FROM SkinPrices WHERE SkinMarketName=:SkinMarketName;");
					$sth1->execute(array(':SkinMarketName' => $description->market_name));
					$skinExists = $sth1->fetchAll();

					if($skinExists!=NULL){
						$sth->execute(array(':UID'=> $Vars->BotUID, ':SkinMarketName' => $description->market_name, ':Assetid' => $item->assetid, ':Classid' => $item->classid));

						$sth1 = $conn->prepare("SELECT MarketName FROM Skins WHERE (MarketName=:SkinMarketName AND IconURL IS NULL);");
						$sth1->execute(array(':SkinMarketName' => $description->market_name));
						$skinDetails = $sth1->fetchAll();
						
						if ($skinDetails!=NULL){
							$sth1 = $conn->prepare("UPDATE Skins SET Name=:Name, IconURL=:IconURL, Color=:Color WHERE MarketName=:SkinMarketName;");
							$sth1->execute(array(':SkinMarketName' => $description->market_name, ':Name' => $description->name, ':Color' => $description->name_color, ':IconURL' => $description->icon_url));
						}
					}
				}
			}
		}
	}
}else{
	//Inventory Not Public
}