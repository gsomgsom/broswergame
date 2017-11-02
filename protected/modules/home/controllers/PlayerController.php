<?php

class PlayerController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Персонаж';
		$data = [];
		$this->render('index', $data);
	}

}