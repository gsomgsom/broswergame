<?php

class WorldModule extends CWebModule
{
	public $defaultController = 'battle';

	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Мир';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
