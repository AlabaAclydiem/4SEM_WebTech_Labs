<?php

	include "global.php";
	
	try {
		$dbh = new PDO('mysql:dbname=personalities_sixteen;host=localhost', 'root', 'qwerty');
	} catch (PDOException $e) {
		die($e->getMessage());
	} 
	
	$index = "ESTJ";
	if (!empty($_GET)) {
		$index = $_GET["ei-select"].$_GET["sn-select"].$_GET["tf-select"].$_GET["jp-select"];
	}
	
	$content = get("templates/authed_content.html");
	if ($index[0] == "E") {
		$content = replace($content, "{{ e }}", 'selected="selected"');
		$content = replace($content, "{{ i }}", "");
	} else {
		$content = replace($content, "{{ i }}", 'selected="selected"');
		$content = replace($content, "{{ e }}", "");
	}	
	if ($index[1] == "S") {
		$content = replace($content, "{{ s }}", 'selected="selected"');
		$content = replace($content, "{{ n }}", "");
	} else {
		$content = replace($content, "{{ n }}", 'selected="selected"');
		$content = replace($content, "{{ s }}", "");
	}	
	if ($index[2] == "T") {
		$content = replace($content, "{{ t }}", 'selected="selected"');
		$content = replace($content, "{{ f }}", "");
	} else {
		$content = replace($content, "{{ f }}", 'selected="selected"');
		$content = replace($content, "{{ t }}", "");
	}	
	if ($index[3] == "J") {
		$content = replace($content, "{{ j }}", 'selected="selected"');
		$content = replace($content, "{{ p }}", "");
	} else {
		$content = replace($content, "{{ p }}", 'selected="selected"');
		$content = replace($content, "{{ j }}", "");
	}	
	
	$sth = $dbh->prepare("SELECT * FROM `identity_data` WHERE `Code` = :code");
	$sth->bindParam('code', $index, PDO::PARAM_STR);
	$sth->execute();
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	$content = replace($content, "{{ person_logo }}", $data['Image']);
	$content = replace($content, "{{ person_text }}", $data['Content']);
	$content = replace($content, "{{ person_quote }}", $data['Quote']);
	
	
	$main = base("css/auth_info.css", "Personalities", $content);
	
	echo $main;

