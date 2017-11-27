<?php

class BattleController extends LoggedController
{
	public function actionIndex() {
		Yii::app()->params['pageTitle'] = 'Поединки';
		$data = [];
		$this->render('index', $data);
	}

	public function actionFind() {
		Yii::app()->params['pageTitle'] = 'Поиск соперника';
		
		$player = Player::model()->find(['condition' => 't.id not in ('.$this->user->player->id.')', 'order' => 'rand()']);

		if (empty($player))
			 throw new CHttpException(404);

		$data = ['player' => $player];
		$this->render('find', $data);
	}

	public function actionAttack() {
		Yii::app()->params['pageTitle'] = 'Лог боя';

		$html = ''; // пока бои в виде HTML, без логов

		$playerAtt = $this->user->player;

		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$playerDef = Player::model()->findByPk($id);

		if (empty($playerDef))
			 throw new CHttpException(404);

		$damageAtt = 0;
		$damageDef = 0;

		for($n=1; $n<=10; $n++) {
			$logStr = '';

			$html .= "<b>Раунд ".$n."</b><br>\n";

			$turnAtt = Formulas::countBattleTurn($playerAtt, $playerDef);
			$logStr .= $turnAtt['log'];
			$damageAtt += $turnAtt['damage'];

			$turnDef = Formulas::countBattleTurn($playerDef, $playerAtt);
			$logStr .= $turnDef['log'];
			$damageDef += $turnDef['damage'];

			$html .= $logStr;

			$html .= "<br>\n";
		}

		$html .= "<hr>\n";

		// Счётчик боёв для статистики
		$playerAtt->setStateIntVal('world_battle_count',
			$playerAtt->getStateIntVal('world_battle_count') + 1
		);
		$playerDef->setStateIntVal('world_battle_count',
			$playerDef->getStateIntVal('world_battle_count') + 1
		);

		$html .= "Счёт: <b>{$damageAtt}<b> : <b>{$damageDef}</b><br>\n";
		if ($damageAtt > $damageDef) {
			// Счётчик победных боёв для статистики
			$playerAtt->setStateIntVal('world_battle_win_count',
				$playerAtt->getStateIntVal('world_battle_win_count') + 1
			);
			// Счётчик проигрышных боёв для статистики
			$playerDef->setStateIntVal('world_battle_lose_count',
				$playerDef->getStateIntVal('world_battle_lose_count') + 1
			);

			$html .= "Победил: <b>".$playerAtt->nickname."</b><br>\n";
			$log_html_att = "Вы напали на <b>".$playerDef->nickname."</b> и <b style='color: green;'>победили</b>.<br>\n";
			$log_html_def = "На вас напал <b>".$playerAtt->nickname."</b> и <b style='color: red;'>победил</b>.<br>\n";

			// 2% exp
			$amountExp = ceil($playerAtt->expToLevelMax() * 0.02);
			$playerAtt->exp = $playerAtt->exp + $amountExp;
			$playerAtt->save();

			$log_html_att .= "Ваша награда: <b>{$amountExp}</b> {exp}";

			$html .= "В награду победитель получает: <b>{$amountExp}</b> {exp}";
		}
		elseif ($damageAtt < $damageDef) {
			// Счётчик проигрышных боёв для статистики
			$playerAtt->setStateIntVal('world_battle_lose_count',
				$playerAtt->getStateIntVal('world_battle_lose_count') + 1
			);
			// Счётчик победных боёв для статистики
			$playerDef->setStateIntVal('world_battle_win_count',
				$playerDef->getStateIntVal('world_battle_win_count') + 1
			);

			$html .= "Победил: <b>".$playerDef->nickname."</b><br>\n";
			$log_html_att = "Вы напали на <b>".$playerDef->nickname."</b> и <b style='color: red;'>проиграли</b>.<br>\n";
			$log_html_def = "На вас напал <b>".$playerAtt->nickname."</b> и <b style='color: green;'>проиграл</b>.<br>\n";
		}
		else {
			$html .= "<b>Ничья</b><br>\n";
			$log_html_att = "Вы напали на <b>".$playerDef->nickname."</b> и <b>никто</b> не победил.<br>\n";
			$log_html_def = "На вас напал <b>".$playerAtt->nickname."</b> и <b>никто</b> не победил.<br>\n";
		}

		// Логи и награждение
		Funcs::logMessage($log_html_att, 'war', $playerAtt->id);
		Funcs::logMessage($log_html_def, 'war', $playerDef->id);

		$data = [
			'html' => Funcs::applyCodes($html),
		];

		$this->render('attack', $data);
	}

	public function actionLog() {
		Yii::app()->params['pageTitle'] = 'Лог боя';
		Yii::app()->user->setFlash('error', Yii::t('error', '__not_implemented'));
		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->redirect('/player');
		}
	}

}