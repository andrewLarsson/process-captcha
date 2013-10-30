<?php
class Image implements ArrayAccess{
	private $path;
	private $resource;
	private $data;

	function __construct($path, $filter = NULL) {
		$this->path = $path;
		$this->resource = imagecreatefrompng($this->path);
		$this->data = resourceToData($this->resource, $filter);
	}

	public function offsetSet($offset, $value) {
		return NULL;
	}

	public function offsetExists($offset) {
		return isset($this->data[$offset]);
	}

	public function offsetUnset($offset) {
		return NULL;
	}

	public function offsetGet($offset) {
		return (
			(isset($this->data[$offset]))
				? $this->data[$offset]
				: NULL
		);
	}

	private function resourceToData($image, $filter) {
		$imageData = [];
		for($x = 0; $x < imagesx($image); $x ++) {
			$imageData[$x] = [];
			for($y = 0; $y < imagesy($image); $y ++) {
				if(imagecolorat($image, $x, $y) != $filter) {
					$imageData[$x][$y] = imagecolorat($image, $x, $y);
				}
			}
		}
		return $imageData;
	}
}
?>
