<?php

class SettingsController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Настройки';
		$data = [];
		$this->render('index', $data);
	}

}