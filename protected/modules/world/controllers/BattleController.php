<?php

class BattleController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Бой';
		Yii::app()->user->setFlash('error', Yii::t('error', 'Make love, not war!'));
		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/player');
		}
	}

	public function actionLog() {
		Yii::app()->params['pageTitle'] = 'Лог боя';
		Yii::app()->user->setFlash('error', Yii::t('error', 'Не реализовано ;-('));
		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/player');
		}
	}

}