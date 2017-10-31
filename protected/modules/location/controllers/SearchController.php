<?php

class SearchController extends LoggedController
{
	// Локация
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Поиск желудей';
		$this->render('index');
	}

	// Быстрый поиск желудей
	public function actionFast() {
		$searchVal = $this->user->player->getStateVal('search');
		if (!is_null($searchVal)) {
			Yii::app()->user->setFlash('error', Yii::t('error', 'Вы уже заняты поиском.'));
		}
		else {
			$time = strtotime(date('Y-m-d H:i', time()));
			$this->user->player->setStateCooldown('search', $time + 10 * 60);
			$this->user->player->setStateVal('search', 'fast', true);
			Yii::app()->user->setFlash('success', Yii::t('success', 'Удачи в поисках!'));
		}

		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/location/search');
		}
	}

	// Долгий поиск желудей
	public function actionLong() {
		$searchVal = $this->user->player->getStateVal('search');
		if (!is_null($searchVal)) {
			Yii::app()->user->setFlash('error', Yii::t('error', 'Вы уже заняты поиском.'));
		}
		else {
			$time = strtotime(date('Y-m-d H:i', time()));
			$this->user->player->setStateCooldown('search', $time + 60 * 60);
			$this->user->player->setStateVal('search', 'long', true);
			Yii::app()->user->setFlash('success', Yii::t('success', 'Удачи в поисках!'));
		}

		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/location/search');
		}
	}

	// Прекратить поиски
	public function actionCancel() {
		$searchVal = $this->user->player->getStateVal('search');
		if (!is_null($searchVal)) {
			$this->user->player->setStateVal('search', null);
			$this->user->player->setStateCooldown('search', null, false);
			Yii::app()->user->setFlash('success', Yii::t('success', 'Внезапно вспомнив про очень важные дела вы прервали поиск.'));
		}
		else {
			Yii::app()->user->setFlash('error', Yii::t('error', 'Вы и так ничего не ищете.'));
		}

		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/location/search');
		}
	}

}