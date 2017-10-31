<?php

class PlayerItems extends CActiveRecord {
	public function tableName() {
		return '{{player_items}}';
	}

	public function rules() {
		return [
			['player_id, item_id, amount, quality, lvl, variant', 'safe'],
		];
	}

	public function relations() {
		return [
			'player' => [self::BELONGS_TO, 'Player', 'player_id'],
			'item' => [self::BELONGS_TO, 'Item', 'item_id'],
		];
	}

	public function attributeLabels() {
		return [
			'id' => 'id',
		];
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return [
			'sorted' => ['order' => 'item_id ASC'],
		];
	}

	public function beforeSave() {
		if (parent::beforeSave()) {
			// @TODO
			return true;
		}
		else
			return false;
	}

}
