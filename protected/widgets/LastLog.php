<?php

class LastLog extends CWidget {
    public function run() {
		$log = Yii::app()->getController()->user->player->log([
			'with' => 'type',
			'condition' => 'type.visible = 1',
			'limit' => '10',
			'order' => 'log.id DESC',
		]);
		$data = ['log' => $log];
		echo $this->render('/lastlog', $data);
    }
}