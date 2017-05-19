<main>
	<div class="jumbotron text-center">
		<h1>CSGO Aced</h1>
		<p><span class="glyphicon glyphicon-star"></span> <?php echo $Vars->Description; ?></p>
	</div>

	<div class="container">
		<div class="row">
			<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-alert"></span> Website Under Construction!</div>
		</div>
		<div class="row">
			<?php
				switch ($GetPage) {
					case $Page->Deposit:
						require ('lib/view/deposit.php');
						break;
					
					case $Page->Home:
					default:
						require ('lib/view/coinflip.php');
						break;
				}
				
			?>
		</div>
	</div>
</main>