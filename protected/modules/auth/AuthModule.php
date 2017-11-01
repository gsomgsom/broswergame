<?php

/**
 * Модуль "AuthModule"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Авторизация, регистрация, восстановление забытого пароля
 */

class AuthModule extends CWebModule
{
	public $defaultController = 'login';

	public function init()
	{
		Yii::app()->params['pageTitle'] = 'Авторизация';
		$this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
		$this->layout = 'default';
		$this->setImport([
			'application.models.*',
			'auth.models.*',
			'auth.controllers.*',
		]);
	}

}
