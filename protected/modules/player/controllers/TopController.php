<?php

class TopController extends LoggedController
{
	public function actionMight() {
		Yii::app()->params['pageTitle'] = 'Рейтинг влияния';

		$players = Player::model()->sortedByMight()->findAll();

		$data = ['players' => $players];
		$this->render('might', $data);
	}

}