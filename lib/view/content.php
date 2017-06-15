<main>
	<div class="jumbotron text-center">
		<h1>CSGO Aced</h1>
		<p><span class="glyphicon glyphicon-star"></span> <?php echo $Vars->Description; ?></p>
	</div>

	<div class="container">
		<div class="row">
			<div class="alert alert-warning fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-time"></span> Officially Released on: <strong>1st July 2017</strong>
			</div>
			<div class="alert alert-warning fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-bullhorn"></span> Wanna be a <strong>beta tester</strong>? Contact us via our <a href="https://discord.gg/uzjBqxX"><strong>Discord Server</strong></a>! <span class="glyphicon glyphicon-thumbs-up"></span>
			</div>
		</div>
		<div class="row">
			<?php
			if (!isset($_SESSION['UID'])){
				require ('lib/view/coinflip.php');
			}else{
				switch ($GetPage) {
					case $Page->Deposit:
						require ('lib/view/deposit.php');
						break;
					case $Page->Withraw:
						require ('lib/view/withraw.php');
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