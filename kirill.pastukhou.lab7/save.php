<?php 
	try {
		$dbh = new PDO('mysql:dbname=personalities_sixteen;host=localhost', 'root', 'qwerty');
	} catch (PDOException $e) {
		die($e->getMessage());
	}
	$sth = $dbh->prepare("SELECT `User_ID` FROM `users_data` WHERE `User_hash` = :uhash");
	$sth->bindParam("uhash", $_COOKIE["cookie"], PDO::PARAM_STR);
	$sth->execute();
	$id = $sth->fetch(PDO::FETCH_COLUMN);
	$sth = $dbh->prepare("INSERT INTO `user_notebook` SET `User_ID` = :id, `Text` = :text1 ON DUPLICATE KEY UPDATE `Text` = :text2");
	$sth->bindParam("id", $id, PDO::PARAM_STR);
	$sth->bindParam("text1", $_POST["text"], PDO::PARAM_STR);
	$sth->bindParam("text2", $_POST["text"], PDO::PARAM_STR);
	$sth->execute();
	header("Location: persons.php");
