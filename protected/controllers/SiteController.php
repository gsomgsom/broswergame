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
		if (Yii::app()->user->isGuest)
			$this->redirect('/auth/login');
		else
			$this->redirect('/home');
	}

}
