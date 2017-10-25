<?php
class Funcs {

	/**
	 * Склонение числа $num
	 */
	static function declination($num, $one, $ed, $mn) {
		if(($num == "0") or (($num >= "5") and ($num <= "20")) or preg_match("|[056789]$|",$num))
			return $mn;
		if(preg_match("|[1]$|",$num))
			return $one;
		if(preg_match("|[234]$|",$num))
			return $ed;
	}

}