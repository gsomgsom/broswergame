<?php

class DefaultController extends LoggedController
{
	public function actionIndex() {
		$this->redirect('/news/read');
	}

}