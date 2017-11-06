<?php

/**
 * Модель "ItemBoxTest"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Подарок альфа-тестеру - тестовый контейнер с лутом
 */

class ItemBoxTest extends Item {

	/**
	 * Использование предмета
	 * @return array
	 */
	public function use($player_item, $amount) {
		if (parent::use($player_item, $amount)) {
			Yii::app()->user->setFlash('error', null);

			$drop = [];
			$drop_html = [];
			if (rand(0, 1)) {
				$drop['coins'] = rand(3000 * $player_item->player->lvl, 5000 * $player_item->player->lvl);
				$drop_html []= '<b>'.$drop['coins'].'</b> <img src="/assets/img/coins16.png" title="монеты"> <b>'.Funcs::declination($drop['coins'],'монета','монеты','монет').'</b>';
				$player_item->player->coins += $drop['coins'];
			}
			if (rand(0, 1)) {
				$drop['nuts'] = rand(1 * $player_item->player->lvl, 3 * $player_item->player->lvl);
				$drop_html []= '<b>'.$drop['nuts'].'</b> <img src="/assets/img/nuts16.png" title="жёлуди"> <b>'.Funcs::declination($drop['nuts'],'жёлудь','жёлудя','желудей').'</b>';
				$player_item->player->nuts += $drop['nuts'];
			}
			if (!rand(0, 9)) {
				$drop['mushrooms'] = rand(1, 2);
				$drop_html []= '<b>'.$drop['mushrooms'].'</b> <img src="/assets/img/mushrooms16.png" title="волшебные грибы"> <b>'.Funcs::declination($drop['mushrooms'],'гриб','гриба','грибов').'</b>';
				$player_item->player->mushrooms += $drop['mushrooms'];
			}
			$player_item->player->save();
			$items = [];
			if (rand(0, 1)) {
				$items_drop = [2,3,4,5,6,7,8]; // id предметов, которые могут выпасть
				shuffle($items_drop);
				for ($i=0; $i<rand(0, 2); $i++) {
					$item = ['id' => array_shift($items_drop), 'amount' => 1];
					$itemEntry = Item::model()->findByPk($item['id']);
					$drop_html []= '<img src="/assets/img/item16.png" title="предмет"> <b>'.$itemEntry->name.'</b>';
					$items []= $item;
					$player_item->player->addItem($item['id'], $item['amount']);
				}
			}
			$drop['items'] = $items;

			Yii::app()->user->setFlash('success', Yii::t('success', 'Вы открыли подарок тестера!'));

			// Запись в логе об этом безобразии
			$logType = LogType::model()->findByAttributes(['alias' => 'resources']);
			$logEntry = new PlayerLog();
			$logEntry->dt = date('Y-m-d H:i:s', time());
			if (!empty($logType))
				$logEntry->type_id = $logType->id;
			$logEntry->player_id = $player_item->player->id;
			if (sizeof($drop_html)) {
				$logEntry->html = 'Вы открыли подарок, и обнаружили там: '.implode(', ', $drop_html);
			}
			else {
				$logEntry->html = 'Вы открыли подарок, но он оказался совсем пустой. Дурак тот дядя. И шутки у него дурацкие.';
			}
			$logEntry->save();

			// Окно с контейнером @TODO
			//$opendrop = $this->renderPartial('opendrop', [
			//	'class' => 'alphabag',
			//	'title' => 'Подарок альфа тестеру',
			//	'text' => 'Развязав узелок у <b>мешочка</b> и заглянув в него, вы обнаружили:',
			//	'drop' => $drop,
			//], true);
			//Yii::app()->user->setFlash('opendrop', $opendrop);

			return true;
		}
		else
			return false;
	}

}
