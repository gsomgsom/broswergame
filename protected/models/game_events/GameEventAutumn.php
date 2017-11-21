<?php

/**
 * Модель "GameEventAutumn"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Игровое событие. Осень
 */

class GameEventAutumn extends Item {

	/**
	 * Заголовок ауры
	 * @return string
	 */
	public function auraTitle() {
		return 'Событие: Осень';
	}

	/**
	 * Иконка ауры
	 * @return string
	 */
	public function auraIcon() {
		return 'leaf_gold';
	}

	/**
	 * Описание ауры
	 * @return string
	 */
	public function auraDescription() {
		return 'Отовсюду падают разноцветные {leaves} <b>листья</b>';
	}

	/**
	 * Эффект ауры
	 */
	public function auraEffect() {
		Yii::app()->params['game_event_autumn_leaves'] = true; // листья падают
	}

}
