jQuery(document).ready(function($){

	var User = GetUser();

	var socket = io.connect(GetServer());

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
		socket.emit('place bet', User);
	});

	socket.on('show place bet', function(){
		if (User.name != ""){
			var output = '<div class="col-xs-6 col-md-3"><div class="thumbnail"><div class="coin-flip-cont"><div class="coin"><div class="front" style="background: url(' + User.avatar + '); background-size: 100%;"></div></div></div><div class="caption"><h4>X Coins</h4><button type="button" class="btn btn-info btn-md PlaceBet">Place Bet <span class="glyphicon glyphicon-fire"></span></button></div></div></div>';
			$("#PlaceBets").html(output);
			$("#OnGoingBets").html("");
			$("#Bets").html("");
		}
	});

	socket.on('flip', function(bet){

		$(".thumbnail").each(function(index,item) {

			if ($(item).find(".JoinBet").attr("data-BetID") == bet.id){

				$(item).parent().appendTo("#OnGoingBets");

				setTimeout(function(){
					$(item).find('.coin').removeClass().addClass("coin " + getSpin(bet.winner));
					
					setTimeout(function(){
						$(item).parent().remove();
					}, 4250);
				}, 100);
			}
		});
	});

	socket.on('display bet', function(bet){
		var output = '<div class="col-xs-6 col-md-3"><div class="thumbnail"><div class="coin-flip-cont"><div class="coin"><div class="front" style="background: url(' + bet.avatar1 + '); background-size: 100%;"></div><div class="back" style="background: url(' + bet.avatar2 + '); background-size: 100%;"></div></div></div><div class="caption"><h4>' + bet.ammount + ' Coins</h4><button type="button" class="btn btn-info btn-md JoinBet" data-betid="' + bet.id + '">Join Bet <span class="glyphicon glyphicon-fire"></span></button></div></div></div>';

		$("#Bets").append(output);

		$(".caption").on("click", ".JoinBet" , function(){
			socket.emit('join bet', $(this).attr("data-BetID"));
		});
	});
});