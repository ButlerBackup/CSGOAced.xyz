<?php

$sth = $conn->prepare("SELECT Skins.MarketName, Skins.Name, Skins.IconURL, Skins.Color, SkinPrices.BuyPrice, SkinPrices.SellPrice, Inventories.ClassID, Inventories.AssetID FROM Skins INNER JOIN SkinPrices INNER JOIN Inventories ON Inventories.UserID=:UID AND Skins.MarketName=SkinPrices.SkinMarketName and Skins.MarketName=Inventories.SkinMarketName ORDER BY SkinPrices.BuyPrice DESC;");
$sth->execute(array(':UID' => $_SESSION['UID']));
$skins = $sth->fetchAll();

foreach ($skins as $skin) {
	?>
		<div class="col-xs-6 col-md-3">
			<div class="thumbnail">
				<img src="https://steamcommunity-a.akamaihd.net/economy/image/<?php echo $skin['IconURL'];?>/500fx300f" alt="<?php echo $skin['MarketName'];?>">
				<h5><?php echo $skin['BuyPrice'];?></h5>
				<div class="caption">
					<p><?php echo $skin['MarketName'];?></p>
					<button type="button" class="btn btn-info btn-md addCart" data-icon="https://steamcommunity-a.akamaihd.net/economy/image/<?php echo $skin['IconURL'];?>/500fx300f" data-name="<?php echo $skin['MarketName'];?>" data-price="<?php echo $skin['BuyPrice'];?>" data-assetID="<?php echo $skin['AssetID'];?>" data-classID="<?php echo $skin['ClassID'];?>">Deposit <span class="glyphicon glyphicon-shopping-cart"></span></button>
				</div>
			</div>
		</div>
	<?php
}