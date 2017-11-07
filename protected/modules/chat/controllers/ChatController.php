<?php

class ChatController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Чат';
		$data = [];
		$this->render('index', $data);
	}

}