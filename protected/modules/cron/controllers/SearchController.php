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

			$stateEntry->player->applyAuras(); // применяем ауры и заклятия

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

				// Игровое событие: Осень - листья падают?
				if (Yii::app()->params['game_event_autumn_leaves']) {
					if (rand(0, 2) == 0) { // 33%
						$drop_html = '';
						$r = rand(0,3);

						if ($r == 0) { // 25%
							// Выдаём x1 предметов с id = 14 (Зелёный лист)
							$item = ['id' => 14, 'amount' => 1];
							$itemEntry = Item::model()->findByPk($item['id']);
							$drop_html []= $itemEntry->getLogText(1);
							$stateEntry->player->addItem($item['id'], $item['amount']);
						}
						elseif ($r == 1) { // 25%
							// Выдаём x1 предметов с id = 15 (Красный лист)
							$item = ['id' => 15, 'amount' => 1];
							$itemEntry = Item::model()->findByPk($item['id']);
							$drop_html []= $itemEntry->getLogText(1);
							$stateEntry->player->addItem($item['id'], $item['amount']);
						}
						elseif ($r == 2) { // 25%
							// Выдаём x1 предметов с id = 15 (Красный лист)
							$item = ['id' => 16, 'amount' => 1];
							$itemEntry = Item::model()->findByPk($item['id']);
							$drop_html []= $itemEntry->getLogText(1);
							$stateEntry->player->addItem($item['id'], $item['amount']);
						}
						else { // 25%
							// Выдаём x1 предметов с id = 16 (Мёртвый лист)
							$item = ['id' => 17, 'amount' => 1];
							$itemEntry = Item::model()->findByPk($item['id']);
							$drop_html []= $itemEntry->getLogText(1);
							$stateEntry->player->addItem($item['id'], $item['amount']);
						}

						$log_html .= '<br>Осмотревшись, вы случайно заметили, как к вам прилип '.implode(', ', $drop_html);
					}
				}

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