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
						<li <?php if ($GetPage == $Page->Home){ ?> class="active" <?php } ?>>
							<a href="?p=<?php echo $Page->Home; ?>">Coinflip</a>
						</li>
						<li <?php if ($GetPage == $Page->Deposit){ ?> class="active" <?php } ?>>
							<a href="?p=<?php echo $Page->Deposit; ?>">Deposit</a>
						</li>
						<li <?php if ($GetPage == $Page->Widthraw){ ?> class="active" <?php } ?>>
							<a href="?p=<?php echo $Page->Widthraw; ?>">Widthraw</a>
						</li> 
						<?php if(!isset($_SESSION['UID'])) { ?>
						<li>
							<a href="?login"><span class="glyphicon glyphicon-user"></span> Login / Register</a>
						</li>
						<?php }else{ ?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $steamprofile['personaname'] ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php if($_SESSION['Role'] == "Admin"){ ?>
									<li><a href="?<?php echo $Page->Admin; ?>"><span class="glyphicon glyphicon-tower"></span> Admin</a></li>
									<?php } ?>
									<li><a href="?<?php echo $Page->History; ?>"><span class="glyphicon glyphicon-list-alt"></span> History</a></li>
									<li><a href="?<?php echo $Page->FreeCoins; ?>"><span class="glyphicon glyphicon-gift"></span> Free Coins</a></li>
									<li><a href="?<?php echo $Page->TradeURL; ?>"><span class="glyphicon glyphicon-sort"></span> Trade URL</a></li>
									<li><a href="?<?php echo $Page->Settings; ?>"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
									<li><a href="?<?php echo $Page->Logout; ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
								</ul>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>