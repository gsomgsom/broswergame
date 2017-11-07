<?php
class Formulas {

	/**
	 * расчет уровня по экспе - exp(экспа перса)
	 */
	public static function lvl($exp) {
		$c = $exp + 20;
		$a = 5;
		$b = 5;
		$d = $b*$b + 4*$a*$c;
		if ($d>0) {
			$lvl[0]=((-$b+sqrt($d))/(2*$a));
			$lvl[1]=((-$b-+sqrt($d))/(2*$a));
		}
		if ($d==0) {
			$lvl[0]=-$b/(2*$a);
		}
		if ($lvl[0]>=0) {
			return floor($lvl[0]);
		}
		else {
			return floor($lvl[1]);
		}
	}

	/**
	 * расчет экспы по уровню
	 */
	public static function lvl_to_exp($lvl) {
		$y = $lvl*10+5;
		$x = (pow($y,2) - 425) / 20;
		return $x;
	}

	/**
	 * расчет экспы для следующего уровня - exp(экспа перса)
	 */
	public static function n_lvl_exp($exp) {
		$lvl_now = Formulas::lvl($exp)+1;
		$exp=5*($lvl_now*$lvl_now)+5*$lvl_now-20;
		return $exp;
	}

}