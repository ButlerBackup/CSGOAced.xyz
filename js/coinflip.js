jQuery(document).ready(function($){

	var spinArray = ['animation900','animation1080','animation1260','animation1440','animation1620','animation1800','animation1980','animation2160'];

	function GetSpin() {
		var spin = spinArray[Math.floor(Math.random()*spinArray.length)];
		return spin;
	}

	//Coin Flip
	$('#coin').on('click', function(){
		$('#coin').removeClass();

		setTimeout(function(){
			$('#coin').addClass(GetSpin());
		}, 100);
	});
});