<?php

$JSONpricelist = file_get_contents("https://api.csgofast.com/price/all");
$Pricelist = json_decode($JSONpricelist);


$sth = $conn->prepare("DELETE FROM SkinPrices WHERE '1'='1';");
$sth->execute();

$sth = $conn->prepare( "IF NOT EXISTS(SELECT MarketName FROM Skins WHERE MarketName=:MarketName)
						THEN
							INSERT INTO Skins (MarketName) VALUES (:MarketName);
						END IF;");
$sth->bindParam(':MarketName', $market_name);

$sth1 = $conn->prepare("INSERT INTO SkinPrices (SkinMarketName, BuyPrice, SellPrice) VALUES (:MarketName, :BuyPrice, :SellPrice);");
$sth1->bindParam(':BuyPrice', $buyPrice);
$sth1->bindParam(':SellPrice', $sellPrice);
$sth1->bindParam(':MarketName', $market_name);

foreach($Pricelist AS $market_name => $price) {
	$buyPrice = $price * 100 - 3;
	$sellPrice = $price * 107 + 3;
	$sth->execute();
	$sth1->execute();
}