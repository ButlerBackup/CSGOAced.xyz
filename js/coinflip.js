jQuery(document).ready(function($){

	NodeServer = "localhost:3000"; //Your Node.JS Server Domain:Port

	var socket = io.connect(NodeServer);
	
	$(".caption").on("click", ".JoinBet" , function(){
		socket.emit('PlaceBet', $(this).attr("data-BetID"));
	});

	socket.on('FlipCoin', function(BetID, Winner){

		$(".thumbnail").each(function(index,item) {

			if ($(item).find(".JoinBet").attr("data-BetID") == BetID){
				$(item).find('.coin').removeClass().addClass("coin " + Winner);
			}
		});
	});

	var bets = [];

	var bet = function(id, name, avatar1, avatar2, ammount){
		this.id = id;
		this.name = name;
		this.avatar1 = avatar1;
		this.avatar2 = avatar2;
		this.ammount = ammount;
	}
});