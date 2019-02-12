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

	// Бой с игроком
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

		$playerAtt->hp -= $damageDef;
		if ($playerAtt->hp < 0)
			$playerAtt->hp = 0;
		$playerAtt->save();
		$playerDef->hp -= $damageAtt;
		if ($playerDef->hp < 0)
			$playerDef->hp = 0;
		$playerDef->save();

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

			// 2 exp
			$amountExp = 2 * Yii::app()->params['player_exp_rate']; // если надо 2%, то это будет: ceil($playerAtt->expToLevelMax() * 0.02);
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
			'attacker' => $playerAtt,
			'defender' => $playerDef,
			'html' => Funcs::applyCodes($html),
		];

		$this->render('attack', $data);
	}

	// Бой с мобом
	public function actionBot() {
		Yii::app()->params['pageTitle'] = 'Лог боя';

		$html = ''; // пока бои в виде HTML, без логов

		$playerAtt = $this->user->player;

		// Создаём бота со статами 50-150% от статов игрока
		$playerDef = new Player;
		$playerDef->lvl = $playerAtt->lvl;
		$playerDef->exp = $playerAtt->exp;
		$playerDef->nickname = 'Неразумная тварь';
		$str = $playerAtt->str;
		$minStr = ($str / 100) * 50;
		$maxStr = ($str / 100) * 150;
		$playerDef->str = rand(round($minStr), round($maxStr));
		$def = $playerAtt->def;
		$minDef = ($def / 100) * 50;
		$maxDef = ($def / 100) * 150;
		$playerDef->def = rand(round($minDef), round($maxDef));
		$dex = $playerAtt->dex;
		$minDex = ($dex / 100) * 50;
		$maxDex = ($dex / 100) * 150;
		$playerDef->dex = rand(round($minDex), round($maxDex));
		$sta = $playerAtt->sta;
		$minSta = ($sta / 100) * 50;
		$maxSta = ($sta / 100) * 150;
		$playerDef->sta = rand(round($minSta), round($maxSta));
		$int = $playerAtt->int;
		$minInt = ($int / 100) * 50;
		$maxInt = ($int / 100) * 150;
		$playerDef->int = rand(round($minInt), round($maxInt));

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

		$playerAtt->hp -= $damageDef;
		if ($playerAtt->hp < 0)
			$playerAtt->hp = 0;
		$playerAtt->save();

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

			// 1 exp
			$amountExp = 1 * Yii::app()->params['player_exp_rate']; // если надо 2%, то это будет: ceil($playerAtt->expToLevelMax() * 0.02);
			$playerAtt->exp = $playerAtt->exp + $amountExp;
			$playerAtt->save();

			$log_html_att .= "Ваша награда: <b>{$amountExp}</b> {exp}";

			$drop_html = [];
			if ((rand(0, 100) / 100) < 0.05) { // 5% шанс дропа желудей
				$nuts = rand(1 * $playerAtt->lvl, 3 * $playerAtt->lvl);
				$drop_html []= '<b>'.$nuts.'</b> {nuts} <b>'.Funcs::declination($nuts,'жёлудь','жёлудя','желудей').'</b>';
				$playerAtt->nuts += $nuts;
				$playerAtt->save();
			}
			if ((rand(0, 100) / 100) < 0.05) { // 5% шанс дропа ветоши
				// Выдаём предмет с id = 18 (Ветошь новобранца)
				$itemEntry = Item::model()->findByPk(18);
				$drop_html []= $itemEntry->getLogText(1);
				$playerAtt->addItem(18, 1);
			}
			if ((rand(0, 100) / 100) < 0.10) { // 10% шанс дропа красного зелья
				// Выдаём предмет с id = 2 (Красное зелье)
				$itemEntry = Item::model()->findByPk(2);
				$drop_html []= $itemEntry->getLogText(1);
				$playerAtt->addItem(2, 1);
			}
			$drop_info = '';
			if (sizeof($drop_html))
				$drop_info = '<br>Обшаривая тварь, вы наткнулись на: '.implode(', ', $drop_html);
			$log_html_att .= $drop_info;

			$html .= "В награду победитель получает: <b>{$amountExp}</b> {exp}";
			$html .= $drop_info;
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

		$data = [
			'attacker' => $playerAtt,
			'defender' => $playerDef,
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