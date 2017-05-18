jQuery(document).ready(function($){
	//Setup
	var cart = [];

	var Item = function(market_name, icon_url, assetID, classID, price){
		this.market_name = market_name;
		this.icon_url = icon_url;
		this.assetID = assetID;
		this.classID = classID;
		this.price = price;
	}
	
	InventoryList = [];

	
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
});