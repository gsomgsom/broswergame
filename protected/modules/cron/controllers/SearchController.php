<?php

class SearchController extends CController
{
	// Заглушка
	public function actionIndex() {
		echo "Это не работает так.";
		Yii::app()->end();
	}

	// Выдача наград за поиск желудей (раз в минуту)
	public function actionReward() {
		echo "Выдаём награды за поиск желудей.";

		$logType = LogType::model()->findByAttributes(['alias' => 'actions']);

		// Долгий поиск
		$stateEntries = PlayerState::model()->findAllByAttributes(
			[
				'alias' => 'search',
			],
			[
				'condition' => 'cooldown < :date and state_text is not null',
				'params' => [
					'date' => date('Y-m-d H:i:s', time()),
				],
			]
		);

		foreach ($stateEntries as $stateEntry) {
			$logEntry = new PlayerLog();
			$logEntry->dt = date('Y-m-d H:i:s', time());
			if (!empty($logType))
				$logEntry->type_id = $logType->id;
			$logEntry->player_id = $stateEntry->player->id;
			if (rand(0, 2)) { // 66%
				if ($stateEntry->state_text == 'fast') {
					$nuts = rand(1, 3); // от 1 до 3 желудей
				}
				elseif ($stateEntry->state_text == 'long') {
					$nuts = rand(5, 15); // от 5 до 15 желудей
				}
				else {
					$nuts = rand(0);
				}
				$logEntry->html = 'Скитаясь по лесу вы обнаружили <b>'.$nuts.'</b> <img src="/assets/img/nuts16.png" title="жёлуди"> <b>'.Funcs::declination($nuts,'жёлудь','жёлудя','желудей').'</b>.';
				$stateEntry->player->nuts += $nuts;
				$stateEntry->player->save();
			}
			else {
				$logEntry->html = 'Скитаясь по лесу вы как ни старались, пришли ни с чем.';
			}
			$logEntry->save();

			$stateEntry->state_text = null;
			$stateEntry->save();
		}

		Yii::app()->end();
	}

}