<?php

class LookController extends LoggedController
{
	public function actionPlayer() {
		Yii::app()->params['pageTitle'] = 'Просмотр персонажа';

		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$player = Player::model()->findByPk($id);

		if (empty($player))
			 throw new CHttpException(404);

		$data = ['player' => $player];
		$this->render('player', $data);
	}

}