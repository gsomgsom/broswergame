<?php

class Player extends CActiveRecord {

	public function tableName() {
		return '{{players}}';
	}

	public function rules() {
		return [
			['nickname', 'required'],
			['nickname', 'unique'],
			['lvl, coins, nuts, mushrooms', 'safe'],
		];
	}

	public function relations() {
		return [
			'user'           => [self::BELONGS_TO, 'User', 'user_id'],
			'log'            => [self::HAS_MANY, 'PlayerLog', ['player_id' => 'id']],
			'states'         => [self::HAS_MANY, 'PlayerState', ['player_id' => 'id']],
			'player_items'   => [self::HAS_MANY, 'PlayerItems', 'player_id', 'order' => 'item_id'],
			'items'          => [self::HAS_MANY, 'Item', ['item_id' => 'id'], 'through' => 'player_items'],
		];
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return [
			'sorted' => ['order' => 't.id DESC'],
		];
	}

	public function getStateCooldown($alias) {
		$stateEntry = PlayerState::model()->findByAttributes(['player_id'=> $this->id, 'alias' => $alias]);
		if (!empty($stateEntry)) {
			return strtotime($stateEntry->cooldown);
		}
		return time()-10; // время из прошлого
	}

	public function getStateVal($alias) {
		$stateEntry = PlayerState::model()->findByAttributes(['player_id'=> $this->id, 'alias' => $alias]);
		if (!empty($stateEntry)) {
			return $stateEntry->state_text;
		}
		return null;
	}

	public function setStateParams($alias, $params = []) {
		$stateEntry = PlayerState::model()->findByAttributes(['player_id'=> $this->id, 'alias' => $alias]);
		if (empty($stateEntry)) {
			$stateEntry = new PlayerState;
			$stateEntry->player_id = $this->id;
			$stateEntry->alias = $alias;
		}
		if (in_array('state_int', array_keys($params))) {
			$stateEntry->state_int = (int)$params['state_int'];
		}
		if (in_array('state_text', array_keys($params))) {
			$stateEntry->state_text = $params['state_text'];
		}
		if (in_array('cooldown', array_keys($params))) {
			if (!is_null($params['cooldown'])) {
				$stateEntry->cooldown = date('Y-m-d H:i:s', $params['cooldown']);
			}
			else {
				$stateEntry->cooldown = null;
			}
		}
		$result = $stateEntry->save();
	}

	public function setStateCooldown($alias, $time = null) {
		$this->setStateParams($alias, ['cooldown' => $time]);
	}

	public function setStateVal($alias, $val = null) {
		$this->setStateParams($alias, ['state_text' => $val]);
	}

	public function getCoinsText() {
		return number_format($this->coins, 0, ' ', ' ');
	}

	public function getNutsText() {
		return number_format($this->nuts, 0, ' ', ' ');
	}

	public function getMushroomsText() {
		return number_format($this->mushrooms, 0, ' ', ' ');
	}

	public function addItem($item_id, $amount) {
		$item = Item::model()->findByPk($item_id);
		if (!empty($item)) {
			if ($item->bag_limit) {
				$old_amount = 0;
				$player_items = PlayerItems::model()->findByAttributes(['player_id' => $this->id, 'item_id' => $item_id]);
				if (!empty($player_items)) {
					$old_amount = $player_items->amount;
					$player_items->delete();
				}
				$player_items = new PlayerItems;
				$player_items->player_id = $this->id;
				$player_items->item_id = $item_id;
				$player_items->quality = Item::QUALITY_INFINITY;
				$player_items->amount = $amount + $old_amount;
				if ($player_items->amount > $item->bag_limit) {
					$player_items->amount = $item->bag_limit;
					Yii::app()->user->setFlash('error', Yii::t('error', 'нехватает места в рюкзаке при создании предмета'));
					// @TODO - пишем в лог и в сайдбар, что не вошло
				}
				$player_items->save();
			}
			else {
				// @TODO - проверка на свободность слотов
				$player_items = new PlayerItems;
				$player_items->player_id = $this->id;
				$player_items->item_id = $item_id;
				$player_items->quality = $item->default_quality;
				$player_items->amount = 1;
				$player_items->save();
			}
		}
	}

	public function removeItem($item_id, $amount) {
		$item = Item::model()->findByPk($item_id);
		if (!empty($item)) {
			$player_item = PlayerItems::model()->findByAttributes(['player_id' => $this->id, 'item_id' => $item_id]);
			if (!empty($player_item)) {
				$player_item->amount -= $amount;
				if (!$player_item->amount) {
					$player_item->delete();
				}
				else {
					$player_item->save();
				}
			}
		}
	}

}
