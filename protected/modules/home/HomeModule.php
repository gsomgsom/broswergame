<?php

class HomeModule extends CWebModule
{
	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Персонаж';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
