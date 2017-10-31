<?php

class ItemController extends LoggedController
{

	public function actionIndex() {
		$this->redirect('/');
	}

	public function actionUse() {
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$amount = isset($_GET['amount']) ? (int)$_GET['amount'] : 1;
		$player_item = PlayerItems::model()->findByPk($id);
		if (!empty($player_item)) {
			if ($player_item->player_id != $this->user->player->id) {
				Yii::app()->user->setFlash('error', Yii::t('error', 'Куда? Чужое!'));
			}
			else {

				// Подарок альфа-тестеру
				if ($player_item->item_id == 1) {
					$drop = [];
					$drop_html = [];
					if (rand(0, 1)) {
						$drop['coins'] = rand(3000 * $this->user->player->lvl, 5000 * $this->user->player->lvl);
						$drop_html []= '<b>'.$drop['coins'].'</b> <img src="/assets/img/coins16.png" title="монеты"> <b>'.Funcs::declination($drop['coins'],'монета','монеты','монет').'</b>';
						$this->user->player->coins += $drop['coins'];
					}
					if (rand(0, 1)) {
						$drop['nuts'] = rand(1 * $this->user->player->lvl, 3 * $this->user->player->lvl);
						$drop_html []= '<b>'.$drop['nuts'].'</b> <img src="/assets/img/nuts16.png" title="жёлуди"> <b>'.Funcs::declination($drop['nuts'],'жёлудь','жёлудя','желудей').'</b>';
						$this->user->player->nuts += $drop['nuts'];
					}
					if (!rand(0, 9)) {
						$drop['mushrooms'] = rand(1, 2);
						$drop_html []= '<b>'.$drop['mushrooms'].'</b> <img src="/assets/img/mushrooms16.png" title="волшебные грибы"> <b>'.Funcs::declination($drop['mushrooms'],'гриб','гриба','грибов').'</b>';
						$this->user->player->mushrooms += $drop['mushrooms'];
					}
					$this->user->player->save();
					$items = [];
					if (rand(0, 1)) {
						$items_drop = [2,3,4,5,6,7,8];
						shuffle($items_drop);
						for ($i=0; $i<rand(0, 2); $i++) {
							$item = ['id' => array_shift($items_drop), 'amount' => 1];
							$itemEntry = Item::model()->findByPk($item['id']);
							$drop_html []= '<img src="/assets/img/item16.png" title="предмет"> <b>'.$itemEntry->name.'</b>';
							$items []= $item;
							$this->user->player->addItem($item['id'], $item['amount']);
						}
					}
					$drop['items'] = $items;
					$this->user->player->removeItem($player_item->item_id, $player_item->item->use_stack);

					Yii::app()->user->setFlash('success', Yii::t('success', 'Вы открыли подарок!'));

					// Запись в логе об этом безобразии
					$logType = LogType::model()->findByAttributes(['alias' => 'resources']);
					$logEntry = new PlayerLog();
					$logEntry->dt = date('Y-m-d H:i:s', time());
					if (!empty($logType))
						$logEntry->type_id = $logType->id;
					$logEntry->player_id = $this->user->player->id;
					if (sizeof($drop_html)) {
						$logEntry->html = 'Вы открыли подарок, и обнаружили там: '.implode(', ', $drop_html);
					}
					else {
						$logEntry->html = 'Вы открыли подарок, но он оказался совсем пустой. Дурак тот дядя. И шутки у него дурацкие.';
					}
					$logEntry->save();

/*
					// Окно с контейнером @TODO
					$opendrop = $this->renderPartial('opendrop', [
						'class' => 'alphabag',
						'title' => 'Подарок альфа тестеру',
						'text' => 'Развязав узелок у <b>мешочка</b> и заглянув в него, вы обнаружили:',
						'drop' => $drop,
					], true);
					Yii::app()->user->setFlash('opendrop', $opendrop);
*/
				}

				// Красное зелье
				elseif ($player_item->item_id == 2) {
					//$this->user->player->hp = 100;
					//$this->user->player->save();
					if ($player_item->amount >= $player_item->item->use_stack) {
						$this->user->player->removeItem($player_item->item_id, $player_item->item->use_stack);
						Yii::app()->user->setFlash('success', Yii::t('success', 'О чудо! Он может ходить!'));
					}
					else {
						Yii::app()->user->setFlash('error', 'Надо сразу использовать '.$player_item->item->use_stack.' шт.');
					}
				}

				// Синий свиток
				elseif ($player_item->item_id == 4) {
					if ($player_item->amount >= $player_item->item->use_stack) {
						$this->user->player->removeItem($player_item->item_id, $player_item->item->use_stack);
						$this->user->player->addItem(2, 1);
						Yii::app()->user->setFlash('success', Yii::t('success', 'Что-то сколдовалось. Но что иенно?'));
					}
					else {
						Yii::app()->user->setFlash('error', 'Надо сразу использовать '.$player_item->item->use_stack.' шт.');
					}
				}

				// Остальные предметы
				else {
					Yii::app()->user->setFlash('error', 'Не реализовано ;-(');
				}
			}
		}
		else {
			Yii::app()->user->setFlash('error', Yii::t('error', 'Такого предмета нет!'));
		}
		$this->redirect('/home');
	}

	public function actionUnuse() {
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		// @TODO - находим экземпляр предмета по ID, инитим и снимаем с персонажа (если персонаж наш)
		Yii::app()->user->setFlash('error', 'Не реализовано ;-(');
		$this->redirect('/home');
	}

}