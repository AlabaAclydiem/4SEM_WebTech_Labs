<?php

	include "global.php";
	
	$email = "";
	$password = "";
	$content = get("templates/register_form.html");
	if (!isset($_COOKIE["cookie"])) {
		if ($_POST["email"] != "") {
			$email = $_POST["email"];
			$password = $_POST["password"];	
			if (check($email)) {
				$password = hash("sha256", $password);
				try {
					$dbh = new PDO('mysql:dbname=personalities_sixteen;host=localhost', 'root', 'qwerty');
				} catch (PDOException $e) {
					die($e->getMessage());
				}
				$sth = $dbh->prepare("SELECT * FROM `users_data` WHERE `Email` = :email");
				$sth->bindParam('email', $email, PDO::PARAM_STR);
				$sth->execute();
				$data = $sth->fetch(PDO::FETCH_ASSOC);
				if ($data == false) {
					$sth = $dbh->prepare("INSERT INTO `users_data` SET `Email` = :email, `Hash` = :hash, `User_hash` = :uhash");
					$sth->bindParam('email', $email, PDO::PARAM_STR);
					$sth->bindParam('hash', $password, PDO::PARAM_STR);
					$sth->bindValue('uhash', hash("sha256", rand(10e10, 10e17)), PDO::PARAM_STR);
					$sth->execute();
					$sth = $dbh->prepare("SELECT * FROM `users_data` WHERE `Email` = :email");
					$sth->bindParam('email', $email, PDO::PARAM_STR);
					$sth->execute();
					$data = $sth->fetch(PDO::FETCH_ASSOC);
					setcookie("cookie", $data['User_hash']);
					header("Location: persons.php");
				} else {
					if ($password == $data['Hash']) {
						setcookie("cookie", $data['User_hash']);
						header("Location: persons.php");
					} else {
						$content = replace($content, "{{ check }}", "Password is incorrect!");	
					}
				}
			} else {
				$content = replace($content, "{{ check }}", "Email is incorrect!");
			}
		} else {
			$content = replace($content, "{{ check }}", "");
		}
	} else {
		header("Location: index.php");
	}
	

	$main = base("css/registration.css", "Sign In", $content);
	
	echo $main;

