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
				if (empty($player_item->item)) {
					Yii::app()->user->setFlash('error', Yii::t('error', 'Такого предмета просто не может быть!'));
				}
				else {
					if (!is_null($player_item->item->php_class)) {
						$namedItem = new $player_item->item->php_class;
						$namedItem->attributes = $player_item->item->attributes;
						$namedItem->use($player_item, $amount);
					}
					else {
						$player_item->item->use($player_item, $amount);
					}
					
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