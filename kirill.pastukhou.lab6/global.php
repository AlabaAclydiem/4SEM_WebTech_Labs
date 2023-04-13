<?php
	function get($filename) {
		return file_get_contents($filename);
	}
	
	function replace($template, $old, $new) {
		return str_replace($old, $new, $template);
	}
	
	$spec = "\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\.";
	$letter = "a-z0-9"; 
	define("PATTERN", "/^[{$letter}{$spec}]+@([{$letter}\-]+\.)+[{$letter}\-]+$/i");
	
	function check($email) {
		return preg_match(PATTERN, $email);
	}
	
	function base($css, $title, $content) {
		$main = get("templates/main.html");
		$main = replace($main, "{{ css }}", $css);
		$main = replace($main, "{{ title }}", $title);
		$header = get("templates/navbar.html");
		if (isset($_COOKIE["cookie"])) {
			$header = replace($header, "{{ auth }}", get("templates/logout.html"));
		} else {
			$header = replace($header, "{{ auth }}", get("templates/signin.html"));
		}
		$main = replace($main, "{{ navbar }}", $header);
		$main = replace($main, "{{ content }}", $content);
		$main = replace($main, "{{ footer }}", get("templates/footer.html"));
		return $main;
	}	

