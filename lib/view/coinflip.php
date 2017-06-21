<div class="col-sm-4">
	<?php if(isset($_SESSION['UID'])) { ?>
		<div id="Wallet" class="col-xs-12 col-md-12 thumbnail">
			<h3><span id="Coins">0</span> Coins</h3>
		</div>
	<?php } ?>
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
				<div class="text">Send  <span class="glyphicon glyphicon-send"></span></div>
			</div>
			<div class="send_emoji">
				<div class="text"><i class="fa fa-smile-o fa-lg" aria-hidden="true"></i></div>
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