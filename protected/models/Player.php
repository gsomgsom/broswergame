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
			'user' => [self::BELONGS_TO, 'User', 'user_id'],
			'log' => [self::HAS_MANY, 'PlayerLog', ['player_id' => 'id']],
			'states' => [self::HAS_MANY, 'PlayerState', ['player_id' => 'id']],
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
		if (isset($params['state_int'])) {
			$stateEntry->state_int = (int)$params['state_int'];
		}
		if (isset($params['state_text'])) {
			$stateEntry->state_text = $params['state_text'];
		}
		if (isset($params['cooldown'])) {
			if (!is_null($params['cooldown'])) {
				$stateEntry->cooldown = date('Y-m-d H:i:s', $params['cooldown']);
			}
			else {
				$stateEntry->cooldown = null;
			}
		}
		$stateEntry->save();
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

}
