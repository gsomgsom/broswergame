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
	public function useItem($player_item, $amount) {
		if (parent::useItem($player_item, $amount)) {
			Yii::app()->user->setFlash('error', null);

			$drop = [];
			$drop_html = [];
			if (rand(0, 1)) {
				$drop['coins'] = rand(3000 * $player_item->player->lvl, 5000 * $player_item->player->lvl);
				$drop_html []= '<b>'.$drop['coins'].'</b> {coins} <b>'.Funcs::declination($drop['coins'],'монета','монеты','монет').'</b>';
				$player_item->player->coins += $drop['coins'];
			}
			if (rand(0, 1)) {
				$drop['nuts'] = rand(1 * $player_item->player->lvl, 3 * $player_item->player->lvl);
				$drop_html []= '<b>'.$drop['nuts'].'</b> {nuts} <b>'.Funcs::declination($drop['nuts'],'жёлудь','жёлудя','желудей').'</b>';
				$player_item->player->nuts += $drop['nuts'];
			}
			if (!rand(0, 9)) {
				$drop['mushrooms'] = rand(1, 2);
				$drop_html []= '<b>'.$drop['mushrooms'].'</b> {mushrooms} <b>'.Funcs::declination($drop['mushrooms'],'гриб','гриба','грибов').'</b>';
				$player_item->player->mushrooms += $drop['mushrooms'];
			}
			$player_item->player->save();
			$items = [];
			if (rand(0, 1)) {
				$items_drop = [2,3,4,5,6,7,8,13]; // id предметов, которые могут выпасть
				shuffle($items_drop);
				for ($i=0; $i<rand(0, 2); $i++) {
					$item = ['id' => array_shift($items_drop), 'amount' => 1];
					$itemEntry = Item::model()->findByPk($item['id']);
					$drop_html []= $itemEntry->getLogText(1);
					$items []= $item;
					$player_item->player->addItem($item['id'], $item['amount']);
				}
			}

			// Игровое событие: Осень - листья падают?
			if (Yii::app()->params['game_event_autumn_leaves']) {
				if (rand(0, 2) == 0) { // 33%
					$r = rand(0,3);

					if ($r == 0) { // 25%
						// Выдаём x1 предметов с id = 14 (Зелёный лист)
						$item = ['id' => 14, 'amount' => 1];
						$itemEntry = Item::model()->findByPk($item['id']);
						$drop_html []= $itemEntry->getLogText(1);
						$items []= $item;
						$player_item->player->addItem($item['id'], $item['amount']);
					}
					elseif ($r == 1) { // 25%
						// Выдаём x1 предметов с id = 15 (Красный лист)
						$item = ['id' => 15, 'amount' => 1];
						$itemEntry = Item::model()->findByPk($item['id']);
						$drop_html []= $itemEntry->getLogText(1);
						$items []= $item;
						$player_item->player->addItem($item['id'], $item['amount']);
					}
					elseif ($r == 2) { // 25%
						// Выдаём x1 предметов с id = 15 (Красный лист)
						$item = ['id' => 16, 'amount' => 1];
						$itemEntry = Item::model()->findByPk($item['id']);
						$drop_html []= $itemEntry->getLogText(1);
						$items []= $item;
						$player_item->player->addItem($item['id'], $item['amount']);
					}
					else { // 25%
						// Выдаём x1 предметов с id = 16 (Мёртвый лист)
						$item = ['id' => 17, 'amount' => 1];
						$itemEntry = Item::model()->findByPk($item['id']);
						$drop_html []= $itemEntry->getLogText(1);
						$items []= $item;
						$player_item->player->addItem($item['id'], $item['amount']);
					}
				}
			}

			$drop['items'] = $items;

			Yii::app()->user->setFlash('success', Yii::t('success', '__item_box_test__used'));

			if (sizeof($drop_html)) {
				$log_html = Yii::t('success', '__item_box_test__used_loot', [
					'{loot}' => implode(', ', $drop_html),
				]);
			}
			else {
				$log_html = Yii::t('success', '__item_box_test__used_no_loot');
			}

			// Запись в логе об этом безобразии
			Funcs::logMessage($log_html, 'resources');

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
