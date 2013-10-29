<?php
class captcha {
	private $image;

	function __construct($path) {
		$this->image = new image($path);
	}

	public function getText() {

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
