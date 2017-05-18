<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, minimum-scale=1">

			<meta property="og:title" content="CSGO Aced" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="https://www.csgoaced.xyz/" />
			<meta property="og:image" content="https://www.csgoaced.xyz/img/logo.png" />
			<meta property="og:description" content="From Champions to Champions. Join us and start winning skins!" />

			<meta name="description" content="From Champions to Champions. Join us and start winning skins!">
			<meta name="keywords" content="CSGO, cs, counter, strike, skins, dragonlore, karambit, aced, ace, bet, beting, gamble, gambling">
			<meta name="author" content="Tiago Severino">

			<title>CSGO Aced</title>

			<!-- Icon -->
			<link rel="shortcut icon" type="image/png" href="img/icon.png"/>
			<link rel="shortcut icon" type="image/png" href="img/icon.png"/>

			<!-- Font Ubuntu Mono -->
			<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">

			<!-- Include Font Awesome Stylesheet in Header -->
			<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

			<!-- Stylesheets -->
			<link rel="stylesheet" href="reset.css">

			<!-- Bootstrap -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand" href="https://www.csgoaced.xyz/"  style="margin-left: 50px;height: 50px;padding-top: 8px;padding-bottom: 10px;">
						<img src="img/logo.png" alt="CSGO Aced" width="70" height="35">
					</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li class="active">
							<a href="#">Coinflip</a>
						</li>
						<li>
							<a href="#">Deposit</a>
						</li>
						<li>
							<a href="#">Widthraw</a>
						</li> 
						<li>
							<a href="#"><span class="glyphicon glyphicon-user"></span> Login / Register</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>


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
						
					</div>

					<div class="col-sm-4">
						<div id="depositBox" class="col-xs-12 col-md-12 thumbnail deposit">
							<h3 id="showCoins">0 Coins</h3>
							<div class="caption">
								<button class="btn btn-success btn-md"><span class="glyphicon glyphicon-share-alt"></span> Deposit</button>
								<button class="btn btn-danger btn-md">Clear <span class="glyphicon glyphicon-trash"></span></button>
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
		
		<footer class="footer">
			<div class="container">
				<p class="text-muted"><span class="glyphicon glyphicon-copyright-mark"></span> <a href="https://www.csgoaced.xyz/">CSGOAced.xyz</a> All Rights Reserved. 
				<a href="https://www.facebook.com/csgoaced"><i class="fa fa-facebook-square fa-2x text-muted" aria-hidden="true" ></i></a>
				<a href="https://twitter.com/CSGOAcedXyz"><i class="fa fa-twitter-square fa-2x text-muted"></i></a>
				<a href="https://steamcommunity.com/groups/CSGOAced_xyz"><i class="fa fa-steam fa-2x text-muted"></i></a>
				<a href="https://www.instagram.com/csgoaced.xyz/"><i class="fa fa-instagram fa-2x text-muted"></i></a>
				<a href="mailto:admin@csgoaced.xyz"><i class="fa fa-envelope-square fa-2x text-muted"></i></a>
				</p>
			</div>
		</footer>
		
		<!-- JQuery -->
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>