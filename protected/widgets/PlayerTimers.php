<?php

class PlayerTimers extends CWidget {
    public function run() {
		$timers = [];
		$timers[]= [
			'title' => 'Поиск желудей',
			'alias' => 'search',
			'cooldown' => Yii::app()->getController()->user->player->getStateCooldown('search'),
		];
		$timers[]= [
			'title' => 'Охота',
			'alias' => 'hunt',
			'cooldown' => Yii::app()->getController()->user->player->getStateCooldown('hunt'),
		];
		$data = ['timers' => $timers];
		echo $this->render('/playertimers', $data);
    }
}