<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- CSGOAced.xyz -->
<script src="<?php echo $Link->NodeServer . 'socket.io/socket.io.js' ?>"></script>
<?php
switch ($GetPage) {
	case $Page->Deposit: ?>
		<script type="text/javascript" src="<?php echo $Link->Website . 'js/cart.js'; ?>"></script>
		<?php break;

	case $Page->Home:
	default: ?>
		<script type="text/javascript" src="<?php echo $Link->Website . 'js/coinflip.js'; ?>"></script>
		<?php break;
}