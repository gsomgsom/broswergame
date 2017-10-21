<?php

class News extends CActiveRecord {

	public function tableName() {
		return '{{news}}';
	}

	public function rules() {
		return [
			['publicated, alias, dt, title, content', 'safe'],
		];
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return [
			'sorted' => ['order' => 't.dt DESC, t.id DESC'],
			'visible' => ['condition' => 't.publicated = 1'],
		];
	}

}
