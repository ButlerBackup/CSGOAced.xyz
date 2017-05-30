<?php

$sth = $conn->prepare("UPDATE Users SET PrivateKey = NULL WHERE ID = :UID");
$sth->bindParam(':UID', $_SESSION['UID']);
$sth->execute();