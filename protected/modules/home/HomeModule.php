<?php

class HomeModule extends CWebModule
{
	public $defaultController = 'player';

	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Персонаж';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
		$this->setImport([
			'application.models.*',
			'home.models.*',
			'home.controllers.*',
		]);
	}

}
