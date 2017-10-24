<?php

class LogType extends CActiveRecord {

	public function tableName() {
		return '{{log_types}}';
	}

	public function rules() {
		return [
			['alias, title', 'safe'],
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
