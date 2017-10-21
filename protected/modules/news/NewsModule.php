<?php

class NewsModule extends CWebModule
{
	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Новости';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
