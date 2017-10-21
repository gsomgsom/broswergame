<?php

class DefaultController extends LoggedController
{
	public function actionIndex() {
		$this->render('index');
	}

}