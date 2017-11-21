<?php

/**
 * Модель "ItemStudentHat"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Квадратная академическая шапочка
 */

class ItemStudentHat extends ItemEquip {

	/**
	 * Заголовок ауры
	 * @return string
	 */
	public function auraTitle() {
		return 'Академический комплект';
	}

	/**
	 * Иконка ауры
	 * @return string
	 */
	public function auraIcon() {
		return 'exp';
	}

	/**
	 * Описание ауры
	 * @return string
	 */
	public function auraDescription() {
		if (!$this->user)
			$this->user = Yii::app()->getController()->user;

		foreach ($this->user->player->states as $player_state) {
			if (($player_state->state_text == 'aura') && ($player_state->alias == 'ItemStudentMantle')) {
				return '<b>Удвоение</b> всего получаемого {exp} <b>опыта</b>';
			}
		}
		return false;
	}

	/**
	 * Эффект ауры
	 */
	public function auraEffect() {
		if (!$this->user)
			$this->user = Yii::app()->getController()->user;

		foreach ($this->user->player->states as $player_state) {
			if (($player_state->state_text == 'aura') && ($player_state->alias == 'ItemStudentMantle')) {
				Yii::app()->params['player_exp_rate'] = Yii::app()->params['player_exp_rate'] * 2;
			}
		}
	}

}
