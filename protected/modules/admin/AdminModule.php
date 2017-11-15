<?php

class AdminModule extends CWebModule
{
	public $defaultController = 'dashboard';

	public function init()
	{
		// не авторизованным юзерам следует авторизоваться
		if (Yii::app()->user->isGuest) {
			$this->redirect('/');
		}
		$user = User::model()->findByPk(Yii::app()->user->id);

		if (empty($user) || ($user->role !== 'admin'))
			 throw new CHttpException(403);

		Yii::app()->params['pageTitle'] = 'Админ-панель';
		$this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
		$this->layout = 'admin';
		$this->setImport([
			'application.components.*',
			'application.models.*',
			'admin.controllers.*',
			'admin.views.*',
		]);
	}

}
