<?php
function imageToData($image) {
	$imageData = [];
	for($x = 0; $x < imagesx($image); $x ++) {
		$imageData[$x] = [];
		for($y = 0; $y < imagesy($image); $y ++) {
			$imageData[$x][$y] = imagecolorat($image, $x, $y);
		}
	}
	return $imageData;
}

class captcha {
	private $image;
	private $imageData;
	
	function __construct() {
		$this->image = imagecreatefrompng("");
		$this->imageData = imageToData($this->image);
	}
	
	public function getText() {
		
	}
	
	private getPositions($needle, $haystack) {
		$positions = [];
		foreach($haystack as $x => $column) {
			foreach($column as $y => $haystackPoint) {
				if($needle[0] == $haystackPoint) {
					foreach($needle as $needleIndex => $needlePoint) {
						if($needlePoint != $haystack[$x][$y + $needleIndex]) {
							break;
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
