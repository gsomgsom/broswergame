<?php

class MailModule extends CWebModule
{
	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Почта';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
