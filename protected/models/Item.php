<?php

/**
 * Модель "Item"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Предмет. Всё что связано с предметами и действиями над ним.
 */

class Item extends CActiveRecord {
	// Качество предметов - значения кодов
	const QUALITY_INFINITY         = 5;
	const QUALITY_DURABLE          = 4;
	const QUALITY_BAD              = 3;
	const QUALITY_NORMAL           = 2;
	const QUALITY_GOOD             = 1;
	const QUALITY_POOR             = 0;

	// Качество предметов - названия
	const QUALITY_INFINITY_TEXT    = 'бесконечный';
	const QUALITY_DURABLE_TEXT     = 'теряющий прочность';
	const QUALITY_BAD_TEXT         = 'утерян';
	const QUALITY_NORMAL_TEXT      = 'средний';
	const QUALITY_GOOD_TEXT        = 'отличный';
	const QUALITY_POOR_TEXT        = 'непригодный';

	// Качество предметов - цвета
	const QUALITY_INFINITY_COLOR   = '#656565';
	const QUALITY_DURABLE_COLOR    = '#006789';
	const QUALITY_BAD_COLOR        = '#a43c20';
	const QUALITY_NORMAL_COLOR     = '#7c8700';
	const QUALITY_GOOD_COLOR       = '#007208';
	const QUALITY_POOR_COLOR       = '#525252';

	/**
	 * Название таблицы в БД
	 * @return string

	 */
	public function tableName() {
		return '{{items}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['name', 'safe'],				// название предмета
			['php_class', 'safe'],			// php - класс, в котором описано поведение предмета (use, unuse, sell, buy, loot...)
			['img', 'safe'],				// картинка (возможно при компиляции спрайтов будет означать класс картинки)
			['description', 'safe'],		// текстовое описание
			['notice', 'safe'],				// примечание к описанию (выводится курсивом), обычно пусто
			['use_text', 'safe'],			// текст на кнопке "открыть", "выпить", и т.д.
			['use_link', 'safe'],			// ссылка на использование, как правило ссылка на локацию или null
			['bag', 'safe'],				// отдел сумки, где лежит
			['class', 'safe'],				// css - класс
			['required_lvl', 'safe'],		// требуемый уровень для пользования предметом
			['use_stack', 'safe'],			// за раз используется use_stack предметов
			['stack', 'safe'],				// предметов в стопке (если предмет не собирается в стопке, то 1)
			['bag_limit', 'safe'],			// лимит предметов в сумке у игрока
			['nosell', 'safe'],				// предмет не подлежит продаже
			['default_quality', 'safe'],	// качество предмета по-умолчанию (при первом получении игроком)
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [];
	}

	/**
	 * Названия полей таблицы
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'id' => 'id',
		];
	}

	/**
	 * Возвращает экземпляр себя
	 * @return CActiveRecord объект модели
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Описывает скоупы (scopes), сокращения предустановок выборки
	 * @return array
	 */
	public function scopes() {
		return [
			'sorted' => ['order' => 'id ASC'],
		];
	}

	/**
	 * Действие перед сохранением в БД
	 * @return bool
	 */
	public function beforeSave() {
		if (parent::beforeSave()) {
			// @TODO
			return true;
		}
		else
			return false;
	}

	/**
	 * Возвращает качество предметов по значению кода $quality, атрибут HTML "sytle'
	 * @quality integer Код качества предмета
	 * @return string
	 */
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

	/**
	 * Возвращает качество предметов, по значению кода $quality, текст
	 * @quality integer Код качества предмета
	 * @return string
	 */
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

	/**
	 * Использование предмета
	 * В наследующихся классах требуется описать действие по 'use'
	 * @return array
	 */
	public function use($player_item) {
		if ($player_item->amount >= $player_item->item->use_stack) {
			$player_item->player->removeItem($player_item->item_id, $player_item->item->use_stack);
			Yii::app()->user->setFlash('error', 'Ничего не произошло.');
			return true;
		}
		else {
			Yii::app()->user->setFlash('error', 'Маловато будет. Требуется '.$player_item->item->use_stack.' шт.');
			return false;
		}
		return true;
	}

}
