<?php
class Image implements ArrayAccess, Iterator {
	private $pointer;
	private $path;
	private $resource;
	private $data;

	function __construct($path) {
		$this->pointer = 0;
		$this->path = $path;
		$this->resource = imagecreatefrompng($this->path);
		$this->data = $this->resourceToData($this->resource);
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

	public function key() {
		return $this->pointer;
	}

	public function current() {
		return $this->data[$this->pointer];
	}

	public function next() {
		++ $this->pointer;
	}

	public function rewind() {
		$this->pointer = 0;
	}

	public function valid() {
		return isset($this->data[$this->pointer]);
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
