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

		if (empty($player_item)) {
			Yii::app()->user->setFlash('error', Yii::t('error', '__item_controller__use_no_player_item'));
			Funcs::logMessage('Попытка использования экземпляра предмета, которого нет (player_item_id = '.$id.')');
		}
		else {
			if (empty($player_item->item)) {
				Yii::app()->user->setFlash('error', Yii::t('error', '__item_controller__use_no_item'));
				Funcs::logMessage('Попытка использования предмета, которого нет (player_item_id = '.$id.', item_id = '.$player_item->item_id.')');
			}
			else {
				if ($player_item->player_id != $this->user->player->id) {
					Yii::app()->user->setFlash('error', Yii::t('error', '__item_controller__use_not_yours'));
					Funcs::logMessage('Попытка использования чужого предмета (player_item_id = '.$id.', item_id = '.$player_item->item->id.', player_id = '.$player_item->player_id.')');
				}
				else {
					if (!is_null($player_item->item->php_class)) {
						$namedItem = new $player_item->item->php_class;
						$namedItem->attributes = $player_item->item->attributes;
						$namedItem->useItem($player_item, $amount);
					}
					else {
						$player_item->item->useItem($player_item, $amount);
					}
					
				}
			}
		}
		$this->redirect('/player');
	}

}