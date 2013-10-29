<?php
class Character {
	private $sample;

	function __construct($sample) {
		$this->data = $sample;
	}

	public function getSample() {
		return $this->sample;
	}
}
?>
