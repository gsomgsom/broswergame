<?php

class StatsController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Статистика';
		$data = [];
		$this->render('index', $data);
	}

}