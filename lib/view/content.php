<main>
	<div class="jumbotron text-center">
		<h1>CSGO Aced</h1>
		<p><span class="glyphicon glyphicon-star"></span> <?php echo $Vars->Description; ?></p>
	</div>

	<div class="container">
		<div class="row">
			<div class="alert alert-info fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-time"></span> Officially Released in: <strong id="countdown"></strong>
			</div>
			<script>
				var countDownDate = new Date("Jun 24, 2017 12:00:00").getTime();

				var x = setInterval(function() {
					var now = new Date().getTime();

					var distance = countDownDate - now;

					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);

					document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

					if (distance < 0) {
						clearInterval(x);
						document.getElementById("countdown").parentElement.classList.remove('alert-info');
						document.getElementById("countdown").parentElement.classList.add('alert-success');
						document.getElementById("countdown").innerHTML = "Released!";
					}
				}, 1000);
			</script>
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