<div id="inventory" class="col-sm-8">
	<?php require ('lib/database/ShowInventory.php'); ?>
</div>

<div class="col-sm-4">
	<a href="<?php echo $Link->Website . '?p='. $Page->Deposit . "&" . $Page->UpdateInventory; ?>" class="btn btn-info btn-md update-inventory">Reload Inventory</a>
	<div id="depositBox" class="col-xs-12 col-md-12 thumbnail">
		<h3 id="showCoins">0 Coins</h3>
		<div class="caption">
			<button class="btn btn-success btn-md checkout"><span class="glyphicon glyphicon-share-alt"></span> Deposit</button>
			<button class="btn btn-danger btn-md clearCart">Clear <span class="glyphicon glyphicon-trash"></span></button>
		</div>
	</div>
	
	<div id="showCart">

	</div>
</div>