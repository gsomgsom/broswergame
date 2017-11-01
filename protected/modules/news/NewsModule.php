<?php

/**
 * Модуль "NewsModule"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Новости
 */

class NewsModule extends CWebModule
{
	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Новости';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
	}

}
