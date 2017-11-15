<?php

/**
 * Модель "TopicsForum"
 *
 * @author Кривилёв Иван <XEGO@yande.ru>
 * @description Темы форума
 */

class TopicsForum extends CActiveRecord {

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{topicsforum}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['title', 'required'],
			['alias, section_id, fixed, closed', 'safe'],
		];
	}

	public function attributeLabels()
	{
		return [
			'title' => 'Заголовок',
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
			'sorted'   => ['order' => 't.order ASC, t.id ASC'],
			'visibled' => ['condition' => 't.visible = 1'],
		];
	}

}
