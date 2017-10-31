<?php

class Item extends CActiveRecord {
	const QUALITY_INFINITY         = 5;
	const QUALITY_DURABLE          = 4;
	const QUALITY_BAD              = 3;
	const QUALITY_NORMAL           = 2;
	const QUALITY_GOOD             = 1;
	const QUALITY_POOR             = 0;

	const QUALITY_INFINITY_TEXT    = 'бесконечный';
	const QUALITY_DURABLE_TEXT     = 'теряющий прочность';
	const QUALITY_BAD_TEXT         = 'утерян';
	const QUALITY_NORMAL_TEXT      = 'средний';
	const QUALITY_GOOD_TEXT        = 'отличный';
	const QUALITY_POOR_TEXT        = 'непригодный';

	const QUALITY_INFINITY_COLOR   = '#656565';
	const QUALITY_DURABLE_COLOR    = '#006789';
	const QUALITY_BAD_COLOR        = '#a43c20';
	const QUALITY_NORMAL_COLOR     = '#7c8700';
	const QUALITY_GOOD_COLOR       = '#007208';
	const QUALITY_POOR_COLOR       = '#525252';

	public function tableName() {
		return '{{items}}';
	}

	public function rules() {
		return [
			['name, img, description, notice, use_text, use_link, bag, class, required_lvl, use_stack, stack, bag_limit, nosell, default_quality', 'safe'],
		];
	}

	public function relations() {
		return [];
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
			'sorted' => ['order' => 'id ASC'],
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

	public static function getQualityStyle($quality) {
		if ($quality == self::QUALITY_POOR) {
			return ' style="color: '.self::QUALITY_POOR_COLOR.';"';
		}
		elseif ($quality == self::QUALITY_GOOD) {
			return ' style="color: '.self::QUALITY_GOOD_COLOR.';"';
		}
		elseif ($quality == self::QUALITY_NORMAL) {
			return ' style="color: '.self::QUALITY_NORMAL_COLOR.';"';
		}
		elseif ($quality == self::QUALITY_BAD) {
			return ' style="color: '.self::QUALITY_BAD_COLOR.';"';
		}
		elseif ($quality == self::QUALITY_DURABLE) {
			return ' style="color: '.self::QUALITY_DURABLE_COLOR.';"';
		}
		else {
			return '';
		}
	}

	public static function getQualityText($quality) {
		if ($quality == self::QUALITY_POOR) {
			return self::QUALITY_POOR_TEXT;
		}
		elseif ($quality == self::QUALITY_GOOD) {
			return self::QUALITY_GOOD_TEXT;
		}
		elseif ($quality == self::QUALITY_NORMAL) {
			return self::QUALITY_NORMAL_TEXT;
		}
		elseif ($quality == self::QUALITY_BAD) {
			return self::QUALITY_BAD_TEXT;
		}
		elseif ($quality == self::QUALITY_DURABLE) {
			return self::QUALITY_DURABLE_TEXT;
		}
		else {
			return self::QUALITY_INFINITY_TEXT;
		}
	}

}
