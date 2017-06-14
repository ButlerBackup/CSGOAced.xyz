<div class="col-sm-4">
	<div id="Wallet" class="col-xs-12 col-md-12 thumbnail">
		<h3><span id="Coins">0</span> Coins</h3>
		<div class="caption">
			<button class="btn btn-success btn-md"><span class="glyphicon glyphicon-share-alt"></span> Deposit</button>
			<button class="btn btn-primary btn-md">Widthraw <span class="glyphicon glyphicon-shopping-cart"></span></button>
		</div>
	</div>
	<div class="chat_window">
		<div class="top_menu">
			<div class="buttons">
				<div class="button maximize">
					<h4 id="Online"></h4>
				</div>
			</div>
			<div class="title"><?php echo $Vars->FriendlyURL; ?></div>
		</div>
		<ul class="messages"></ul>
		<div class="bottom_wrapper clearfix">
			<div class="message_input_wrapper"><input class="message_input" placeholder="Type your message!" /></div>
			<div class="send_message">
				<div class="icon"></div>
				<div class="text">Send  <span class="glyphicon glyphicon-send"></div>
			</div>
		</div>
	</div>
	<div class="message_template">
		<li class="message">
			<div class="avatar"></div>
			<div class="text_wrapper">
				<div class="text"></div>
			</div>
		</li>
	</div>
</div>
<div class="col-sm-8">
	<div id="PlaceBets">
		
	</div>
	<div id="OnGoingBets">
		
	</div>
	<div id="Bets">
		
	</div>
</div>