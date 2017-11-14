<?php

class ScoutController extends CController
{
	// Заглушка
	public function actionIndex() {
		echo "Это не работает так.";
		Yii::app()->end();
	}

	// Выдача наград за разведку (раз в минуту)
	public function actionReward() {
		echo "Выдаём награды за разведку.";

		// Разведка
		$stateEntries = PlayerState::model()->findAllByAttributes([
				'alias' => 'scout',
			], [
				'condition' => 'cooldown < :date and state_text is not null',
				'params' => [
					'date' => date('Y-m-d H:i:s', time() + 1),
				],
		]);

		foreach ($stateEntries as $stateEntry) {
			if (rand(0, 1) < Yii::app()->params['location_scout_coins_chance']) { // шанс на успех
				$scoutTime = (int)$stateEntry->state_text / 60;
				$coins = rand(100 * $stateEntry->player->lvl, 500 * $stateEntry->player->lvl) * Yii::app()->params['location_scout_coins_rate'];
				$log_html = 'Прийдя с разведки вы пересчитали найденные честным трудом монеты. Всего <b>'.$coins.'</b> <img src="/assets/img/coins16.png" title="монеты"> <b>'.Funcs::declination($coins,'монета','монеты','монет').'</b>.';
				$stateEntry->player->coins += $coins;
				$stateEntry->player->save();

				if (rand(0, 1) < Yii::app()->params['location_scout_chest_chance']) { // шанс клада
					// Выдаём предмет с id = 1 (Подарок альфа-тестеру)
					$itemEntry = Item::model()->findByPk(1);
					$drop_html []= $itemEntry->getLogText(1);
					$stateEntry->player->addItem(1, 1);

					if (sizeof($drop_html))
						$log_html .= '<br>Кроме того вы нашли клад: '.implode(', ', $drop_html);
				}

			}
			else {
				$log_html = 'Вы пришли с разведки ни с чем.';
			}
			Funcs::logMessage($log_html, 'actions', $stateEntry->player->id);

			$stateEntry->state_text = null;
			$stateEntry->save();
		}

		Yii::app()->end();
	}

	// Сброс счётчика оставшейся разведки (раз в сутки)
	public function actionReset() {
		echo "Сбрасываем счётчик остввшихся разведок на сегодня.";

		// Игроки
		$players = Player::model()->findAll();

		foreach ($players as $player) {
			$player->setStateIntVal('scouts_left', 120);
		}

		Yii::app()->end();
	}

}