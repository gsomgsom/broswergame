<?php

class ReadController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Новости';
		$params = [];
		$params['news'] = News::model()->publicated()->sorted()->findAll();
		$this->render('index', $params);
	}

	public function actionEntry() {
		Yii::app()->params['pageTitle'] = 'Новостная запись';
		$params = [];
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$newsEntry = News::model()->publicated()->findByPk($id);
		if (empty($newsEntry))
			 throw new CHttpException(404);
		Yii::app()->params['pageTitle'] = $newsEntry->title;
		$params['newsEntry'] = $newsEntry;
		$this->render('entry', $params);
	}

}