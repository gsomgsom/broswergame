<?php

/**
 * Модель "ItemNecklaceAcorn"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Желудивое ожерелье
 */

class ItemNecklaceAcorn extends ItemEquip {

	/**
	 * Заголовок ауры
	 * @return string
	 */
	public function auraTitle() {
		return 'Желудивое ожерелье';
	}

	/**
	 * Иконка ауры
	 * @return string
	 */
	public function auraIcon() {
		return 'nuts';
	}

	/**
	 * Описание ауры
	 * @return string
	 */
	public function auraDescription() {
		return '<b>Сокращение</b> <img class="i-clock" src="/assets/img/clock16.png" title="таймер"> времени поиска желудей <b>вдвое</b>';
	}

	/**
	 * Эффект ауры
	 */
	public function auraEffect() {
		Yii::app()->params['location_search_fast'] = Yii::app()->params['location_search_fast'] / 2;
		Yii::app()->params['location_search_long'] = Yii::app()->params['location_search_long'] / 2;
	}

}
