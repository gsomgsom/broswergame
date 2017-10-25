<?php

class DefaultController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Почта';
		$this->render('index');
	}

}