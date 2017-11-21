<?php

/**
 * Модель "ItemLeafGold"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Золотой лист. За пачку листьев двют Подарок альфа тестеру
 */

class ItemLeafGold extends Item {

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

			// Выдаём x1 предметов с id = 1 (Подарок альфа тестеру)
			$itemEntry = Item::model()->findByPk(1);
			$drop_html []= $itemEntry->getLogText(1);
			$player_item->player->addItem(1, 1);

			if (sizeof($drop_html)) {
				$log_html = Yii::t('success', '__item_leaf_gold__used_loot', [
					'{item}' => $player_item->item->getLogText($amount),
					'{loot}' => implode(', ', $drop_html)
				]);
			}
			else {
				$log_html = Yii::t('success', '__item_leaf_gold__used_no_loot', [
					'{item}' => $player_item->item->getLogText($amount),
				]);
			}

			// Запись в логе об этом безобразии
			Funcs::logMessage($log_html, 'resources');

			Yii::app()->user->setFlash('success', Yii::t('success', '__item_leaf_gold__used'));
			return true;
		}
		else
			return false;
	}

}
