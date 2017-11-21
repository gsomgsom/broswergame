<?php

/**
 * Модель "ItemLeafDead"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Мёртвый лист. За пачку листьев двют другой случайный лист, кроме мёртвого
 */

class ItemLeafDead extends Item {

	/**
	 * Использование предмета
	 * @return array
	 */
	public function useItem($player_item, $amount) {
		if (parent::useItem($player_item, $amount)) {
			if ($amount !== $player_item->item->use_stack) {
				$amount = $player_item->item->use_stack;
			}
			Yii::app()->user->setFlash('error', null);

			$drop_html = [];

			$r = rand(0,2);

			if ($r == 0) { // 33%
				// Выдаём x1 предметов с id = 14 (Зелёный лист)
				$itemEntry = Item::model()->findByPk(14);
				$drop_html []= $itemEntry->getLogText(1);
				$player_item->player->addItem(14, 1);
			}
			elseif ($r == 1) { // 33%
				// Выдаём x1 предметов с id = 15 (Красный лист)
				$itemEntry = Item::model()->findByPk(15);
				$drop_html []= $itemEntry->getLogText(1);
				$player_item->player->addItem(15, 1);
			}
			else { // 33%
				// Выдаём x1 предметов с id = 16 (Золотой лист)
				$itemEntry = Item::model()->findByPk(16);
				$drop_html []= $itemEntry->getLogText(1);
				$player_item->player->addItem(16, 1);
			}

			if (sizeof($drop_html)) {
				$log_html = Yii::t('success', '__item_leaf_dead__used_loot', [
					'{item}' => $player_item->item->getLogText($amount),
					'{loot}' => implode(', ', $drop_html)
				]);
			}
			else {
				$log_html = Yii::t('success', '__item_leaf_dead__used_no_loot', [
					'{item}' => $player_item->item->getLogText($amount),
				]);
			}

			// Запись в логе об этом безобразии
			Funcs::logMessage($log_html, 'resources');

			Yii::app()->user->setFlash('success', Yii::t('success', '__item_leaf_dead__used'));
			return true;
		}
		else
			return false;
	}

}
