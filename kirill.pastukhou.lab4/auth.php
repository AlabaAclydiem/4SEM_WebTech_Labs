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
			$file = fopen("users.txt", "a") or die("Unable to open file!");
			fwrite($file, $email." ".$password."\n");
			fclose($file);
		} else {
			$content = replace($content, "{{ check }}", "Email is incorrect!");
		}
	} else {
		$content = replace($content, "{{ check }}", "");
	}

	$main = base("css/registration.css", "Sign In", $content);
	
	
	echo $main;
