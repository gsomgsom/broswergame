<?php

/**
 * Модель "ItemLeafRed"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Зелёный лист. За пачку листьев двют красное зелье (90%), или синее (10%)
 */

class ItemLeafRed extends Item {

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

			if (rand(0, 9) > 8) { // 10%
				// Выдаём x1 предметов с id = 3 (Синее зелье)
				$itemEntry = Item::model()->findByPk(3);
				$drop_html []= $itemEntry->getLogText(1);
				$player_item->player->addItem(3, 1);
			}
			else { // остальные 90%
				// Выдаём x1 предметов с id = 2 (Красное зелье)
				$itemEntry = Item::model()->findByPk(2);
				$drop_html []= $itemEntry->getLogText(1);
				$player_item->player->addItem(2, 1);
			}

			if (sizeof($drop_html)) {
				$log_html = Yii::t('success', '__item_leaf_red__used_loot', [
					'{item}' => $player_item->item->getLogText($amount),
					'{loot}' => implode(', ', $drop_html)
				]);
			}
			else {
				$log_html = Yii::t('success', '__item_leaf_red__used_no_loot', [
					'{item}' => $player_item->item->getLogText($amount),
				]);
			}

			// Запись в логе об этом безобразии
			Funcs::logMessage($log_html, 'resources');

			Yii::app()->user->setFlash('success', Yii::t('success', '__item_leaf_red__used'));
			return true;
		}
		else
			return false;
	}

}
