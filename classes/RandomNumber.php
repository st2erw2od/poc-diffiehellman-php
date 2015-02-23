<?php
//random number generator
class RandomNumber {
	/* 
	 * generate a 100-digit long random number
	 * please note there isn't enough entropy for productive use!
	 */
	public static function generateRandomNumber() {
		$nr = "";
		for($i=0; $i<25; $i++) {
			$nr .= rand(1000,9999);
		}
		return $nr;
	}
}
?>