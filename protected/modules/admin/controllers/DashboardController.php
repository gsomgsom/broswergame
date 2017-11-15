<?php

class DashboardController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Админ-панель';
		$data = [];
		$this->render('index', $data);
	}

}