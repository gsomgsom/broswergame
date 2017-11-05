<?php

class UsersettingsController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Аккаунт';
		$data = [];
		$model = new EmailForm;

		// AJAX запрос валидации?
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'account-email-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['EmailForm'])) {
			$model->attributes=$_POST['EmailForm'];
			if ($model->validate()) {
				$this->user->email = $model->email;
				$this->user->save();
				Yii::app()->user->setFlash('success', Yii::t('success', 'Новый адрес E-mail успешно сохранён.'));
			}
		}

		$data['model'] = $model;
		$this->render('index', $data);
	}

}