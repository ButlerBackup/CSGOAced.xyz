<?php

$NewUser = false;

if(!isset($_SESSION['UID'])){
	$sth = $conn->prepare("SELECT ID, Role FROM Users where Steam64 = :Steam64");
	$sth->execute(array(':Steam64' => $steamprofile['steamid']));
	$User = $sth->fetchAll();

	if ($User == NULL){
		$sth = $conn->prepare("INSERT INTO Users (Steam64) VALUES (:Steam64);");
		$sth->bindParam(':Steam64', $steamprofile['steamid']);
		$sth->execute();

		$sth = $conn->prepare("SELECT ID, Role FROM Users where steam64 = :steam64");
		$sth->execute(array(':steam64' => $steamprofile['steamid']));
		$User = $sth->fetchAll();

		$NewUser = true;
	}

	$_SESSION['UID'] = $User[0][0];
    $_SESSION['Role'] = $User[0][1];

	$sth = $conn->prepare("INSERT INTO LoginHistory (UserID, IP) VALUES (:UID, :IP);");
	$sth->bindParam(':UID', $_SESSION['UID']);
	$sth->bindParam(':IP', $_SERVER['REMOTE_ADDR']);
	$sth->execute();
}

