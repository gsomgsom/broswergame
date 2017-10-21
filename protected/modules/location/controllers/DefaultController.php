<?php

class DefaultController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Пример локации';
		$this->render('index');
	}

}