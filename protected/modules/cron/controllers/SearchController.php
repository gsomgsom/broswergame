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

		// Поиск
		$stateEntries = PlayerState::model()->findAllByAttributes([
				'alias' => 'search',
			], [
				'condition' => 'cooldown < :date and state_text is not null',
				'params' => [
					'date' => date('Y-m-d H:i:s', time() + 1),
				],
		]);

		foreach ($stateEntries as $stateEntry) {
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
				$log_html = 'Скитаясь по лесу вы обнаружили <b>'.$nuts.'</b> <img src="/assets/img/nuts16.png" title="жёлуди"> <b>'.Funcs::declination($nuts,'жёлудь','жёлудя','желудей').'</b>.';
				$stateEntry->player->nuts += $nuts;
				$stateEntry->player->save();
			}
			else {
				$log_html = 'Скитаясь по лесу вы как ни старались, пришли ни с чем.';
			}
			Funcs::logMessage($log_html, 'actions', $stateEntry->player->id);

			$stateEntry->state_text = null;
			$stateEntry->save();
		}

		Yii::app()->end();
	}

}