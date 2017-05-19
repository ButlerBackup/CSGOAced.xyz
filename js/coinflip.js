jQuery(document).ready(function($){

	//var spinArray = ['animation900','animation1080','animation1260','animation1440','animation1620','animation1800','animation1980','animation2160'];

	var player1 = ['animation1080','animation1440','animation1800','animation2160'];
    var player2 =['animation900','animation1260','animation1620','animation1980'];

	function getSpin(player) {
        
        if (player == 1){
            return player1[Math.floor(Math.random()*player1.length)];
        }else{
            return player2[Math.floor(Math.random()*player2.length)];
        }
	}
    
    
    $("#bets").on("click", ".coin" , function(){
        $(this).removeClass().addClass("coin " + getSpin(Math.floor(Math.random() * 2) + 1));
	});
});