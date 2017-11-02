<?php

class AchievmentsController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Достижения';
		$data = [];
		$this->render('index', $data);
	}

}