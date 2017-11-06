<?php

class ForumController extends LoggedController
{
	//public $layout = 'main';

	public function actionIndex()
	{
		$params = [];

		$this->render('index', $params);
	}
}