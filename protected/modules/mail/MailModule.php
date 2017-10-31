<?php

class MailModule extends CWebModule
{
	public $defaultController = 'log';

	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Почта';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
