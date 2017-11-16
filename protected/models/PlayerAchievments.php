<?php

/**
 * Модель "PlayerAchievments"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Достижения персонажа.
 */

class PlayerAchievments extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{player_achievments}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['dt', 'safe'],
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [
			'player' => [self::BELONGS_TO, 'Player', 'player_id'],
			'achievment' => [self::HAS_ONE, 'Achievment', ['id' => 'achievment_id']],
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
			'visibled' => ['condition' => 'achievment.visible = 1'],
		];
	}

}
