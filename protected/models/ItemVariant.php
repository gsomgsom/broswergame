<?php

/**
 * Модель "ItemVariant"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Справочник вариантов предмета.
 */

class ItemVariant extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{item_variants}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['title, effect, class, srt, def, dex, sta, int, visible', 'safe'],
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
