<?php

class ShopController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Магазин';
		$this->render('index');
	}

}