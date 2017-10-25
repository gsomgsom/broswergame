<?php

class PlayerState extends CActiveRecord {

	public function tableName() {
		return '{{player_states}}';
	}

	public function rules() {
		return [
			['player_id, alias, state_int, state_text, cooldown', 'safe'],
		];
	}

	public function relations() {
		return [
			'player' => [self::BELONGS_TO, 'Player', 'player_id'],
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

}
