<?php

$JSONpricelist = file_get_contents("https://api.csgofast.com/price/all");
$Pricelist = json_decode($JSONpricelist);

$sth = $conn->prepare( "IF EXISTS(SELECT MarketName FROM Skins WHERE MarketName=:MarketName)
						THEN
							UPDATE SkinPrices SET BuyPrice=:BuyPrice, SellPrice=:SellPrice WHERE (SkinMarketName=:MarketName);
						ELSE
							INSERT INTO Skins (MarketName) VALUES (:MarketName);
							INSERT INTO SkinPrices (SkinMarketName, BuyPrice, SellPrice) VALUES (:MarketName, :BuyPrice, :SellPrice);
						END IF;");
$sth->bindParam(':BuyPrice', $buyPrice);
$sth->bindParam(':SellPrice', $sellPrice);
$sth->bindParam(':MarketName', $market_name);

foreach($Pricelist AS $market_name => $price) {
	$buyPrice = $price * 100 - 3;
	$sellPrice = $price * 107 + 3;
	$sth->execute();
}