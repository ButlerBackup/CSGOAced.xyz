<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- CSGOAced.xyz -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>
<?php
switch ($GetPage) {
	case $Page->Deposit: ?>
		<script type="text/javascript" src="<?php echo $Link->Website . 'js/cart.js'; ?>"></script>
		<?php break;

	case $Page->Home:
	default: ?>
		<script type="text/javascript"> 
			var User = function(name, avatar){
				this.name = name;
				this.avatar = avatar;
			}

			function GetUser(){
				return (new User("<?php echo (isset($steamprofile) ? $steamprofile['personaname'] : ""); ?>", "<?php echo (isset($steamprofile) ? $steamprofile['avatarfull'] : ""); ?>"));
			}

			function GetServer(){ 
				return "<?php echo $Link->NodePath; ?>"; 
			} 
		</script>
		<script type="text/javascript" src="<?php echo $Link->Website . 'js/coinflip.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo $Link->Website . 'js/chat.js'; ?>"></script>
		<?php break;
}
