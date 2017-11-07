<?php

/**
 * Модель "SectionsForum"
 *
 * @author Кривилёв Иван <XEGO@yande.ru>
 * @description Новости. Запись новости в БД.
 */

class SectionsForum extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{news}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['publicated, alias, dt, title, content', 'safe'],
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
			'sorted' => ['order' => 't.dt DESC, t.id DESC'],
			'publicated' => ['condition' => 't.publicated = 1'],
		];
	}

}
