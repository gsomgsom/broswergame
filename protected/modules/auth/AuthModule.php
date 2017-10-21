<?php

class AuthModule extends CWebModule
{
	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Авторизация';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
