<?php

class WheelController extends LoggedController
{

	public $wheel = [	// призы в колесе
		[
			'id' => 1,
			'amount' => 10,
		],
		[
			'id' => 2,
			'amount' => 10,
		],
		[
			'id' => 3,
			'amount' => 10,
		],
		[
			'id' => 12,
			'amount' => 1,
		],
		[
			'id' => 9,
			'amount' => 10,
		],
		[
			'id' => 10,
			'amount' => 1,
		],
		[
			'id' => 11,
			'amount' => 1,
		],
		[
			'id' => 13,
			'amount' => 5,
		],
	];

	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Колесо фортуны';
		$data = [];
		$data['wheel'] = $this->wheel;
		$this->render('index', $data);
	}

	// Крутим колесо
	public function actionRoll() {
		if ($this->user->player->nuts < Yii::app()->params['location_wheel']) {
			Yii::app()->user->setFlash('error', Yii::t('error', 'Надуть хотите? А жёлуди?!'));
			Funcs::logMessage('Крутим колесо. Не хватает на кручение.');
		}
		else {
			Yii::app()->user->setFlash('success', Yii::t('success', 'Вы крутите колесо и с замиранеим смотрите на стрелку. Итак...'));

			// Определяем приз
			$prize = $this->wheel[rand(0, 7)];
			Yii::app()->getController()->user->player->addItem($prize['id'], $prize['amount']);
			$itemEntry = Item::model()->findByPk($prize['id']);
			$amountText = '';
			if ($prize['amount'] > 1) {
				$amountText = ' (<strong>'.$prize['amount'].'</strong>)';
			}
			$drop_html = '<img src="/assets/img/'.$itemEntry->img.'16.png" title="предмет"> <b>'.$itemEntry->name.'</b>'.$amountText.'';

			// Списываем стоимость кручения
			Yii::app()->getController()->user->player->nuts -= Yii::app()->params['location_wheel'];
			Yii::app()->getController()->user->player->save();

			// Счётчик кручений для статистики
			$this->user->player->setStateIntVal('location_wheel_roll_count',
				$this->user->player->getStateIntVal('location_wheel_roll_count') + 1
			);

			Funcs::logMessage('Крутим колесо. Счастливая рука выкрутила приз: '.$drop_html, 'actions');
		}

		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/location/wheel');
		}
	}

}