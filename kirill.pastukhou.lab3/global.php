<?php
	function get($filename) {
		return file_get_contents($filename);
	}
	
	function replace($template, $old, $new) {
		return str_replace($old, $new, $template);
	}
	
	function base($css, $title, $content) {
		$main = get("templates/main.html");
		$main = replace($main, "{{ css }}", $css);
		$main = replace($main, "{{ title }}", $title);
		$main = replace($main, "{{ navbar }}", get("templates/navbar.html"));
		$main = replace($main, "{{ content }}", $content);
		$main = replace($main, "{{ footer }}", get("templates/footer.html"));
		return $main;
	}	
?>
