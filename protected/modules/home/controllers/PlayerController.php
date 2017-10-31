<?php

class PlayerController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Персонаж';
		$data = [];
		$data['player_items'] = $this->user->player->player_items;
		$this->render('index', $data);
	}

}