<main>
	<div class="jumbotron text-center">
		<h1>CSGO Aced</h1>
		<p><span class="glyphicon glyphicon-star"></span> <?php echo $Vars->Description; ?></p>
	</div>

	<div class="container">
		<div class="row">
			<?php
			if (!isset($_SESSION['UID'])){
				require ('lib/view/coinflip.php');
			}else{
				switch ($GetPage) {
					case $Page->Deposit:
						require ('lib/view/deposit.php');
						break;
					case $Page->Withdraw:
						require ('lib/view/withdraw.php');
						break;
					case $Page->Home:
					default:
						require ('lib/view/coinflip.php');
						break;
				}
			}
			?>
		</div>
	</div>
</main>