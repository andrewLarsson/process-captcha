<?php
class Captcha {
	private $image;
	private $filter;
	private $characters;

	function __construct($imagePath, $charactersPath) {
		$this->image = new Image($imagePath);
		$this->filter = $this->image[0][0];
		$this->characters = $this->getCharacters($charactersPath);
	}

	public function getText() {
		$text = "";
		foreach($this->image as $x => $column) {
			$sample = [];
			foreach($column as $y => $pixel) {
				if($pixel != $this->filter) {
					$sample[] = $pixel;
				}
			}
			foreach($this->characters as $name => $character) {
				if($character == $sample) {
					$text .= $name;
				}
			}
		}
		return $text;
	}

	private function getCharacters($path) {
		$characters = [];
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $file) {
			if(!$file->isDir()) {
				$characters[$file->getBasename($file->getExtension())] = new Image($file->getPathname(), $this->filter);
			}
		}
		return $characters;
	}
}
?>
