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
	var socket = io.connect(GetServer());

	var cart = [];

	var Item = function(market_name, icon_url, assetID, classID, price){
		this.market_name = market_name;
		this.icon_url = icon_url;
		this.assetID = assetID;
		this.classID = classID;
		this.price = price;
	}
	
	InventoryList = [];

	socket.on('update online', function(UsersOnline){
		$("#Online").fadeOut();

		setTimeout(function(){
			$("#Online").html(UsersOnline).hide().fadeIn();
		}, 400);
	});

	socket.on('auth user', function(){
		$("#PlaceBets").html("");
		$("#OnGoingBets").html("");
		$("#Bets").html("");
		socket.emit('auth user', User);
	});


	/*
	 _   _             _                
	| \ | |           | |               
	|  \| | __ ___   _| |__   __ _ _ __ 
	| . ` |/ _` \ \ / / '_ \ / _` | '__|
	| |\  | (_| |\ V /| |_) | (_| | |   
	\_| \_/\__,_| \_/ |_.__/ \__,_|_|   
	*/

	$('.tradeurl').on('click', function () {
		$.confirm({
			closeIcon: true,
			closeIconClass: 'fa fa-close',
			title: 'Trade URL!',
			content: '' +
			'<form action="" class="formName">' +
			'<div class="form-group">' +
			'<label>Enter Your <a href="http://steamcommunity.com/profiles/76561198391711336/tradeoffers/privacy#trade_offer_access_url" target="_blank">Trade URL</a></label>' +
			'<input type="text" placeholder="Your Trade URl" class="trade_url form-control" required />' +
			'</div>' +
			'</form>',
			buttons: {
				formSubmit: {
					text: 'Submit',
					btnClass: 'btn-blue',
					action: function () {
						var TradeURL = this.$content.find('.trade_url').val();
						if(!TradeURL){
							$.alert('Provide a valid Trade URL');
							return false;
						}
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
			alert("Please enter a valid Number");
			return false;
		}

		socket.emit('place bet', coins);
	});

	socket.on('show place bet', function(){
		var output = '<div class="col-xs-6 col-md-3"><div class="thumbnail"><div class="coin-flip-cont"><div class="coin"><div class="front" style="background: url(' + User.avatar + '); background-size: 100%;"></div></div></div><div class="caption"><div class="input-group input-group-sm"><input type="text" class="form-control" placeholder="Coins" aria-describedby="basic-addon2"></div><button type="button" class="btn btn-info btn-md PlaceBet">Place Bet <span class="glyphicon glyphicon-fire"></span></button></div></div></div>';
		$("#PlaceBets").html(output);
	});

	socket.on('flip', function(bet){

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

	socket.on('display bet', function(bet){
		
		$(GetBetHTML(bet)).appendTo("#Bets").hide().fadeIn();

		$(".caption").on("click", ".JoinBet" , function(){
			socket.emit('join bet', $(this).attr("data-BetID"));
		});
	});

	function GetBetHTML(bet){
		return '<div class="col-xs-6 col-md-3"><div class="thumbnail"><div class="coin-flip-cont"><div class="coin"><div class="front" style="background: url(' + bet.avatar1 + '); background-size: 100%;"></div><div class="back" style="background: url(' + bet.avatar2 + '); background-size: 100%;"></div></div></div><div class="caption"><h4>' + bet.ammount + ' Coins</h4><button type="button" class="btn btn-info btn-md ' + ((bet.isFinished) ? 'OnGoingBet' : 'JoinBet') + '" data-betid="' + bet.id + '">' + ((bet.isFinished) ? 'Ongoing Bet' : 'Join Bet') + ' <span class="glyphicon glyphicon-fire"></span></button></div></div></div>';
	}

	/*  ______                     _ _   
		|  _  \                   (_) |  
		| | | |___ _ __   ___  ___ _| |_ 
		| | | / _ \ '_ \ / _ \/ __| | __|
		| |/ /  __/ |_) | (_) \__ \ | |_ 
		|___/ \___| .__/ \___/|___/_|\__|
				| |                    
				|_|              */

	//Inventory
	$('button', $('#inventory')).each(function () {
		var market_name = $(this).attr("data-name");
		var icon_url = $(this).attr("data-icon");
		var assetID = $(this).attr("data-assetID");
		var classID = $(this).attr("data-classID");
		var price = Number($(this).attr("data-price"));
		
		addToInventory(market_name, icon_url, assetID, classID, price);
	});
	
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

		alert("Website not launched yet!");
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

	function displayCart(){
		var output = "";

		for (var i in cart){
			output += '<div class="col-xs-6 col-md-6"><div class="thumbnail"><img src="' + cart[i].icon_url + '" alt="' + cart[i].market_name + '"><h5>' + cart[i].price + '</h5> <div class="caption"> <p>' + cart[i].market_name + '</p>	<button type="button" class="btn btn-info btn-md removeCart" data-name="' + cart[i].market_name + '" data-icon="'+cart[i].icon_url+'" data-price="'+cart[i].price+'" data-assetID="' + cart[i].assetID + '" data-classID="' + cart[i].classID + '">Remove <span class="glyphicon glyphicon-remove"></span></button></div></div></div>';
		}

		$("#showCart").html(output);
		$("#showCoins").html(getCoins() + " Coins");
		
		var output = "";

		for (var i in InventoryList){
			output += '<div class="col-xs-6 col-md-3"><div class="thumbnail"><img src="' + InventoryList[i].icon_url + '" alt="' + InventoryList[i].market_name + '"><h5>' + InventoryList[i].price + '</h5> <div class="caption"> <p>' + InventoryList[i].market_name + '</p>	<button type="button" class="btn btn-info btn-md addCart" data-name="' + InventoryList[i].market_name + '" data-icon="'+InventoryList[i].icon_url+'" data-price="'+InventoryList[i].price+'" data-assetID="' + InventoryList[i].assetID + '" data-classID="' + InventoryList[i].classID + '">Add to Cart <span class="glyphicon glyphicon-shopping-cart"></span></button></div></div></div>';
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

	function getTextFromURL(url){
		var request = new XMLHttpRequest();
		request.open('GET', url, true);
		request.send(null);

		request.onreadystatechange = function () {
			if (request.readyState === 4 && request.status === 200) {
				var type = request.getResponseHeader('Content-Type');
				if (type.indexOf("text") !== 1) {
					return request.responseText;
				}
			}
		}
		return "";
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

			socket.on('message', function(msg){
				$messages = $('.messages');
				message_side = message_side === 'left' ? 'right' : 'left';
				message = new Message({
					text: msg.text,
					message_side: message_side
				});
				message.draw(msg.avatar);
				return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
			});

			function sendMessage(text){
				var $messages, message;
				if (text.trim() === '') {
					return;
				}
				$('.message_input').val('');

				socket.emit('message', text);
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