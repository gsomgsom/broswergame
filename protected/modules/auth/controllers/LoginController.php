<?php

/**
 * Контроллер "LoginController"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Авторизация в игре
 */

class LoginController extends CController
{

	/**
	 * Форма авторизации
	 */
	public function actionIndex() {
		if (!Yii::app()->user->isGuest)
			$this->redirect('/home');

		$this->layout = 'guest';

		$model = new LoginForm;

		// AJAX запрос валидации?
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['LoginForm'])) {
			$model->attributes=$_POST['LoginForm'];
			if ($model->validate() && $model->login())
				$this->redirect('/home');
		}

		$this->render('index', ['model' => $model]);
	}

	/**
	 * Логаут
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect("/");
	}

}