<?php

class TopicsController extends LoggedController
{
	public function actionView()
	{
		echo Debug::vars($_GET); die;
	}
}