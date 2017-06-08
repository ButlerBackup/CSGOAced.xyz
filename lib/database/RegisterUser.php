<?php

$NewUser = false;

if(!isset($_SESSION['UID'])){
	$sth = $conn->prepare("SELECT ID, Role FROM Users where Steam64 = :Steam64");
	$sth->execute(array(':Steam64' => $steamprofile['steamid']));
	$User = $sth->fetchAll();

	if ($User == NULL){
		$sth = $conn->prepare("INSERT INTO Users (Steam64, Name, Avatar) VALUES (:Steam64, :Name, :Avatar);");
		$sth->bindParam(':Steam64', $steamprofile['steamid']);
		$sth->bindParam(':Name', $steamprofile['personaname']);
		$sth->bindParam(':Avatar', $steamprofile['avatarfull']);
		$sth->execute();

		$sth = $conn->prepare("SELECT ID, Role FROM Users where steam64 = :steam64");
		$sth->execute(array(':steam64' => $steamprofile['steamid']));
		$User = $sth->fetchAll();

		$NewUser = true;
	}else{
		$sth = $conn->prepare("UPDATE Users SET Name = :Name, Avatar = :Avatar WHERE Steam64 = :Steam64;");
		$sth->bindParam(':Avatar', $steamprofile['avatarfull']);
		$sth->bindParam(':Name', $steamprofile['personaname']);
		$sth->bindParam(':Steam64', $steamprofile['steamid']);
		$sth->execute();
	}

	$_SESSION['UID'] = $User[0][0];
    $_SESSION['Role'] = $User[0][1];

	
	if ($NewUser == true && isset($_SESSION['referal'])){
		$sth = $conn->prepare("SELECT ID FROM Users where RefCode = :ReferalCode");
		$sth->execute(array(':ReferalCode' => $_SESSION['referal']));
		$ReferalID = $sth->fetchAll();

		if ($ReferalID != NULL){
			echo $_SESSION['UID'] . $ReferalID[0]['ID'] . $_SESSION['referal'];
			$sth = $conn->prepare("INSERT INTO ReferedUsersHistory (UserID, ReferalID, ReferalCode) VALUES (:UID, :ReferalID, :ReferalCode);");
			$sth->bindParam(':UID', $_SESSION['UID']);
			$sth->bindParam(':ReferalID', $ReferalID[0]['ID']);
			$sth->bindParam(':ReferalCode', $_SESSION['referal']);
			$sth->execute();
		}
	}

	$sth = $conn->prepare("INSERT INTO LoginHistory (UserID, IP) VALUES (:UID, :IP);");
	$sth->bindParam(':UID', $_SESSION['UID']);
	$sth->bindParam(':IP', $_SERVER['REMOTE_ADDR']);
	$sth->execute();

	$Hash = (rand(0,1) == 1) ? 'sha512' : 'whirlpool';
	$_SESSION['PrivateKey'] = hash($Hash, rand() . $steamprofile['steamid'] . rand() . $steamprofile['communityvisibilitystate'] . rand() . $steamprofile['personaname'] . rand() . $steamprofile['profileurl'] . rand() . $steamprofile['avatarfull'] . rand());

	$sth = $conn->prepare("UPDATE Users SET PrivateKey = :PrivateKey WHERE ID = :UID");
	$sth->bindParam(':UID', $_SESSION['UID']);
	$sth->bindParam(':PrivateKey', $_SESSION['PrivateKey']);
	$sth->execute();
}