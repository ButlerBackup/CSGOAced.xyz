<?php
$sth = $conn->prepare("SELECT Count(*) AS IsRefered FROM ReferedUsersHistory WHERE ReferedUsersHistory.UserID = :UID;");
$sth->execute(array(':UID' => $_SESSION['UID']));
$UsedCode = $sth->fetchAll();

if ($UsedCode[0]['IsRefered'] > 0 || !(isset($_GET['referal'])) || strlen($_GET['referal']) < 0 || strlen($_GET['referal']) > 7){
	echo "<h2>You've already used your referal code!</h2>";
	return;
}

$sth = $conn->prepare("SELECT ID FROM LoginHistory WHERE IP = :IP AND UserID != :UID;");
$sth->execute(array(':IP' => $_SERVER['REMOTE_ADDR'], ':UID' => $_SESSION['UID']));
$SameIP = $sth->fetchAll();

if ($SameIP == NULL){
	$sth = $conn->prepare("SELECT ID FROM Users where RefCode = :ReferalCode AND ID != :UID");
	$sth->execute(array(':ReferalCode' => $_GET['referal'], ':UID', $_SESSION['UID']));
	$ReferalID = $sth->fetchAll();

	if ($ReferalID != NULL){
		$sth = $conn->prepare("INSERT INTO ReferedUsersHistory (UserID, ReferalID, ReferalCode) VALUES (:UID, :ReferalID, :ReferalCode);");
		$sth->bindParam(':UID', $_SESSION['UID']);
		$sth->bindParam(':ReferalID', $ReferalID[0]['ID']);
		$sth->bindParam(':ReferalCode', $_GET['referal']);
		$sth->execute();

		$sth = $conn->prepare("UPDATE Users SET Coins = (SELECT (Select Coins) + :Coins) WHERE ID = :ID;");
		$sth->bindParam(':Coins', $Vars->CoinsToReferer);
		$sth->bindParam(':ID', $ReferalID[0]['ID']);
		$sth->execute();

		$sth = $conn->prepare("UPDATE Users SET Coins = (SELECT (Select Coins) + :Coins) WHERE ID = :ID;");
		$sth->bindParam(':Coins', $Vars->CoinsToRefered);
		$sth->bindParam(':ID', $_SESSION['UID']);
		$sth->execute();

		?>
		<h2>You Have Sucessfully Rendered the Referal Code!</h2>
		<?php
		die();
	}
	?>
	<h2>Invalid Referal Code!</h2>
	<?php
	die();
}
?>
<h2>Can't use referal code under same IP Adress!</h2>