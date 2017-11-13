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
			Yii::app()->user->setFlash('error', null);

			$drop_html = [];

			// Выдаём 1 предмет с id = 2 (Красное зелье)
			$itemEntry = Item::model()->findByPk(2);
			$drop_html []= '<img src="/assets/img/'.$itemEntry->img.'16.png" title="'.$itemEntry->name.'"> <b>'.$itemEntry->name.'</b>';
			$player_item->player->addItem(2, 1);

			$usedAmount = '';
			if ($player_item->item->use_stack > 1) {
				$usedAmount = ' x '.$player_item->item->use_stack;
			}
			if (sizeof($drop_html)) {
				$log_html = 'Вы сколдовали <img src="/assets/img/'.$this->img.'16.png" title="'.$this->name.'"> <b>'.$this->name.'</b>'.$usedAmount.', и тотчас получили: '.implode(', ', $drop_html);
			}
			else {
				$log_html = 'Вы сколдовали <img src="/assets/img/'.$this->img.'16.png" title="'.$this->name.'"> <b>'.$this->name.'</b>'.$usedAmount.', но ничего не получили.';
			}

			// Запись в логе об этом безобразии
			Funcs::logMessage($log_html, 'resources');

			Yii::app()->user->setFlash('success', Yii::t('success', 'Что-то сколдовалось. Но что иенно?'));
			return true;
		}
		else
			return false;
	}

}
