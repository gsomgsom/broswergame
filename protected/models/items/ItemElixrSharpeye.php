<?php

/**
 * Модель "ItemElixrSharpeye"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Эликсир зоркости
 */

class ItemElixrSharpeye extends Item {

	/**
	 * Заголовок ауры
	 * @return string
	 */
	public function auraTitle() {
		return 'Эликсир зоркости';
	}

	/**
	 * Иконка ауры
	 * @return string
	 */
	public function auraIcon() {
		return 'potion_big_violett';
	}

	/**
	 * Описание ауры
	 * @return string
	 */
	public function auraDescription() {
		return '<b>Сокращение</b> {clock} времени поиска желудей <b>вдвое</b>';
	}

	/**
	 * Эффект ауры
	 */
	public function auraEffect() {
		Yii::app()->params['location_search_fast'] = Yii::app()->params['location_search_fast'] / 2;
		Yii::app()->params['location_search_long'] = Yii::app()->params['location_search_long'] / 2;
	}

	/**
	 * Использование предмета
	 * @return array
	 */
	public function useItem($player_item, $amount) {
		if (parent::useItem($player_item, $amount)) {

			$time = strtotime(date('Y-m-d H:i', time()));
			$current_cooldown = Yii::app()->getController()->user->player->getStateCooldown(get_class($this));
			$time_diff = 0;
			if ($current_cooldown > $time)
				$time_diff = $current_cooldown - $time;
			Yii::app()->getController()->user->player->setStateCooldown(get_class($this), $time + $time_diff + Yii::app()->params['player_elixir_rate'] * 60 * 60);
			Yii::app()->getController()->user->player->setStateVal(get_class($this), 'spell');

			Yii::app()->user->setFlash('error', null);
			Yii::app()->user->setFlash('success', Yii::t('success', '__item_elixir_sharpeye__used'));
			return true;
		}
		else
			return false;
	}

}
