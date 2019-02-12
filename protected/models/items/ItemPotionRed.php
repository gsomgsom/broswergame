<?php

/**
 * Модель "ItemPotionRed"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Красное снадобье
 */

class ItemPotionRed extends Item {

	/**
	 * Использование предмета
	 * @return array
	 */
	public function useItem($player_item, $amount) {
		if (parent::useItem($player_item, $amount)) {
			$player_item->player->hp = Formulas::getMaxHP( $player_item->player );
			$player_item->player->save();

			Yii::app()->user->setFlash('error', null);
			Yii::app()->user->setFlash('success', Yii::t('success', '__item_potion_red__used'));
			return true;
		}
		else
			return false;
	}

}
