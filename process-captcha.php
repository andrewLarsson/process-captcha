<?php
spl_autoload_register(function ($class) {
	include "classes/" . $class . ".class.php";
});
$argShort = "";
$argShort .= "f:";
$arguments = getopt($argShort);
if(array_key_exists("f", $arguments)) {
	$captcha = new Captcha(
		$arguments['f'], (
			(array_key_exists("c", $arguments))
				? $arguments['c']
				: "images"
		)
	);
	print($captcha->getText() . "\n");
} else {
	print(
		"Analyzes and processes simple captchas.\n" .
		"Copyright 2013 developersBliss.com\n\n" .
		"Usage: php process-captcha.php -f <path_to_captcha_image> -c <path_to_character_files>\n";
	);
}
?>
