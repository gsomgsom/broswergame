<?php

class PlayerTimers extends CWidget {
    public function run() {
		$timers = [];
		$timers[]= [
			'title' => 'Работа',
			'alias' => 'work',
			'cooldown' => Yii::app()->getController()->user->player->getGlobalStateCooldown(),
		];
		$data = ['timers' => $timers];
		echo $this->render('/playertimers', $data);
    }
}