<?php
/**
 * Формулы игры
 */
class Formulas {
	const EXP_RATE                = 10;       // Множитель таблиц опыта

	/**
	 * Расчет уровня персонажа по опыту
	 * @exp integer Опыт
	 * @return integer Уровень персонажа
	 */
	public static function getPlayerLevelByExp($exp) {
		$exp = $exp / Formulas::EXP_RATE;
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
	 * Расчет опыта по уровню персонажа
	 * @lvl integer Уровень персонажа
	 * @return integer Опыт
	 */
	public static function getPlayerExpByLevel($lvl) {
		$y = $lvl * Formulas::EXP_RATE + 5;
		$x = (pow($y,2) - 425) / 2;
		if ($x < 0)
			$x = 0;
		return $x;
	}

	/**
	 * Расчет опыта для следующего уровня
	 * @exp integer Опыт
	 * @return integer Опыт
	 */
	public static function getNextLevelExp($exp) {
		$lvl_now = Formulas::getPlayerLevelByExp($exp)+1;
		$exp=(5*($lvl_now*$lvl_now)+5*$lvl_now-20) * Formulas::EXP_RATE;
		return $exp;
	}

}