<?php

class LogController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Журнал';
		$type_id = 0;
		if (isset($_GET['type'])) {
			$logType = LogType::model()->visibled()->findByAttributes(['alias' => $_GET['type']]);
			if (!empty($logType))
				$type_id = $logType->id;
		}
		if ($type_id) {
			$log = Yii::app()->getController()->user->player->log(['condition' => 'type_id = :type', 'params' => ['type' => $type_id], 'limit'=>'1000', 'order' => 'id DESC']);
		}
		else {
			$log = Yii::app()->getController()->user->player->log([
				'with' => 'type',
				'condition' => 'type.visible = 1',
				'limit'=>'1000',
				'order' => 'log.id DESC',
			]);
		}
		$data = [
			'log' => $log,
			'logTypes' => LogType::model()->visibled()->findAll(),
			'logTypeID' =>$type_id,
		];
		$this->render('index', $data);
	}

}