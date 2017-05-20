jQuery(document).ready(function($){

	var socket = io.connect(GetServer());	

	socket.on('FlipCoin', function(BetID, Winner){

		$(".thumbnail").each(function(index,item) {

			if ($(item).find(".JoinBet").attr("data-BetID") == BetID){
				$(item).find('.coin').removeClass().addClass("coin " + Winner);
			}
		});
	});

	socket.on('DisplayBets', function(bets){
		var output = "";

		for (var i in bets){
			output += '<div class="col-xs-6 col-md-3"><div class="thumbnail"><div class="coin-flip-cont"><div class="coin"><div class="front" style="background: url(' + bets[i].avatar1 + '); background-size: 100%;"></div><div class="back" style="background: url(' + bets[i].avatar2 + '); background-size: 100%;"></div></div></div><div class="caption"><h4>' + bets[i].ammount + ' Coins</h4><button type="button" class="btn btn-info btn-md JoinBet" data-betid="' + bets[i].id + '">Join Bet <span class="glyphicon glyphicon-fire"></span></button></div></div></div>';
		}

		$("#bets").html(output);

		$(".caption").on("click", ".JoinBet" , function(){
			socket.emit('PlaceBet', $(this).attr("data-BetID"));
		});
	});
});