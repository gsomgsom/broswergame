<?php

/**
 * Модель "PlayerState"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Статусы действий персонажа. Одновременно хранилище кастомных параметров.
 * Глобальный статус (is_global = true) может быть активен только один (cooldown > time()), это как правило работа.
 */

class PlayerState extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{player_states}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['player_id, alias, is_global, state_int, state_text, cooldown', 'safe'],
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [
			'player' => [self::BELONGS_TO, 'Player', 'player_id'],
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
			'global' => ['condition' => 't.is_global = 1'],
		];
	}

}
