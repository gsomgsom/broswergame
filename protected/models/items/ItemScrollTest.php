<?php

/**
 * Модель "ItemScrollTest"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Тестовый свиток, проверка работы подсистемы предметов
 */

class ItemScrollTest extends Item {

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

			// Выдаём x3 предметов с id = 2 (Красное зелье)
			$itemEntry = Item::model()->findByPk(2);
			$drop_html []= $itemEntry->getLogText(3);
			$player_item->player->addItem(2, 3);

			if (sizeof($drop_html)) {
				$log_html = Yii::t('success', '__item_scroll_test__used_loot', [
					'{item}' => $player_item->item->getLogText($amount),
					'{loot}' => implode(', ', $drop_html)
				]);
			}
			else {
				$log_html = Yii::t('success', '__item_scroll_test__used_no_loot', [
					'{item}' => $player_item->item->getLogText($amount),
				]);
			}

			// Запись в логе об этом безобразии
			Funcs::logMessage($log_html, 'resources');

			Yii::app()->user->setFlash('success', Yii::t('success', '__item_scroll_test__used'));
			return true;
		}
		else
			return false;
	}

}
