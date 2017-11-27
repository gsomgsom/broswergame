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

	/**
	 * Расчет шанса уворота атакующего игрока
	 * @att Player Атакующий игрок
	 * @def Player Защищующийся игрок
	 * @return double шанс уворота
	 */
	public static function getEvadeChance($att, $def) {
		$evadeChance = (2.7 * $att->lvl * $att->countDex() - 2.7 * $def->lvl * $def->countDex()) / (300 * $def->lvl);
		$evadeChance = $evadeChance < 0.05 ? 0.05 : $evadeChance;
		$evadeChance = $evadeChance > 0.95 ? 0.95 : $evadeChance;
		return $evadeChance;
	}

	/**
	 * Расчет шанса критического удара атакующего игрока
	 * @att Player Атакующий игрок
	 * @def Player Защищующийся игрок
	 * @return double шанс критического удара
	 */
	public static function getCritChance($att, $def) {
		$critChance = (2.7 * $att->lvl * $att->countInt() - 2.7 * $def->lvl * $def->countInt()) / (300 * $def->lvl);
		$critChance = $critChance < 0.05 ? 0.05 : $critChance;
		$critChance = $critChance > 0.95 ? 0.95 : $critChance;
		return $critChance;
	}

	/**
	 * Расчет максимального урона атакующего игрока
	 * @att Player Атакующий игрок
	 * @def Player Защищующийся игрок
	 * @return double размер максимального урона
	 */
	public static function getMaxDamage($att, $def) {
		$maxDamage = (0.5 * $att->lvl * $att->countStr() - 0.4 * $def->lvl * $def->countDef());
		$minDmg = (1 * $att->lvl);
		$maxDamage = $maxDamage < $minDmg ? $minDmg : $maxDamage;
		return $maxDamage;
	}

	/**
	 * Расчет максимального количества очков жизни (HP)
	 * @player Player Игрок
	 * @return double размер максимального количества HP
	 */
	public static function getMaxHP($player) {
		$maxHP = $player->lvl * 10 * $player->countSta();
		return $maxHP;
	}

	/**
	 * Расчёт удара в бою
	 *
	 * @att Player Атакующий игрок
	 * @def Player Защищующийся игрок
	 * @return array
	 */
	public static function countBattleTurn($player1, $player2) {
		$player1_dmg = round(Formulas::getMaxDamage($player1, $player2) * (rand(50, 100) / 100));
		$player2_evade = (rand(0, 100) / 100) < Formulas::getEvadeChance($player2, $player1);
		$player1_crit = (rand(0, 100) / 100) < Formulas::getCritChance($player1, $player2);
		$logStr = "";
		$logStr .= "<b>".$player1->nickname."</b> ударил <b>".$player2->nickname."</b>, ";
		if ($player2_evade) {
			$player1_dmg = 0;
			$logStr .= "но <b style='color: blue;'>промахнулся</b>.";
		}
		else {
			if ($player1_crit) {
				$player1_dmg *= 2;
				$logStr .= "и <b style='color: red;'>кританул</b> на <b>{$player1_dmg}</b>";
			}
			else {
				$logStr .= "и <b>ударил</b> на <b>{$player1_dmg}</b>";
			}
		}
		$logStr .= "<br>\n";

		return [
			'log' => $logStr,
			'damage' => $player1_dmg,
		];
	}

}