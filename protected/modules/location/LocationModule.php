<?php

class LocationModule extends CWebModule
{
	public $defaultController = 'search';

	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Локация';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
