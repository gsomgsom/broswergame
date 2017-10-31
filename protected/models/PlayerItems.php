<?php

/**
 * Модель "PlayerItems"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Предметы персонажа. Экземпляры предметов, их свойства.
 */

class PlayerItems extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{player_items}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['player_id, item_id, amount, quality, lvl, variant', 'safe'],
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [
			'player' => [self::BELONGS_TO, 'Player', 'player_id'],
			'item' => [self::BELONGS_TO, 'Item', 'item_id'],
		];
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
			'sorted' => ['order' => 'item_id ASC'],
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

}
