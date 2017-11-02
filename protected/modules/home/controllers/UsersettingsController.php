<?php

class UsersettingsController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Аккаунт';
		$data = [];
		$this->render('index', $data);
	}

}