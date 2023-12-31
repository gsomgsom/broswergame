<?php

/**
 * Модель "LogType"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Справочник типов записей в журнале.
 */

class LogType extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{log_types}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['alias, title, visible', 'safe'],
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
