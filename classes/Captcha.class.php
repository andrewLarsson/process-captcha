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
		foreach($this->characters as $name => $character) {
			$segment = [];
			foreach($character[0] as $seedling) {
				if($seedling != $this->filter) {
					$segment[] = $seedling;
				}
			}
			$seeds[$name] = $segment;
		}
		foreach($this->image as $column) {
			$sample = [];
			foreach($column as $pixel) {
				if($pixel != $this->filter) {
					$sample[] = $pixel;
				}
			}
			foreach($seeds as $name => $seed) {
				if($seed == $sample) {
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
				$characters[$file->getBasename("." . $file->getExtension())] = new Image($file->getPathname());
			}
		}
		return $characters;
	}
}
?>
