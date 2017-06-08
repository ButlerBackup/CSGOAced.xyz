<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Socket.io -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>

<!-- JQuery Confirm -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.js"></script>

<!-- Clipboard.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.1/clipboard.min.js"></script>

<script type="text/javascript"> 
	var User = function(id, PrivateKey){
		this.id = id;
		this.PrivateKey = PrivateKey;
	}

	function GetUser(){
		return (new User("<?php echo (isset($_SESSION['UID']) ? $_SESSION['UID'] : ""); ?>",
						"<?php echo (isset($_SESSION['PrivateKey']) ? $_SESSION['PrivateKey'] : ""); ?>"));
	}

	function GetServer(){ 
		return "<?php echo $Link->NodePath; ?>"; 
	} 
</script>

<!-- CSGOAced.xyz -->
<script type="text/javascript" src="<?php echo $Link->Website . 'js/master.js'; ?>"></script>