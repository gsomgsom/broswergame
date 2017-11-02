<?php

class SkilltreeController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Дерево умений';
		$data = [];
		$this->render('index', $data);
	}

}