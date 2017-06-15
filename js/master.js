jQuery(document).ready(function($){

	/*
	 _____      _               
	/  ___|    | |              
	\ `--.  ___| |_ _   _ _ __  
	 `--. \/ _ \ __| | | | '_ \ 
	/\__/ /  __/ |_| |_| | |_) |
	\____/ \___|\__|\__,_| .__/ 
						 | |    
						 |_|    
	*/

	var User = GetUser();
	$.socket = io.connect(GetServer());

	var RefClipboard = new Clipboard('.refbtn', {
		text: function(trigger) {
			txt = $("#refcode").val();
			if (txt == ""){
				txt = $("#refcode").attr('placeholder');
			}
			return "https://www.csgoaced.xyz/?r=" + txt;
		}
	});

	RefClipboard.on('success', function(e) {
		SendSuccess("Text Copied", "Successfully copied text to clipboard!");
	});

	var Wallet = 0;

	var cart = [];

	var Item = function(market_name, icon_url, assetID, classID, price){
		this.market_name = market_name;
		this.icon_url = icon_url;
		this.assetID = assetID;
		this.classID = classID;
		this.price = price;
	}
	
	InventoryList = [];

	$.socket.on('update online', function(UsersOnline){
		$("#Online").fadeOut();

		setTimeout(function(){
			$("#Online").html(UsersOnline).hide().fadeIn();
		}, 400);
	});

	$.socket.on('update coins', function(coins){
		$('#Coins')
			.prop('number', Wallet)
			.animateNumber(
			{
				number: coins
			},
			200
		);
		Wallet = coins;
	});

	$.socket.on('auth user', function(){
		$("#PlaceBets").html("");
		$("#OnGoingBets").html("");
		$("#Bets").html("");
		$.socket.emit('auth user', User);
	});

	$.socket.on('alert', function(alert){
		$.alert(alert);
	});

	function SendAlert(Title, Content){
		$.alert({
			closeIcon: true,
			closeIconClass: 'fa fa-close',
			backgroundDismiss: true,
			title: Title,
			content: Content,
			animation: 'RotateXR',
			closeAnimation: 'RotateXR',
			buttons: {
				ok: {
					btnClass: 'btn-red',
					keys: ['enter'],
					action: function(){
					}
				}
			}
		});
	}

	function SendSuccess(Title, Content){
		$.alert({
			closeIcon: true,
			closeIconClass: 'fa fa-close',
			backgroundDismiss: true,
			title: Title,
			content: Content,
			animation: 'RotateXR',
			closeAnimation: 'RotateXR',
			buttons: {
				ok: {
					btnClass: 'btn-green',
					keys: ['enter'],
					action: function(){
					}
				}
			}
		});
	}

	/*
	 _   _             _                
	| \ | |           | |               
	|  \| | __ ___   _| |__   __ _ _ __ 
	| . ` |/ _` \ \ / / '_ \ / _` | '__|
	| |\  | (_| |\ V /| |_) | (_| | |   
	\_| \_/\__,_| \_/ |_.__/ \__,_|_|   
	*/
	$('.admin').on('click', function () {
		ShowAdminPanel();
	});

	$('.tradeurl').on('click', function () {
		ShowTradeURL();
	});

	$('.freecoins').on('click', function () {
		ShowFreeCoins();
	});

	$('.history').on('click', function () {
		ShowCoinflipHistory()
	});

	$.socket.on('tradeurl', function(history){
		$.confirm({
			closeIcon: true,
			closeIconClass: 'fa fa-close',
			backgroundDismiss: true,
			title: 'Setup Your Trade URL!',
			content: 'You need to setup your trade url before trading!',
			buttons: {
				ok: {
					text: 'Ok',
					btnClass: 'btn-green',
					action: function () {
						ShowTradeURL();
					}
				}
			}
		});
	});

	$.socket.on('freecoins', function(ref_code){
		$.confirm({
			title: '',
			content: 'url:index.php?p=freecoins&c=' + ref_code + '&m=',
			columnClass: 'medium col-md-12',
			closeIcon: true,
			closeIconClass: 'fa fa-close',
			backgroundDismiss: true,
			buttons: {
				formSubmit: {
					text: 'Submit',
					btnClass: 'btn-blue',
					action: function () {
						new Clipboard('.ref_code');
						var RefCode = this.$content.find('#refcode').val();
						if(!RefCode){
							$.alert('Provide a valid Referal Code');
							return false;
						}
						if (RefCode.length > 7){
							SendAlert('Invalid Referal Code', 'Maximum Referal Code Length is 7 Characters');
							return false;
						}

						$.socket.emit('referal', RefCode);
					}
				},
				cancel: function () {
					//close
				},
			},
			onContentReady: function () {
				// bind to events
				var jc = this;
				this.$content.find('form').on('submit', function (e) {
					// if the user submits the form by pressing enter in the field.
					e.preventDefault();
					jc.$$formSubmit.trigger('click'); // reference the button and click it
				});
			}
		});
	});

	$.socket.on('coinflip history', function(history){
		var output = ""	;
		var total = 0;

		for (var bet in history){
			output += '<tr>' +
						'<td>' + history[bet].ID + '</td>' +
						'<td>' + history[bet].Ammount + '</td>' +
						'<td>' + history[bet].CreateTimestamp.replace('T', ' ').replace('.000Z', '') + '</td>' +
					'</tr>';

			total += history[bet].Ammount;
		}

		SendSuccess("Coinflip Win History",
		'<div id="CoinFlipHistory">' +
			'<table class="table table-hover table-striped table-bordered fixed_headers">' +
				'<thead>' +
					'<tr>' +
						'<th>ID</th>' +
						'<th>Ammount</th>' +
						'<th>Date</th>' +
					'</tr>' +
				'</thead>' +
				'<tbody>' +
					output +
				'</tbody>' +
			'</table>' +
		'</div>' +
		'<h4>Total: ' + total + ' Coins</h4>');
	});

	function ShowAdminPanel(){
		$.confirm({
			title: '',
			content: 'url:index.php?p=admin&m=',
			columnClass: 'medium col-md-12',
			closeIcon: true,
			closeIconClass: 'fa fa-close',
			backgroundDismiss: true,
			buttons: {
				close: {
					btnClass: 'btn-red',
					keys: ['enter'],
					action: function(){
					}
				}
			}
		});
	}

	$.RefreshPrices = function(){
		$.socket.emit('refresh prices');
	}

	function ShowTradeURL(){
		$.confirm({
			title: '',
			content: 'url:index.php?p=tradeurl&m=',
			columnClass: 'medium col-md-12',
			closeIcon: true,
			closeIconClass: 'fa fa-close',
			backgroundDismiss: true,
			buttons: {
				formSubmit: {
					text: 'Submit',
					btnClass: 'btn-blue',
					keys: ['enter'],
					action: function () {
						var TradeURL = this.$content.find('.trade_url').val();
						if(!TradeURL || TradeURL.length > 80 || !(/steamcommunity\.com\/tradeoffer\/new\/\?partner=[0-9]*&token=[a-zA-Z0-9_-]*/i.exec(TradeURL))){
							SendAlert('Invalid Trade URL', 'Provide a valid Trade URL');
							return false;
						}
						$.socket.emit('trade_url', TradeURL);
					}
				},
				cancel: function () {
					//close
				},
			}
		});
	}

	function ShowFreeCoins(){
		$.socket.emit('freecoins');
	}

	function ShowCoinflipHistory(){
		$.socket.emit('coinflip history');
	}

	/*   _____       _      ______ _ _       
		/  __ \     (_)     |  ___| (_)      
		| /  \/ ___  _ _ __ | |_  | |_ _ __  
		| |    / _ \| | '_ \|  _| | | | '_ \ 
		| \__/\ (_) | | | | | |   | | | |_) |
		 \____/\___/|_|_| |_\_|   |_|_| .__/ 
									| |    
									|_|     */

	//Coin Flip
	var player1 = ['animation1080','animation1440','animation1800','animation2160'];
	var player2 =['animation900','animation1260','animation1620','animation1980'];

	function getSpin(player) {
		if (player == 1){
			return player1[Math.floor(Math.random()*player1.length)];
		}else{
			return player2[Math.floor(Math.random()*player2.length)];
		}
	}

	$("#PlaceBets").on("click", ".PlaceBet" , function(event){

		coins = parseInt($(this).parent().find('.form-control').val());

		$(this).parent().find('.form-control').val("");

		if (isNaN(coins)){
			SendAlert("Invalid Number!", "Please enter a valid Number!");
			return false;
		}

		if (coins < 50){
			SendAlert("Not Enought Coins!", "Minimum ammount is 50 coins!");
			return false;
		}

		if (coins > 100000){
			SendAlert("Too Many Coins!", "Maximum ammount is 100000 coins!");
			return false;
		}

		$.socket.emit('place bet', coins);
	});

	$.socket.on('show place bet', function(Avatar){
		$.socket.emit('reload coins');
		var output = '<div class="col-xs-6 col-md-3"><div class="thumbnail"><div class="coin-flip-cont"><div class="coin"><div class="front" style="background: url(' + Avatar + '); background-size: 100%;"></div></div></div><div class="caption"><div class="input-group input-group-sm"><input type="text" class="form-control" placeholder="Coins" aria-describedby="basic-addon2"></div><button type="button" class="btn btn-info btn-md PlaceBet">Place Bet <span class="glyphicon glyphicon-fire"></span></button></div></div></div>';
		$("#PlaceBets").html(output);
	});

	$.socket.on('flip', function(bet){
		$(".thumbnail").each(function(index,item) {

			if ($(item).find(".JoinBet").attr("data-BetID") == bet.id){
				$(item).parent().fadeOut();

				setTimeout(function(){
					$(item).parent().remove();
				}, 400);
				return false;
			}
		});

		setTimeout(function(){

			$(GetBetHTML(bet)).appendTo('#OnGoingBets').hide().fadeIn();

			$('#OnGoingBets').find(".thumbnail").each(function(index,item) {
				if ($(item).find(".OnGoingBet").attr("data-BetID") == bet.id){
					setTimeout(function(){
						$(item).find('.coin').removeClass().addClass("coin " + getSpin(bet.winner));
						
						setTimeout(function(){
							$(item).parent().fadeOut();

							if (bet.winnerUID == User.id){
								SendSuccess("Won Bet", "<span class='glyphicon glyphicon-bullhorn'></span> Congratulations, you won the bet! <span class='glyphicon glyphicon-thumbs-up'></span>");
								var audio = new Audio('snd/win.mp3');
								audio.play();
								$.socket.emit('reload coins');
							}
							setTimeout(function(){
								$(item).parent().remove();
							}, 400);
						}, 4750);
					}, 400);

					return false;
				}
			});
		}, 400);
	});

	$.socket.on('display bet', function(bet){
		$(GetBetHTML(bet)).appendTo("#Bets").hide().fadeIn().find('.JoinBet').click(function(){
			var BetID = $(this).attr("data-BetID");
			var ConfirmMSG = "Ready? ";

			if ($(this).text() != ConfirmMSG){
				$(this).text(ConfirmMSG).append('<span class="glyphicon glyphicon-ok-sign"></span>').click(function(){
					$.socket.emit('join bet', BetID);
				});
			}
		});
	});

	function GetBetHTML(bet){
		return '<div class="col-xs-6 col-md-3"><div class="thumbnail"><div class="coin-flip-cont"><div class="coin"><div class="front" style="background: url(' + bet.avatar1 + '); background-size: 100%;"></div><div class="back" style="background: url(' + bet.avatar2 + '); background-size: 100%;"></div></div></div><div class="caption"><h4>' + bet.ammount + ' Coins</h4><button type="button" class="btn btn-info btn-md ' + ((bet.isFinished) ? 'OnGoingBet' : 'JoinBet') + '" data-betid="' + bet.id + '">' + ((bet.isFinished) ? 'Ongoing Bet' : 'Join Bet') + ' ' + ((bet.isFinished) ? '<i class="fa fa-spinner fa-pulse fa-fw"></i>' : '<span class="glyphicon glyphicon-flash">') + '</span></button></div></div></div>';
	}

	/*  ______                     _ _   
		|  _  \                   (_) |  
		| | | |___ _ __   ___  ___ _| |_ 
		| | | / _ \ '_ \ / _ \/ __| | __|
		| |/ /  __/ |_) | (_) \__ \ | |_ 
		|___/ \___| .__/ \___/|___/_|\__|
				| |                    
				|_|              */

	$.page = "";

	$.GetInventory = function(){
		$("#inventory").load("index.php?p=deposit&c=&m=", function(){

			cart = [];
			InventoryList = [];

			$('button', $('#inventory')).each(function () {
				var market_name = $(this).attr("data-name");
				var icon_url = $(this).attr("data-icon");
				var assetID = $(this).attr("data-assetID");
				var classID = $(this).attr("data-classID");
				var price = Number($(this).attr("data-price"));
				
				addToInventory(market_name, icon_url, assetID, classID, price);
			});

			displayCart();
		});
	}

	$.GetBotInventory = function(){
		$("#inventory").load("index.php?p=withraw&c=&m=", function(){

			cart = [];
			InventoryList = [];

			$('button', $('#inventory')).each(function () {
				var market_name = $(this).attr("data-name");
				var icon_url = $(this).attr("data-icon");
				var assetID = $(this).attr("data-assetID");
				var classID = $(this).attr("data-classID");
				var price = Number($(this).attr("data-price"));
				
				addToInventory(market_name, icon_url, assetID, classID, price);
			});

			displayCart();
		});
	}

	function addToInventory(market_name, icon_url, assetID, classID, price){
		var item = new Item(market_name, icon_url, assetID, classID, price)
		
		InventoryList.push(item);
	}

	function removeFromInventory(assetID, classID){
		for (var i in InventoryList){
			if(InventoryList[i].assetID === assetID && InventoryList[i].classID === classID){
				InventoryList.splice(i, 1);
				break;
			}
		}
	}

	// Cart 
	$("#inventory").on("click", ".addCart" , function(event){
		event.preventDefault();

		var market_name = $(this).attr("data-name");
		var icon_url = $(this).attr("data-icon");
		var assetID = $(this).attr("data-assetID");
		var classID = $(this).attr("data-classID");
		var price = Number($(this).attr("data-price"));

		removeFromInventory(assetID, classID);
		addToCart(market_name, icon_url, assetID, classID, price);
	});

	$("#depositBox").on("click", ".checkout" , function(event){
		event.preventDefault();

		if (cart.length == 0){
			SendAlert('No selected items', 'Add items to your cart!');
			return false;
		}

		$.socket.emit('deposit', cart);

		cart = [];
		displayCart();
	});

	$("#depositBox").on("click", ".withraw" , function(event){
		event.preventDefault();

		if (cart.length == 0){
			SendAlert('No selected items', 'Add items to your cart!');
			return false;
		}

		$.socket.emit('withraw', cart);

		cart = [];
		displayCart();
	});

	$("#depositBox").on("click", ".clearCart" , function(event){
		event.preventDefault();

		clearCart();
	});

	$("#showCart").on("click", ".removeCart" , function(event){
		event.preventDefault();

		var market_name = $(this).attr("data-name");
		var icon_url = $(this).attr("data-icon");
		var assetID = $(this).attr("data-assetID");
		var classID = $(this).attr("data-classID");
		var price = Number($(this).attr("data-price"));

		addToInventory(market_name, icon_url, assetID, classID, price);
		removeFromCart(assetID, classID);
	});

	$(".update-inventory").on("click", function(event){
		$.ajax({
			url: "index.php?updateinventory=&c=&m="
		}).done(function() {
			$.GetInventory();
			SendSuccess("Inventory", "Your inventory was successfully updated!");
		});
	});

	$(".update-bot-inventory").on("click", function(event){
		$.ajax({
			url: "index.php?updateinventory=&c=&m=&bot="
		}).done(function() {
			$.GetBotInventory();
			SendSuccess("Inventory", "Bot inventory successfully updated!");
		});
	});

	function displayCart(){
		var output = "";

		for (var i in cart){
			output += '<div class="col-xs-6 col-md-6"><div class="thumbnail"><img src="' + cart[i].icon_url + '" alt="' + cart[i].market_name + '"><h5>' + cart[i].price + '</h5> <div class="caption"> <p>' + cart[i].market_name + '</p>	<button type="button" class="btn btn-info btn-md removeCart" data-name="' + cart[i].market_name + '" data-icon="'+cart[i].icon_url+'" data-price="'+cart[i].price+'" data-assetID="' + cart[i].assetID + '" data-classID="' + cart[i].classID + '">Remove <span class="glyphicon glyphicon-remove"></span></button></div></div></div>';
		}

		$("#showCart").html(output);
		$("#showCoins").html(getCoins());
		
		var output = "";

		for (var i in InventoryList){
			output += '<div class="col-xs-6 col-md-3"><div class="thumbnail"><img src="' + InventoryList[i].icon_url + '" alt="' + InventoryList[i].market_name + '"><h5>' + InventoryList[i].price + '</h5> <div class="caption"> <p>' + InventoryList[i].market_name + '</p>	<button type="button" class="btn btn-info btn-md addCart" data-name="' + InventoryList[i].market_name + '" data-icon="'+InventoryList[i].icon_url+'" data-price="'+InventoryList[i].price+'" data-assetID="' + InventoryList[i].assetID + '" data-classID="' + InventoryList[i].classID + '">' + (($.page == "deposit") ? ("Deposit"): ("Withraw")) + ' <span class="glyphicon glyphicon-shopping-cart"></span></button></div></div></div>';
		}
		
		$("#inventory").html(output);
	}

	// Cart Functions

	//Add Item
	function addToCart(market_name, icon_url, assetID, classID, price){

		for (var i in cart){
			if(cart[i].assetID == assetID && cart[i].classID == classID){
				return;
			}
		}

		var item = new Item(market_name, icon_url, assetID, classID, price);
		cart.push(item);
		
		displayCart();
	}

	//Remove Item
	function removeFromCart(assetID, classID){
		for (var i in cart){
			if(cart[i].assetID === assetID && cart[i].classID === classID){
				cart.splice(i, 1);
				break;
			}
		}
		displayCart();
	}

	//Clear Cart
	function clearCart(){
		for (var i in cart){
			addToInventory(cart[i].market_name, cart[i].icon_url, cart[i].assetID, cart[i].classID, cart[i].price);
		}
		
		cart = [];
		
		displayCart();
	}

	//Get Coins
	function getCoins(){
		var coins = 0;
		
		for (var i in cart){
			coins += cart[i].price;
		}
		
		return coins;
	}

	/*   _____ _           _   
		/  __ \ |         | |  
		| /  \/ |__   __ _| |_ 
		| |   | '_ \ / _` | __|
		| \__/\ | | | (_| | |_ 
		\____/_| |_|\__,_|\__|  */

	(function () {
		var Message;
		Message = function (arg) {
			this.text = arg.text, this.message_side = arg.message_side;
			this.draw = function (_this) {
				return function (avatar) {
					var $message;
					$message = $($('.message_template').clone().html());
					$message.addClass(_this.message_side).find('.text').html(_this.text);

					$message.find('.avatar').css({'background': 'url(' + avatar + ')', 'background-size': '100%'});

					$('.messages').append($message);
					return setTimeout(function () {
						return $message.addClass('appeared');
					}, 0);
				};
			}(this);
			return this;
		};
		$(function () {
			var getMessageText, message_side, sendMessage;
			message_side = 'right';

			getMessageText = function () {
				var $message_input;
				$message_input = $('.message_input');
				return $message_input.val();
			};

			$.socket.on('message', function(msg){
				$messages = $('.messages');
				message_side = message_side === 'left' ? 'right' : 'left';

				msg.text = msg.text.replace(new RegExp(":aced:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/aced.png">')
				msg.text = msg.text.replace(new RegExp(":kappa:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/kappa.png">')
				msg.text = msg.text.replace(new RegExp(":rip:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/rip.png">');
				msg.text = msg.text.replace(new RegExp(":ezskins:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/ezskins.png">');
				msg.text = msg.text.replace(new RegExp(":hype:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/hype.png">');
				msg.text = msg.text.replace(new RegExp(":money:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/money.png">');
				msg.text = msg.text.replace(new RegExp(":snipe:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/snipe.png">');
				msg.text = msg.text.replace(new RegExp(":gg:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/gg.png">');
				msg.text = msg.text.replace(new RegExp(":gaben:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/gaben.png">');
				msg.text = msg.text.replace(new RegExp(":pigeon:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/pigeon.png">');
				msg.text = msg.text.replace(new RegExp(":trump:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/trump.png">');
				msg.text = msg.text.replace(new RegExp(":wall:", 'g'), '<img src="https://www.csgoaced.xyz/img/emotes/wall.png">');

				message = new Message({
					text: msg.text,
					message_side: message_side
				});
				message.draw(msg.avatar);
				return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
			});

			function sendMessage(text){
				var $messages, message;
				if (text.trim() === '') { return false; }

				if (text.length > 50){
					SendAlert("Message Lenght", "You can only write 50 characters");
					return false;
				}

				$('.message_input').val('');

				$.socket.emit('message', text);
			}

			$('.send_message').click(function (e) {
				return sendMessage(getMessageText());
			});

			$('.message_input').keyup(function (e) {
				if (e.which === 13) {
					return sendMessage(getMessageText());
				}
			});
		});
	}.call(this));
});