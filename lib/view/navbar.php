<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" href="<?php echo $Link->Website;?>"  style="margin-left: 50px;height: 50px;padding-top: 8px;padding-bottom: 10px;">
				<img src="<?php echo $Link->Website . "img/logo.png" ;?>" alt="<?php echo $Vars->FriendlyURL;?>" width="70" height="35">
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li <?php if ($GetPage == $Page->Home){ ?> class="active" <?php } ?>>
					<a href="<?php echo $Link->Website; ?>">Coinflip</a>
				</li>
				<li <?php if ($GetPage == $Page->Deposit){ ?> class="active" <?php } ?>>
					<a href="<?php echo $Link->Website . '?p=' . $Page->Deposit; ?>">Deposit</a>
				</li>
				<li <?php if ($GetPage == $Page->Widthraw){ ?> class="active" <?php } ?>>
					<a href="<?php echo $Link->Website . '?p=' . $Page->Widthraw; ?>">Widthraw</a>
				</li> 
				<?php if(!isset($_SESSION['UID'])) { ?>
				<li>
					<a href="<?php echo $Link->Website . '?login';?>"><span class="glyphicon glyphicon-user"></span> Login / Register</a>
				</li>
				<?php }else{ ?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $steamprofile['personaname'] ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php if($_SESSION['Role'] == "Admin"){ ?>
							<li class="dropdown-header">Admin Menu</li>
							<li><a href="<?php echo $Link->Website . '?'. $Page->Admin; ?>"><span class="glyphicon glyphicon-tower"></span> Admin</a></li>
							<li><a href="<?php echo $Link->Website . '?'. $Page->RefreshPrices; ?>"><span class="glyphicon glyphicon-refresh"></span> Refresh Prices</a></li>
							<li class="dropdown-header">User Menu</li>
							<?php } ?>
							<li><a href="<?php echo $Link->Website . '?'. $Page->History; ?>"><span class="glyphicon glyphicon-list-alt"></span> History</a></li>
							<li><a href="<?php echo $Link->Website . '?'. $Page->FreeCoins; ?>"><span class="glyphicon glyphicon-gift"></span> Free Coins</a></li>
							<li><a class="tradeurl"><span class="glyphicon glyphicon-sort"></span> Trade URL</a></li>
							<li><a href="<?php echo $Link->Website . '?'. $Page->Settings; ?>"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
							<li><a href="<?php echo $Link->Website . '?'. $Page->Logout; ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						</ul>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>