<?php

/**
 * Модель "ItemPotion"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Снадобье - предмет, который можно выпить, получив мгновенное действие
 */

class ItemPotion extends Item {

	/**
	 * Использование предмета
	 * @return array
	 */
	public function useItem($player_item, $amount) {
		if (parent::useItem($player_item, $amount)) {
			Yii::app()->user->setFlash('error', null);
			Yii::app()->user->setFlash('success', Yii::t('success', '__item_potion__used'));
			return true;
		}
		else
			return false;
	}

}
