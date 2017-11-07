<?php
class SiteController extends CController {
	public $layout = 'default';

	/**
	 * Обработчик ошибок
	 */
	public function actionError() {
		if ($error=Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			}
			else {
				$this->layout = 'error';
				$this->render('error', $error);
			}
		}
	}

	/**
	 * Индекс
	 */
	public function actionIndex() {
		if (Yii::app()->user->isGuest) {
			if (Yii::app()->params['constructionMode']) {
				$this->layout = 'construction';
				$model = new SigninForm;
				$sent = false;

				// AJAX запрос валидации?
				if (isset($_POST['ajax']) && $_POST['ajax'] === 'signin-form') {
					echo CActiveForm::validate($model);
					Yii::app()->end();
				}

				if (isset($_POST['SigninForm'])) {
					$model->attributes=$_POST['SigninForm'];
					if ($model->validate()) {
						MailMan::send(
							Yii::app()->params['adminEmail'],
							'Заявка на альфа тест игры',
							"Поступила заявка на тест игры.<br>\n<br>\nE-mail: {$model->email}",
							'smtp'
						);
						$sent = true;
					}
				}

				$this->render('construction', ['model' => $model, 'sent' => $sent]);
			}
			else {
				$this->redirect('/auth/login');
			}
		}
		else
			$this->redirect('/player');
	}

}
