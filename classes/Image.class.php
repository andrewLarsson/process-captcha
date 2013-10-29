<?php
class Image {
	private $path;
	private $resource;
	private $data;

	function __construct($path) {
		$this->path = $path;
		$this->resource = imagecreatefrompng($this->path);
		$this->data = resourceToData($this->resource);
	}

	public function getData() {
		return $this->data;
	}

	private function resourceToData($image) {
		$imageData = [];
		for($x = 0; $x < imagesx($image); $x ++) {
			$imageData[$x] = [];
			for($y = 0; $y < imagesy($image); $y ++) {
				$imageData[$x][$y] = imagecolorat($image, $x, $y);
			}
		}
		return $imageData;
	}
}
?>
