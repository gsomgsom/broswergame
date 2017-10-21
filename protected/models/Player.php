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
			'user' => [self::HAS_ONE, 'User', ['user_id' => 'id']],
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
