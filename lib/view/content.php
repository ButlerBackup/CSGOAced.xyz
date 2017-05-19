        <main>
			<div class="jumbotron text-center">
				<h1>CSGO Aced</h1>
				<p><span class="glyphicon glyphicon-star"></span> From Champions to Champions. Join us and start winning skins!</p>
			</div>

			<div class="container">
				<div class="row">
					<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-alert"></span> Website Under Construction!</div>
				</div>
				<div class="row">
					<div id="inventory" class="col-sm-8">
						<?php require ('lib/database/ShowInventory.php'); ?>
					</div>

					<div class="col-sm-4">
						<div id="depositBox" class="col-xs-12 col-md-12 thumbnail deposit">
							<h3 id="showCoins">0 Coins</h3>
							<div class="caption">
								<button class="btn btn-success btn-md checkout"><span class="glyphicon glyphicon-share-alt"></span> Deposit</button>
								<button class="btn btn-danger btn-md clearCart">Clear <span class="glyphicon glyphicon-trash"></span></button>
							</div>
						</div>
						
						<div id="showCart">

						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="col-xs-6 col-md-3">
								<div id="coin-flip-cont">
									<div id="coin">
										<div class="front"></div>
										<div class="back"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>