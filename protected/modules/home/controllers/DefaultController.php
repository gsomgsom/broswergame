<?php

class DefaultController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Персонаж';
		$this->render('index');
	}

}