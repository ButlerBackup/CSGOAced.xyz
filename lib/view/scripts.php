<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- CSGOAced.xyz -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>

<script type="text/javascript"> 
	var User = function(id, name, avatar, PrivateKey){
		this.id = id;
		this.name = name;
		this.avatar = avatar;
		this.PrivateKey = PrivateKey;
	}

	function GetUser(){
		return (new User("<?php echo (isset($_SESSION['UID']) ? $_SESSION['UID'] : ""); ?>",
						"<?php echo (isset($steamprofile) ? $steamprofile['personaname'] : ""); ?>",
						"<?php echo (isset($steamprofile) ? $steamprofile['avatarfull'] : ""); ?>",
						"<?php echo (isset($_SESSION['PrivateKey']) ? $_SESSION['PrivateKey'] : ""); ?>"));
	}

	function GetServer(){ 
		return "<?php echo $Link->NodePath; ?>"; 
	} 
</script>

<!-- Socket.io -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>

<!-- CSGOAced.xyz -->
<script type="text/javascript" src="<?php echo $Link->Website . 'js/master.js'; ?>"></script>