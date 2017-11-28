<?php

/**
 * Модель "ItemLeafGreen"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Зелёный лист. За пачку листьев двют немного опыта.
 */

class ItemLeafGreen extends Item {

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

			// Выдаём 5% опыта до уровня
			$amountExp = ceil($player_item->player->expToLevelMax() * 0.05) * Yii::app()->params['player_exp_rate'];
			$player_item->player->exp = $player_item->player->exp + $amountExp;
			$player_item->player->save();
			$drop_html []= "{exp} ".$amountExp;

			if (sizeof($drop_html)) {
				$log_html = Yii::t('success', '__item_leaf_green__used_loot', [
					'{item}' => $player_item->item->getLogText($amount),
					'{loot}' => implode(', ', $drop_html)
				]);
			}
			else {
				$log_html = Yii::t('success', '__item_leaf_green__used_no_loot', [
					'{item}' => $player_item->item->getLogText($amount),
				]);
			}

			// Запись в логе об этом безобразии
			Funcs::logMessage($log_html, 'resources');

			Yii::app()->user->setFlash('success', Yii::t('success', '__item_leaf_green__used'));
			return true;
		}
		else
			return false;
	}

}
