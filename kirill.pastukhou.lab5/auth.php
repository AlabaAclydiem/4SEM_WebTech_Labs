<?php

	include "global.php";
	
	$email = "";
	$password = "";
	$content = get("templates/register_form.html");
	
	if ($_POST["email"] != "") {
		$email = $_POST["email"];
		$password = $_POST["password"];	
		if (check($email)) {
			$content = replace($content, "{{ check }}", "Succesfully entered!");
			$password = hash("sha256", $password);
			try {
				$dbh = new PDO('mysql:dbname=personalities_sixteen;host=localhost', 'root', 'qwerty');
			} catch (PDOException $e) {
				die($e->getMessage());
			}
			$sth = $dbh->prepare("INSERT INTO `users_data` SET `Email` = :email, `Hash` = :hash");
			$sth->bindParam('email', $email, PDO::PARAM_STR);
			$sth->bindParam('hash', $password, PDO::PARAM_STR);
			$sth->execute();
		} else {
			$content = replace($content, "{{ check }}", "Email is incorrect!");
		}
	} else {
		$content = replace($content, "{{ check }}", "");
	}

	$main = base("css/registration.css", "Sign In", $content);
	
	
	echo $main;

