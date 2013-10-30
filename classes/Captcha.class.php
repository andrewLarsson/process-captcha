<?php
class Captcha {
	private $image;
	public $text;

	function __construct($path) {
		$this->image = new Image($path);
		$this->text = $this->getText();
	}

	private function getText() {

	}

	private function getPositions($needle, $haystack) {
		$positions = [];
		foreach($haystack as $x => $column) {
			foreach($column as $y => $haystackPoint) {
				if($needle[0] == $haystackPoint) {
					foreach($needle as $needleIndex => $needlePoint) {
						if($needlePoint != $haystack[$x][$y + $needleIndex]) {
							break 2;
						}
					}
					$positions[] = $x;
					break;
				}
			}
		}
		return $positions;
	}
}
?>
