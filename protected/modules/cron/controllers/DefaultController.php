<?php

class DefaultController extends CController
{
	// Заглушка
	public function actionIndex() {
		echo "Это не работает так.";
		Yii::app()->end();
	}

}