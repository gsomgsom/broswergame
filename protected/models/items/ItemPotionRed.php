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
	public function use($player_item, $amount) {
		if (parent::use($player_item, $amount)) {
			$player_item->player->hp = 100; // @TODO - должно восстанавливать 100% hp
			$player_item->player->save();

			Yii::app()->user->setFlash('error', null);
			Yii::app()->user->setFlash('success', Yii::t('success', 'О чудо! Он может ходить!'));
			return true;
		}
		else
			return false;
	}

}
