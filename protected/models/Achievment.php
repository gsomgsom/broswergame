<?php

/**
 * Модель "Achievment"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Достижения.
 */

class Achievment extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{achievments}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['alias, title, requirement, rank, val, visible', 'safe'],
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
			'sorted' => ['order' => 't.id DESC'],
			'visibled' => ['condition' => 't.visible = 1'],
		];
	}

}
