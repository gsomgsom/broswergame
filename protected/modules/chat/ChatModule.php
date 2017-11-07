<?php

class ChatModule extends CWebModule
{
	public $defaultController = 'chat';

	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Чат';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
