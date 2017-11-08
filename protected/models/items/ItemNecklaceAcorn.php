<?php

/**
 * Модель "ItemNecklaceAcorn"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Желудивое ожерелье
 */

class ItemNecklaceAcorn extends ItemEquip {

	/**
	 * Название ауры
	 * @return string
	 */
	public function auraName() {
		return 'Сокращение времени поиска желудей вдвое';
	}

	/**
	 * Эффект ауры
	 */
	public function auraEffect() {
		Yii::app()->params['location_search_fast'] = Yii::app()->params['location_search_fast'] / 2;
		Yii::app()->params['location_search_long'] = Yii::app()->params['location_search_long'] / 2;
	}

}
