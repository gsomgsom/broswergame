<?php

class ScoutController extends LoggedController
{
	// Локация
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Разведка';
		$this->render('index');
	}

	// Разведка по времени
	public function actionGo() {
		$time = (int)Funcs::get($_GET, 'time', Yii::app()->params['location_scout_time']);
		if ($time < Yii::app()->params['location_scout_time'])
			$time = Yii::app()->params['location_scout_time'];
		$scoutsLeft = $this->user->player->getStateIntVal('scouts_left') * 60;

		if ($scoutsLeft < $time) {
			Yii::app()->user->setFlash('error', Yii::t('error', '__scout_controller__not_today'));
		}
		elseif ($this->user->player->isWorking()) {
			Yii::app()->user->setFlash('error', Yii::t('error', '__already_working'));
		}
		else {
			$t = strtotime(date('Y-m-d H:i', time()));
			$this->user->player->setStateCooldown('scout', $t + $time);
			$this->user->player->setStateVal('scout', $time, true);
			$scoutsLeft = ($scoutsLeft - $time) / 60;
			if (!$scoutsLeft) $scoutsLeft = 0;
			$this->user->player->setStateIntVal('scouts_left', $scoutsLeft);
			Yii::app()->user->setFlash('success', Yii::t('success', '__scout_controller__goodluck'));
		}

		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/location/scout');
		}
	}

	// Прекратить поиски
	public function actionCancel() {
		$scoutVal = $this->user->player->getStateVal('scout');
		if (!is_null($scoutVal)) {
			$this->user->player->setStateVal('scout', null);
			$this->user->player->setStateCooldown('scout', null, false);
			Yii::app()->user->setFlash('success', Yii::t('success', 'Внезапно вспомнив про очень важные дела вы прервали разведку.'));
		}
		else {
			Yii::app()->user->setFlash('error', Yii::t('error', 'Вы и так ничего не рвзведываете.'));
		}

		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/location/scout');
		}
	}

}