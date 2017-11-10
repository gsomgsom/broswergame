<?php

/**
 * Модель "PlayerLog"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Запись действий персонажа в журнале.
 */

class PlayerLog extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{player_logs}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['dt, html', 'safe'],
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [
			'player' => [self::BELONGS_TO, 'Player', 'player_id'],
			'type' => [self::HAS_MANY, 'LogType', ['id' => 'type_id']],
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
			'visibled' => ['condition' => 'type.visible = 1'],
		];
	}

}
