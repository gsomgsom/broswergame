<?php

class PlayerLog extends CActiveRecord {

	public function tableName() {
		return '{{player_logs}}';
	}

	public function rules() {
		return [
			['dt, html', 'safe'],
		];
	}

	public function relations() {
		return [
			'player' => [self::HAS_ONE, 'Player', ['player_id' => 'id']],
			'type' => [self::HAS_ONE, 'LogType', ['type_id' => 'id']],
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
