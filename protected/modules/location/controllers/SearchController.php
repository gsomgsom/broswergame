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
		if ($this->user->player->isWorking()) {
			Yii::app()->user->setFlash('error', Yii::t('error', '__already_working'));
		}
		else {
			$time = strtotime(date('Y-m-d H:i', time()));
			$this->user->player->setStateCooldown('search', $time + Yii::app()->params['location_search_fast']);
			$this->user->player->setStateVal('search', 'fast', true);
			Yii::app()->user->setFlash('success', Yii::t('success', '__search_controller__goodluck'));
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
		if ($this->user->player->isWorking()) {
			Yii::app()->user->setFlash('error', Yii::t('error', '__already_working'));
		}
		else {
			$time = strtotime(date('Y-m-d H:i', time()));
			$this->user->player->setStateCooldown('search', $time + Yii::app()->params['location_search_long']);
			$this->user->player->setStateVal('search', 'long', true);
			Yii::app()->user->setFlash('success', Yii::t('success', '__search_controller__goodluck'));
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