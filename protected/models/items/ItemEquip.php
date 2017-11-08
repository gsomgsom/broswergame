<?php

/**
 * Модель "ItemEquip"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Надеваемый предмет
 */

class ItemEquip extends Item {

	/**
	 * Эффект при надевании
	 * @player_item PlayerItem
	 */
	public function onEequip($player_item) {
		// Вешаем ауру
		$player_item->player->setStateVal(get_class($this), 'aura');
	}

	/**
	 * Эффект при снятии
	 * @player_item PlayerItem
	 */
	public function onUnEequip($player_item) {
		// Снимаем ауру
		$player_item->player->setStateVal(get_class($this));
	}

	/**
	 * Использование предмета
	 * @return array
	 */
	public function useItem($player_item, $amount) {
		if (parent::useItem($player_item, $amount)) {
			
			Yii::app()->user->setFlash('error', null);

			// Снимаем все предметы из этого слота
			foreach ($player_item->player->player_items as $player_item_entry) {
				if ($player_item_entry->item->type == $player_item->item->type) {
					$player_item_entry->equipped = 0;
					$player_item_entry->save();
				}
			}

			if ($player_item->equipped) {
				// Снимаем предмет
				$player_item->equipped = 0;
				$player_item->save();
				$this->onUnEequip($player_item);
				Yii::app()->user->setFlash('success', 'Вы сняли &laquo;'.$player_item->item->name.'&raquo;');
			}
			else {
				// Надеваем предмет
				$player_item->equipped = 1;
				$player_item->save();
				$this->onEequip($player_item);
				Yii::app()->user->setFlash('success', 'Вы надели &laquo;'.$player_item->item->name.'&raquo;');
			}

			return true;
		}
		else
			return false;
	}

}
