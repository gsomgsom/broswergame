<?php

class TestController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Тестовый контроллер';
		$data = [];
		$this->render('index', $data);
	}

}