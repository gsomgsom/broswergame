<?php

class LastLog extends CWidget {
    public function run() {
		$log = Yii::app()->getController()->user->player->log(['limit'=>'10', 'order' => 'id DESC']);
		$data = ['log' => $log];
		echo $this->render('/lastlog', $data);
    }
}